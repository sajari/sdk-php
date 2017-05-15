<?php
/**
 * Class Client | Sajari/Client/Client.php
 *
 * @package     sajari-sdk-php
 */

namespace Sajari;

Internal\Utils::_require_all(__DIR__.'/proto', 10);

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
    /** @var string $credentials */
    private $credentials = "";
    private $channelCredentials = NULL;

    /** @var Engine\Store\Record\StoreClient $storeClient */
    private $storeClient;
    /** @var Api\Query\V1\QueryClient $queryClient */
    private $queryClient;
    /** @var Engine\Schema\SchemaClient $schemaClient */
    private $schemaClient;

    /**
     * Client constructor creates a new client to make calls to a
     * Collection.
     *
     * @param string $project The project.
     * @param string $collection The collection.
     * @param Opt[] $opts Options to configure dialing behaviour.
     */
    public function __construct($project, $collection, $opts = [])
    {
        $this->project = $project;
        $this->collection = $collection;

        $this->channelCredentials = \Grpc\ChannelCredentials::createSsl(
            file_get_contents(dirname(__FILE__) . "/roots.pem")
        );

        /** @var $opt Opt */
        foreach ($opts as $opt) {
            $opt->Apply($this);
        }
    }

    private function getQueryClient() {
        if ($this->queryClient === NULL) {
            $this->queryClient = new Api\Query\V1\QueryClient(
                $this->endpoint,
                ['credentials' => $this->channelCredentials]
            );
        }
        return $this->queryClient;
    }

    private function getStoreClient() {
        if ($this->storeClient === NULL) {
            $this->storeClient = new Engine\Store\Record\StoreClient(
                $this->endpoint,
                ['credentials' => $this->channelCredentials]
            );
        }
        return $this->storeClient;
    }

    private function getSchemaClient() {
        if ($this->schemaClient === NULL) {
            $this->schemaClient = new Engine\Schema\SchemaClient(
                $this->endpoint,
                ['credentials' => $this->channelCredentials]
            );
        }
        return $this->schemaClient;
    }

    /**
     * Schema returns a handler to a Schema client.
     * @return Schema
     */
    public function schema() {
        return new Schema($this->getSchemaClient(), $this->getCallMeta());
    }

    /**
     * Sets the channel credentials used on each connection.
     *
     * @param \Grpc\ChannelCredentials $channelCredentials
     */
    public function setChannelCredentials($channelCredentials) {
        $this->channelCredentials = $channelCredentials;
    }

    /**
     * Sets the credentials used in every RPC call.
     *
     * @param string $credentials
     */
    public function setCredentials($credentials) {
        $this->credentials = $credentials;
    }

    /**
     * Set the endpoint used on each connection.
     *
     * @param string $credentials
     */
    public function setEndpoint($endpoint) {
        $this->endpoint = $endpoint;
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
     * A key is a unique identifier for a Record in a Collection.
     *
     * @param string $field The field.
     * @param string $value The value of the identifier.
     * @return Key The key.
     */
    public function key($field, $value) {
        return new Key($field, $value);
    }

    /**
     * Create multiple keys with the same field.
     *
     * @param string $field The field.
     * @param array $values Values to create into keys.
     * @return Key[] The keys.
     */
    public function keys($field, array $values) {
        $keys = [];
        foreach($values as $value) {
            $keys[] = new Key($field, $value);
        }
        return $keys;
    }

    /**
     * Get returns a record corresponding to a unique key.
     *
     * This method is equivalent to GetMulti([$key]) except that any
     * errors returned will be thrown as exceptions.
     *
     * @param Key $key The
     * @return array Field-value pairs.
     * @throws Error\RecordNotFoundException
     */
    public function get(Key $key)
    {
        list($resp, $status) = $this->getMulti([$key]);
        Internal\Status::checkForError($status[0]);
        return $resp[0];
    }

    /**
     * Get multi returns an array of records corresponding to an array of
     * keys.
     *
     * @param Key[] $keys
     * @return Record\Record[]
     * @throws \Exception
     */
    public function getMulti(array $keys)
    {
        $protoKeys = Internal\Key::toProtoKeys($keys);
        /** @var Engine\Store\Record\GetResponse $reply */
        list($resp, $status) = $this->getStoreClient()->Get(
            $protoKeys,
            $this->getCallMeta()
        )->wait();

        Internal\Status::checkForError(
            new Status($status->code, $status->details)
        );

        $statuses = Internal\Status::fromProtoStatuses($resp->getStatus());

        $records = [];
        foreach ($resp->getRecords() as $i => $protoRecord) {
            $records[] = Internal\Record::fromProto($protoRecord);
        }
        return [$records, $statuses];
    }

    /**
     * Add inserts a Record into a Collection.
     *
     * @param array $values Associative array of field-value pairs which
     * defines the Record.
     * @param Record\Transform[] $transforms Optional list of transforms
     * to run when adding the record.
     * @return Key A Key which can be used in get to fetch the inserted record.
     * @throws Exception
     */
    public function add(array $values, array $transforms = null)
    {
        list($resp, $status) = $this->addMulti([$values], $transforms);
        Internal\Status::checkForError($status[0]);
        return $resp[0];
    }

    /**
     * AddMulti inserts multiple Records into a Collection.
     *
     * @param array Array of associative arrays representing the field-value pairs of Records to be added.
     * @param Transform[] $transforms Optional list of transforms to run when adding each record.
     * @return array Tuple of size 2, element 1 is an Array of Keys of the records added, element 2 is a list of Statuses.
     * @throws Error\Exception
     */
    public function addMulti(array $records, array $transforms = null)
    {
        $protoRecords = new Engine\Store\Record\Records();
        foreach ($records as $r) {
            $protoRecords->getRecords()[] = Internal\Record::toProto($r);
        }

        if (!isset($transforms)) {
            $transforms = [
                Transform::SplitStopStemIndexedFields()
            ];
        }
        foreach ($transforms as $t) {
            $protoRecords->getTransforms()[] = $t->proto();
        }

        /** @var Engine\Store\Record\AddResponse $reply */
        list($resp, $status) = $this->getStoreClient()->Add(
            $protoRecords,
            $this->getCallMeta()
        )->wait();

        Internal\Status::checkForError(
            new Status($status->code, $status->details)
        );

        $statuses = Internal\Status::fromProtoStatuses($resp->getStatus());
        $keys = Internal\Key::fromProtoKeys($resp->getKeys());
        return [$keys, $statuses];
    }

    /**
     * Delete a single record identified by a key.
     *
     * @param Key $key Key of the record to be deleted.
     * @return null
     */
    public function delete(Key $key)
    {
        $status = $this->deleteMulti([$key]);
        Internal\Status::checkForError($status[0]);
    }

    /**
     * Delete multiple records identified by a list of keys.
     * @param Key[] $keys Array of Keys of the records to be deleted.
     * @return Status[] Array of Status objects describing each record deletion operation. They correspond to the Key of the same index in the array of Keys passed to deleteMulti.
     * @throws Error\Exception
     */
    public function deleteMulti(array $keys)
    {
        $protoKeys = Internal\Key::toProtoKeys($keys);

        list($resp, $status) = $this->getStoreClient()->Delete(
            $protoKeys,
            $this->getCallMeta()
        )->wait();

        Internal\Status::checkForError(
            new Status($status->code, $status->details)
        );

        return Internal\Status::fromProtoStatuses($resp->getStatus());
    }

    /**
     * Mutate the record corresponding to key.
     *
     * @param Key $key The key of the record to be mutated.
     * @param array $setFields An associative array of field-value
     * pairs to set on the record.
     * @return null
     */
    public function mutate(Key $key, array $setFields)
    {
      $status = $this->mutateMulti([$key], [$setFields]);
      Internal\Status::checkForError($status[0]);
    }

    /**
     * Mutate multiple records.
     *
     * @param Key[] $keys List of keys corresponding to the
     * records to set values on.
     * @param array Array of associative arrays containing field-value
     * pairs to set on the records.
     * @return mixed
     * @throws \Exception
     */
    public function mutateMulti(array $keys, array $setFields)
    {
        $protoMutateRequest = new Engine\Store\Record\MutateRequest();
        foreach ($keys as $i => $key) {
            $protoRecordMutation = new Engine\Store\Record\MutateRequest_RecordMutation();
            $keyProto = Internal\Key::toProto($key);
            $protoRecordMutation->setKey($keyProto);

            foreach($setFields[$i] as $field => $value) {
                $protoFieldMutation = new Engine\Store\Record\MutateRequest_RecordMutation_FieldMutation();
                $protoFieldMutation->setField($field);
                $protoValue = Internal\Value::toProto($value);
                $protoFieldMutation->setSet($protoValue);
                $protoRecordMutation->getFieldMutations()[] = $protoFieldMutation;
            }
            $protoMutateRequest->getRecordMutations()[] = $protoRecordMutation;
        }

        list($resp, $status) = $this->getStoreClient()->Mutate(
            $protoMutateRequest,
            $this->getCallMeta()
        )->wait();

        Internal\Status::checkForError(
            new Status($status->code, $status->details)
        );

        return Internal\Status::fromProtoStatuses($resp->getStatus());
    }

    /**
     * Create a handler for a Pipeline.
     * @param string $name Name of the pipeline to create a handler for.
     * @return Pipeline
     */
    public function pipeline($name)
    {
        $pipelineQueryClient = new Api\Pipeline\V1\QueryClient(
            $this->endpoint,
            ['credentials' => $this->channelCredentials]
        );
        $pipelineRecordClient = new Api\Pipeline\V1\StoreClient(
            $this->endpoint,
            ['credentials' => $this->channelCredentials]
        );

        return new Pipeline(
            $pipelineQueryClient,
            $pipelineRecordClient,
            $this->getCallMeta(),
            $name
        );
    }

    /**
     * Performs a search on the collection.
     * @param Query\Request $r
     * @return Query\Response
     */
    public function search(Query\Request $r)
    {
        $searchRequest = $r->ToProto();

        list($resp, $status) = $this->getQueryClient()->Search(
            $searchRequest,
            $this->getCallMeta()
        )->wait();

        Internal\Status::checkForError(
            new Status($status->code, $status->details)
        );

        return Query\Response::fromProto($resp->getSearchResponse(), iterator_to_array($resp->getTokens()));
    }
}
