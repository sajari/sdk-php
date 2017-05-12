<?php
/**
 * Class Client | Sajari/Client/Client.php
 *
 * @package     sajari-sdk-php
 */

namespace Sajari\Client;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

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
    private $endpoint = 'apid.sajari.com:443';
    /** @var \Sajari\Engine\Store\Record\StoreClient $storeClient */
    private $storeClient;
    /** @var \sajariGen\api\query\v1\QueryClient $searchClient */
    private $searchClient;
    /** @var \sajariGen\engine\schema\SchemaClient $schemaClient */
    private $schemaClient;

    private $pipelineClient;
    /** @var string $auth */
    private $auth;

    /**
     * @param string $auth
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;
    }

    /**
     * Client constructor
     * @param \sajariGen\api\query\v1\QueryClient $queryClient
     * @param \Sajari\Engine\Store\Record\StoreClient $storeClient
     * @param string $projectID
     * @param string $collection
     * @param \Sajari\Client\Opt[] $dialOptions
     */
    public function __construct(\Sajari\Api\Query\V1\QueryClient $queryClient, \Sajari\Engine\Store\Record\StoreClient $storeClient, \Sajari\Engine\Schema\SchemaClient $schemaClient, \Sajari\Api\Pipeline\V1\QueryClient $pipelineClient, $projectID, $collection, $dialOptions)
    {
        $this->project = $projectID;
        $this->collection = $collection;

        /** @var $opt Opt */
        foreach ($dialOptions as $opt) {
            $opt->Apply($this);
        }

        $this->searchClient = $queryClient;
        $this->storeClient = $storeClient;
        $this->schemaClient = $schemaClient;
        $this->pipelineClient = $pipelineClient;
    }

    /**
     * Creates a new Client with defaults set
     * @param string $projectID
     * @param string $collection
     * @param \Sajari\Client\Opt[] $dialOptions
     * @return Client
     * @throws \Sajari\Error\Exception
     */
    public static function NewClient($projectID, $collection, array $dialOptions)
    {
        if (gettype($projectID) !== "string" || $projectID === "") {
            throw new \Sajari\Error\Exception("invalid project supplied");
        }
        if (gettype($collection) !== "string" || $collection === "") {
            throw new \Sajari\Error\Exception("invalid collection supplied");
        }

        $credentials = \Grpc\ChannelCredentials::createSsl(file_get_contents(dirname(__FILE__) . "/roots.pem"));

        return new Client(
            new \Sajari\Api\Query\V1\QueryClient('apid.sajari.com:443', [
                'credentials' => $credentials,
            ]),
            new \Sajari\Engine\Store\Record\StoreClient('apid.sajari.com:443', [
                'credentials' => $credentials,
            ]),
            new \Sajari\Engine\Schema\SchemaClient('apid.sajari.com:443', [
                'credentials' => $credentials,
            ]),
            new \Sajari\Api\Pipeline\V1\QueryClient('apid.sajari.com:443', [
                'credentials' => $credentials,
            ]),
            $projectID,
            $collection,
            $dialOptions
        );
    }

    public function Pipeline($name) {
        return new \Sajari\Pipeline\Client($this->pipelineClient, $this->getCallMeta(), $name);
    }

    /**
     * @return array
     */
    private function getCallMeta()
    {
        return array(
            'project' => [$this->project],
            'collection' => [$this->collection],
            'authorization' => [$this->auth],
        );
    }



    public function SearchPipeline(\Sajari\Pipeline\Request $req) {
        list($reply, $status) = $this->pipelineClient->Search(
            $req->ToProto(),
            $this->getCallMeta()
        )->wait();

        $this->checkForError($status);

        $reply = $reply->getSearchResponse();

        return \Sajari\Query\Response::FromProto($reply->getSearchResponse(), iterator_to_array($reply->getTokens()));
    }



    /**
     * @param \Sajari\Engine\Key $key
     * @return array
     * @throws \Sajari\Error\RecordNotFoundException
     */
    public function Get(\Sajari\Key\Key $key)
    {
        try {
            list($res, $status) = $this->GetMulti([$key]);
        } catch (\Sajari\Error\MultiRecordNotFoundException $e) {
            throw new \Sajari\Error\RecordNotFoundException($e->getMessage(), $e->getCode(), null);
        }

        return [$res[0], $status[0]];
    }

    /**
     * @param \Sajari\Engine\Key[] $keys
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
        $this->checkForError($status);

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

        $tkeys = [];
        /** @var \Sajari\Engine\Key $k */
        foreach ($keys as $k) {
            $tkeys[] = $k->Proto();
        }

        $protoKeys->setKeys(\Sajari\Internal\Utils::MakeRepeated($tkeys, \Google\Protobuf\Internal\GPBType::MESSAGE, \Sajari\Engine\Key::class));

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
        $protoRecords->setRecords(\Sajari\Internal\Utils::MakeRepeated($tempRecords, \Google\Protobuf\Internal\GPBType::MESSAGE, \Sajari\Engine\Store\Record\Record::class));

        if (!isset($transforms)) {
            $transforms = [
                \Sajari\Record\Transform::SplitStopStemIndexedFields()
            ];
        }

        if (isset($transforms)) {
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
        }

        /** @var \Sajari\Engine\Store\Record\AddResponse $reply */
        list($reply, $status) = $this->storeClient->Add(
            $protoRecords,
            $this->getCallMeta()
        )->wait();

        // Check for server error
        $this->checkForError($status);

        $keys = [];

        foreach ($reply->getKeys() as $i => $k) {
            $keys[] = $reply->getStatus()[$i]->getCode() == 0 ? \Sajari\Key\Key::FromProto($k) : null;
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
        $this->checkForError($status);

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
      } else {
        return $multiResult[0];
      }
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
        $this->checkForError($status);

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

        $this->checkForError($status);

        // $x = $reply->getTokens();
        //
        // echo "\n\n~~~\n\n";
        //
        // print_r($x);
        //
        // echo "\n\n~~~\n\n";
        //
        // $method_names = preg_grep('/^bla_/', get_class_methods($x));
        //
        // print_r($method_names);

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

        $this->checkForError($status);

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

        $this->checkForError($status);

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

        $this->checkForError($status);

        return \Sajari\Schema\Response::FromProto($reply);
    }

    /**
     * @param $status
     * @throws \Sajari\Error\AlreadyExistsException
     * @throws \Sajari\Error\Exception
     * @throws \Sajari\Error\MalformedRequestException
     * @throws \Sajari\Error\NotFoundException
     * @throws \Sajari\Error\PermissionDeniedException
     * @throws \Sajari\Error\ServiceUnavailableException
     * @throws \Sajari\Error\UnauthenticatedException
     */
    private function checkForError($status)
    {
        switch ($status->code) {
            case 0:
                return;
            case 3:
                // invalid argument
                throw new \Sajari\Error\MalformedRequestException($status->details, $status->code);
            case 5:
                // not found
                throw new \Sajari\Error\NotFoundException($status->details, $status->code);
            case 6:
                // already exists
                throw new \Sajari\Error\AlreadyExistsException($status->details, $status->code);
            case 7:
                // permission denied
                throw new \Sajari\Error\PermissionDeniedException($status->details, $status->code);
            case 14:
                // unavailable
                throw new \Sajari\Error\ServiceUnavailableException($status->details, $status->code);
            case 16:
                // unauthenticated
                throw new \Sajari\Error\UnauthenticatedException($status->details, $status->code);;
            default:
                // generic exception
                throw new \Sajari\Error\Exception($status->details, $status->code);
        }
    }
}
