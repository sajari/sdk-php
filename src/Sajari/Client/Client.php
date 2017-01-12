<?php
/**
 * Class Client | Sajari/Client/Client.php
 *
 * @package     sajari-sdk-php
 */

namespace Sajari\Client;

require_once __DIR__.'/../proto/engine/value.php';
require_once __DIR__.'/../proto/engine/key.php';
require_once __DIR__.'/../proto/engine/status.php';
require_once __DIR__.'/../proto/engine/empty.php';
require_once __DIR__.'/../proto/engine/store/record/record.php';
require_once __DIR__.'/../proto/api/query/v1/query.php';
require_once __DIR__.'/../proto/engine/schema/schema.php';

/**
 * Class Client
 */
class Client
{
    /** @var string $projectID */
    private $projectID = '';
    /** @var string $collection */
    private $collection = '';
    /** @var string $endpoint */
    private $endpoint = 'api.sajari.com:443';
    /** @var \sajariGen\engine\store\record\StoreClient $storeClient */
    private $storeClient;
    /** @var \sajariGen\api\query\v1\QueryClient $searchClient */
    private $searchClient;
    /** @var \sajariGen\engine\schema\SchemaClient $schemaClient */
    private $schemaClient;
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
     * @param \sajariGen\engine\store\record\StoreClient $storeClient
     * @param string $projectID
     * @param string $collection
     * @param \Sajari\Client\Opt[] $dialOptions
     */
    public function __construct(\sajariGen\api\query\v1\QueryClient $queryClient, \sajariGen\engine\store\record\StoreClient $storeClient, \sajariGen\engine\schema\SchemaClient $schemaClient, $projectID, $collection, $dialOptions)
    {
        $this->projectID = $projectID;
        $this->collection = $collection;

        /** @var $opt Opt */
        foreach ($dialOptions as $opt) {
            $opt->Apply($this);
        }

        $this->searchClient = $queryClient;
        $this->storeClient = $storeClient;
        $this->schemaClient = $schemaClient;
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
            new \sajariGen\api\query\v1\QueryClient('api.sajari.com:443', [
                'credentials' => $credentials,
            ]),
            new \sajariGen\engine\store\record\StoreClient('api.sajari.com:443', [
                'credentials' => $credentials,
            ]),
            new \sajariGen\engine\schema\SchemaClient('api.sajari.com:443', [
                'credentials' => $credentials,
            ]),
            $projectID,
            $collection,
            $dialOptions
        );
    }

    /**
     * @return array
     */
    private function getCallMeta()
    {
        return array(
            'project' => [$this->projectID],
            'collection' => [$this->collection],
            'authorization' => [$this->auth],
        );
    }

    /**
     * @param \Sajari\Engine\Key $key
     * @return array
     * @throws \Sajari\Error\RecordNotFoundException
     */
    public function Get(\Sajari\Engine\Key $key)
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

        /** @var \sajariGen\engine\store\record\GetResponse $reply */
        list($reply, $status) = $this->storeClient->Get(
            $protoKeys,
            $this->getCallMeta()
        )->wait();

        // Check for server error
        $this->checkForError($status);

        $records = [];

        foreach ($reply->getRecordsList() as $protoRecord) {
            $records[] = \Sajari\Record\Record::FromProto($protoRecord);
        }

        $statuses = $reply->getStatusList();

        foreach ($statuses as $s) {
            if (isset($s) && $s->code === 5) {
                throw new \Sajari\Error\MultiRecordNotFoundException($s->message, $s->code, null);
            }
        }

        return [$records, $statuses];
    }

    /**
     * @param array $keys
     * @return \sajariGen\engine\store\record\Keys
     */
    private function keysToProto(array $keys)
    {
        $protoKeys = new \sajariGen\engine\store\record\Keys();

        /** @var \Sajari\Engine\Key $k */
        foreach ($keys as $k) {
            $protoKeys->addKeys($k->Proto());
        }

        return $protoKeys;
    }

    /**
     * @param \Sajari\Record\Record $rec
     * @param \Sajari\Record\Transform[] $transforms
     * @return mixed
     * @throws Exception
     */
    public function Add(\Sajari\Record\Record $rec, array $transforms = [])
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
    public function AddMulti(array $records, array $transforms = [])
    {
        $protoRecords = new \sajariGen\engine\store\record\Records();

        foreach ($records as $r) {
            $protoRecords->addRecords($r->Proto());
        }

        if (!isset($transforms) || count($transforms) === 0) {
            $transforms = [
                \Sajari\Record\Transform::SplitIndexFields(),
                \Sajari\Record\Transform::StopStemmer()
            ];
        }

        if (isset($transforms)) {
            foreach ($transforms as $t) {
                $protoRecords->addTransforms($t->Proto());
            }
        }

        /** @var \sajariGen\engine\store\record\AddResponse $reply */
        list($reply, $status) = $this->storeClient->Add(
            $protoRecords,
            $this->getCallMeta()
        )->wait();

        // Check for server error
        $this->checkForError($status);

        $keys = [];

        foreach ($reply->getKeysList() as $k) {
            $keys[] = \Sajari\Engine\Key::FromProto($k);
        }

        return [$keys, $reply->getStatusList()];
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

        return $reply->getStatusList();
    }

    /**
     * @param \Sajari\Engine\KeyValues $keyValues
     * @return null
     */
    public function Patch($keyValues)
    {
      $multiResult = $this->PatchMulti(array($keyValues));
      if ($multiResult == NULL) {
        return NULL;
      } else {
        return $multiResult[0];
      }
    }

    /**
     * @param \Sajari\Engine\KeyValues[] $keyValues
     * @return mixed
     * @throws \Exception
     */
    public function PatchMulti(array $keyValues)
    {
        $protoKeyValues = new \sajariGen\engine\store\record\KeysValues();

        foreach ($keyValues as $keyValue) {
            $protoKeyValues->addKeysValues($keyValue->Proto());
        }

        list($reply, $status) = $this->storeClient->Patch(
            $protoKeyValues,
            $this->getCallMeta()
        )->wait();

        // Check for server error
        $this->checkForError($status);

        return $reply->getStatusList();
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

        return \Sajari\Query\Response::FromProto($reply->getSearchResponse(), $reply->getTokensList());
    }

    /**
     * @return \Sajari\Schema\Field[]
     */
    public function GetFields()
    {
        /** @var \sajariGen\engine\schema\Fields $reply */
        list($reply, $status) = $this->schemaClient->GetFields(
            new \sajariGen\engine\XEmpty(),
            $this->getCallMeta()
        )->wait();

        $this->checkForError($status);

        $fields = [];

        foreach ($reply->getFieldsList() as $field) {
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
            $protoFields->addFields($field->Proto);
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
