<?php
/**
 * Class Client | Sajari/Client/Client.php
 *
 * @package     sajari-sdk-php
 */

namespace Sajari;

\Sajari\Internal\Utils::_require_all(__DIR__.'/proto', 10);



/**
 * Class Client
 */
class Client
{
    /** @var string $project */
    private $project = '';
    /** @var string $collection */
    private $collection = '';
    /** @var string $endpoint */
    private $endpoint = 'api.sajari.com:443';

    private $channelCredentials = NULL;

    /** @var string $credentials */
    private $credentials = "yo";

    /** @var \Sajari\Engine\Store\Record\StoreClient $storeClient */
    private $storeClient;
    /** @var \sajariGen\api\query\v1\QueryClient $searchClient */
    private $searchClient;
    /** @var \sajariGen\engine\schema\SchemaClient $schemaClient */
    private $schemaClient;

    /**
     * Client constructor
     * @param string $project
     * @param string $collection
     * @param \Sajari\Client\Opt[] $dialOptions
     */
    public function __construct($project, $collection, $dialOptions = [])
    {
        $this->project = $project;
        $this->collection = $collection;

        $this->channelCredentials = \Grpc\ChannelCredentials::createSsl(file_get_contents(dirname(__FILE__) . "/roots.pem"));

        /** @var $opt Opt */
        foreach ($dialOptions as $opt) {
            $opt->Apply($this);
        }

        $this->searchClient = new \Sajari\Api\Query\V1\QueryClient($this->endpoint, [
                                                            'credentials' => $this->channelCredentials,
                                                    ]);
        $this->storeClient = new \Sajari\Engine\Store\Record\StoreClient($this->endpoint, [
                                                            'credentials' => $this->channelCredentials,
                                                    ]);
        $this->schemaClient = new \Sajari\Engine\Schema\SchemaClient($this->endpoint, [
                                                            'credentials' => $this->channelCredentials,
                                                    ]);
    }

    public function setChannelCredentials($channelCredentials) {
        $this->channelCredentials = $channelCredentials;
    }

    public function setCredentials($credentials) {
        $this->credentials = $credentials;
    }

    public function setEndpoint($endpoint) {
        $this->endpoint = $endpoint;
    }

    public function Pipeline($name) {
        $pipelineClient = new \Sajari\Api\Pipeline\V1\QueryClient($this->endpoint, [
                                                            'credentials' => $this->channelCredentials,
                                                    ]);
        return new \Sajari\Pipeline\Client($pipelineClient, $this->getCallMeta(), $name);
    }

    /**
     * @return array
     */
    private function getCallMeta()
    {
        return array(
            'project' => [$this->project],
            'collection' => [$this->collection],
            'authorization' => [$this->credentials],
        );
    }

    /**
     * @param \Sajari\Key $key
     * @return array
     * @throws \Sajari\Error\RecordNotFoundException
     */
    public function Get(\Sajari\Key $key)
    {
        try {
            list($reply, $status) = $this->GetMulti([$key]);
        } catch (\Sajari\Error\MultiRecordNotFoundException $e) {
            throw new \Sajari\Error\RecordNotFoundException($e->getMessage(), $e->getCode(), null);
        }

        return [$reply[0], $status[0]];
    }

    /**
     * @param \Sajari\Key[] $keys
     * @return \Sajari\Record\Record[]
     * @throws \Exception
     */
    public function GetMulti(array $keys)
    {
        $protoKeys = $this->keysToProto($keys);
        /** @var \Sajari\Engine\Store\Record\GetResponse $reply */
        list($reply, $status) = $this->storeClient->Get(
            $protoKeys,
            $this->getCallMeta()
        )->wait();

        // Check for server error
        \Sajari\Internal\Utils::checkForError($status);

        $records = [];

        foreach ($reply->getRecords() as $protoRecord) {
            $records[] = \Sajari\Record\Record::FromProto($protoRecord);
        }

        $statuses = $reply->getStatus();

        foreach ($statuses as $s) {
            if (isset($s) && $s->getCode() === 5) {
                throw new \Sajari\Error\MultiRecordNotFoundException($s->getMessage(), $s->getCode(), null);
            }
        }

        return [$records, $statuses];
    }

    /**
     * @param array $keys
     * @return \Sajari\Engine\Store\Record\Keys
     */
    private function keysToProto(array $keys)
    {
        $protoKeys = new \Sajari\Engine\Store\Record\Keys();
        foreach ($keys as $k) {
            $protoKeys->getKeys()[] = $k->Proto();
        }
        return $protoKeys;
    }

    /**
     * @param \Sajari\Record\Record $rec
     * @param \Sajari\Record\Transform[] $transforms
     * @return mixed
     * @throws Exception
     */
    public function Add(\Sajari\Record\Record $rec, array $transforms = null)
    {
        $multiResult = $this->AddMulti([$rec], $transforms);

        // Return the first key and status from add multi
        return [$multiResult[0][0], $multiResult[1][0]];
    }

    /**
     * @param \Sajari\Record\Record[] $records
     * @param \Sajari\Record\Transform[] $transforms
     * @return array
     * @throws \Sajari\Error\Exception
     */
    public function AddMulti(array $records, array $transforms = null)
    {
        $protoRecords = new \Sajari\Engine\Store\Record\Records();

        $tempRecords = [];
        foreach ($records as $r) {
            $tempRecords[] = $r->Proto();
        }
        $repeatedProtoRecords = \Sajari\Internal\Utils::MakeRepeated(
            $tempRecords,
            \Google\Protobuf\Internal\GPBType::MESSAGE,
            \Sajari\Engine\Store\Record\Record::class
        );
        $protoRecords->setRecords($repeatedProtoRecords);

        if (!isset($transforms)) {
            $transforms = [
                \Sajari\Record\Transform::SplitStopStemIndexedFields()
            ];
        }

        $tempProtoTransforms = [];
        foreach ($transforms as $t) {
            $tempProtoTransforms[] = $t->Proto();
        }
        $repeatedProtoTransforms = \Sajari\Internal\Utils::MakeRepeated(
            $tempProtoTransforms,
            \Google\Protobuf\Internal\GPBType::MESSAGE,
            \Sajari\Engine\Store\Record\Transform::class
        );
        $protoRecords->setTransforms($repeatedProtoTransforms);

        /** @var \Sajari\Engine\Store\Record\AddResponse $reply */
        list($reply, $status) = $this->storeClient->Add(
            $protoRecords,
            $this->getCallMeta()
        )->wait();

        // Check for server error
        \Sajari\Internal\Utils::checkForError($status);

        $keys = [];

        foreach ($reply->getKeys() as $i => $k) {
            $keys[] = $reply->getStatus()[$i]->getCode() == 0 ? \Sajari\Key::FromProto($k) : null;
        }

        return [$keys, $reply->getStatus()];
    }

    /**
     * @param $key
     * @return null
     */
    public function Delete($key)
    {
        $multiResult = $this->DeleteMulti([$key]);
        if ($multiResult == NULL) {
          return NULL;
        } else {
          return $multiResult[0];
        }
    }

    /**
     * @param array $keys
     * @return mixed
     * @throws \Exception
     */
    public function DeleteMulti(array $keys)
    {
        $protoKeys = $this->keysToProto($keys);

        list($reply, $status) = $this->storeClient->Delete(
            $protoKeys,
            $this->getCallMeta()
        )->wait();

        // Check for server error
        \Sajari\Internal\Utils::checkForError($status);

        return $reply->getStatus();
    }

    /**
     * @param \Sajari\Record\RecordMutation $keyValues
     * @return null
     */
    public function Mutate($keyValues)
    {
      $multiResult = $this->MutateMulti(array($keyValues));
      if ($multiResult == NULL) {
        return NULL;
      }
      return $multiResult[0];
    }

    /**
     * @param \Sajari\Record\RecordMutation[] $keyValues
     * @return mixed
     * @throws \Exception
     */
    public function MutateMulti(array $keyValues)
    {
        $protoKeyValues = new \Sajari\Engine\Store\Record\MutateRequest();

        $mutations = [];
        foreach ($keyValues as $keyValue) {
            $mutations[] = $keyValue->Proto();
        }
        $protoKeyValues->setRecordMutations(\Sajari\Internal\Utils::MakeRepeated($mutations, \Google\Protobuf\Internal\GPBType::MESSAGE, \Sajari\Engine\Store\Record\MutateRequest_RecordMutation::class));

        list($reply, $status) = $this->storeClient->Mutate(
            $protoKeyValues,
            $this->getCallMeta()
        )->wait();

        // Check for server error
        \Sajari\Internal\Utils::checkForError($status);

        return $reply->getStatus();
    }

    /**
     * @param \Sajari\Query\Request $r
     * @return \Sajari\Query\Response
     */
    public function Search(\Sajari\Query\Request $r)
    {
        $searchRequest = $r->ToProto();

        list($reply, $status) = $this->searchClient->Search(
            $searchRequest,
            $this->getCallMeta()
        )->wait();

        \Sajari\Internal\Utils::checkForError($status);

        return \Sajari\Query\Response::FromProto($reply->getSearchResponse(), iterator_to_array($reply->getTokens()));
    }

    /**
     * @return \Sajari\Schema\Field[]
     */
    public function GetFields()
    {
        /** @var \sajariGen\engine\schema\Fields $reply */
        list($reply, $status) = $this->schemaClient->GetFields(
            new \Sajari\Rpc\GPBEmpty(),
            $this->getCallMeta()
        )->wait();

        \Sajari\Internal\Utils::checkForError($status);

        $fields = [];

        foreach ($reply->getFields() as $field) {
            $fields[] = \Sajari\Schema\Field::FromProto($field);
        }

        return $fields;
    }

    /**
     * @param \Sajari\Schema\Field[] $fields
     * @return \Sajari\Schema\Response
     */
    public function AddFields(array $fields)
    {
        $protoFields = new \sajariGen\engine\schema\Fields();
        foreach ($fields as $field) {
            $protoFields->addFields($field->Proto());
        }

        /** @var \sajariGen\engine\schema\Response $reply */
        list($reply, $status) = $this->schemaClient->AddFields(
            $protoFields,
            $this->getCallMeta()
        )->wait();

        \Sajari\Internal\Utils::checkForError($status);

        return \Sajari\Schema\Response::FromProto($reply);
    }

    /**
     * @param \Sajari\Schema\MutateFieldRequest $request
     * @return \Sajari\Schema\Response
     */
    public function MutateFields(\Sajari\Schema\MutateFieldRequest $request)
    {
        /** @var \sajariGen\engine\schema\Response $reply */
        list($reply, $status) = $this->schemaClient->MutateFields(
            $request->Proto(),
            $this->getCallMeta()
        )->wait();

        \Sajari\Internal\Utils::checkForError($status);

        return \Sajari\Schema\Response::FromProto($reply);
    }
}
