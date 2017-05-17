<?php

namespace Sajari;

Internal\Utils::_require_all(__DIR__.'/proto', 10);

/**
 * Class Client
 * @package Sajari
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
     * Client constructor.
     *
     * Creates a new client to make calls to a collection.
     *
     * Example:
     *
     *     $client = new Client("mybookstore", "mybooks", [
     *         new WithKeyCredentials("key-id", "key-secret")
     *     ]);
     *
     * @param string $project The project.
     * @param string $collection The collection.
     * @param Opt[] $opts Options to configure dialing behaviour.
     * @return Client
     */
    public function __construct($project, $collection, array $opts = [])
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
     *
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
     * Create a key with a field and value.
     *
     * Example:
     *
     *     $key = $client->key("slug", "the-three-musketeers");
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
     * Example:
     *
     *     $keys = $client->keys("slug", [
     *         "the-three-musketeers",
     *         "the-remains-of-the-day",
     *         "1984",
     *     ]);
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
     * Get the record corresponding to a key.
     *
     * This method is equivalent to getMulti([$key]) except any
     * errors will be thrown as exceptions.
     *
     * Example:
     *
     *     $record = $client->get($client->key("slug", "the-three-musketeers"));
     *     print_r($record);
     *
     * @param Key $key The key corresponding to the record to fetch.
     * @return array Field-value pairs of the record.
     * @throws Error\Exception
     */
    public function get(Key $key)
    {
        $resp = $this->getMulti([$key]);
        $resp[0]->getStatus()->throwIfError();
        return $resp[0]->getRecord();
    }

    /**
     * Get the records corresponding to an array of keys.
     *
     * This method will only throw an exception if there was an error
     * making the call.  To determine the success of individual get
     * operations check `isError()` on the returned GetResponse instances.
     *
     * Example:
     *
     *     $keys = $client->keys("slug", [
     *         "the-three-musketeers",
     *         "the-remains-of-the-day",
     *         "1984",
     *     ]);
     *
     *     $resps = $client->getMulti($keys);
     *
     *     foreach($resps as $resp) {
     *         if ($resp->isError()) {
     *            echo "error fetching record: " . $resp->getStatus() . "\n";
     *            continue;
     *         }
     *         print_r($resp->getRecord());
     *     }
     *
     * @param Key[] $keys
     * @return GetResponse[]
     * @throws \Exception
     */
    public function getMulti(array $keys)
    {
        $protoKeys = Internal\Key::toProtoKeys($keys);
        list($resp, $status) = $this->getStoreClient()->Get(
            $protoKeys,
            $this->getCallMeta()
        )->wait();

        Internal\Status::fromRpcCallStatus($status)->throwIfError();

        $protoRecords = $resp->getRecords();
        $response = [];
        foreach($resp->getStatus() as $i => $protoStatus) {
            $response[] = new GetResponse(
                Internal\Status::fromProto($protoStatus),
                Internal\Record::fromProto($protoRecords[$i])
            );
        }
        return $response;
    }

    /**
     * Add a record to a collection.
     *
     * This method is equivalent to addMulti([$record]) except any
     * errors will be thrown as exceptions.
     *
     * Example:
     *
     *     $record = [
     *         "title" => "The Three Musketeers",
     *         "slug" => "the-three-musketeers",
     *         "author" => "Alexandre Dumas",
     *         "price" => 10.00,
     *         "qty" => 7,
     *     ];
     *     $key = $client->add($record);
     *
     * @param array $record Associative array of field-values defining
     * the record.
     * @param Transform[] $transforms Optional list of transforms to run
     * when adding the record.
     * @return Key A key which uniquely defines the record.
     * @throws Exception
     */
    public function add(array $record, array $transforms = null)
    {
        $resp = $this->addMulti([$record], $transforms);
        $resp[0]->getStatus()->throwIfError();
        return $resp[0]->getKey();
    }

    /**
     * Add multiple records to a collection.
     *
     * This method will only throw an exception if there was an error
     * making the call.  To determine the success of individual add
     * operations check `isError()` on the returned AddResponse instances.
     *
     * Example:
     *
     *     $records = [
     *         [
     *             "title" => "The Three Musketeers",
     *             "slug" => "the-three-musketeers",
     *             "author" => "Alexandre Dumas",
     *             "price" => 10.00,
     *             "qty" => 7,
     *         ],
     *         [
     *             "title" => "The Remains of the Day",
     *             "slug" => "the-remains-of-the-day",
     *             "author" => "Kazuo Ishiguro",
     *             "price" => 8.00,
     *             "qty" => 10,
     *         ],
     *         [
     *             "title" => "1984",
     *             "slug" => "1984",
     *             "author" => "George Orwell",
     *             "price" => 15.00,
     *             "qty" => 0,
     *         ]
     *     ];
     *
     *     $resps = $client->addMulti($records);
     *
     *     foreach($resps as $resp) {
     *         if ($resp->isError()) {
     *            echo "error adding record: " . $resp->getStatus() . "\n";
     *            continue;
     *         }
     *         echo $resp->getKey() . "\n";
     *     }
     *
     * @param array Array of associative arrays of field-values defining
     * the records.
     * @param Transform[] $transforms Optional list of transforms to run when
     * adding each record.
     * @return AddResponse[]
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

        list($resp, $status) = $this->getStoreClient()->Add(
            $protoRecords,
            $this->getCallMeta()
        )->wait();

        Internal\Status::fromRpcCallStatus($status)->throwIfError();

        $protoKeys = $resp->getKeys();
        $response = [];
        foreach($resp->getStatus() as $i => $protoStatus) {
            $response[] = new AddResponse(
                Internal\Status::fromProto($protoStatus),
                Internal\Key::fromProto($protoKeys[$i])
            );
        }
        return $response;
    }

    /**
     * Delete a record identified by a key.
     *
     * This method is equivalent to deleteMulti([$key]) except any
     * errors will be thrown as exceptions.
     *
     * Example:
     *
     *     $client->delete($client->key("slug", "1984"));
     *
     * @param Key $key Key of the record to be deleted.
     * @return void
     */
    public function delete(Key $key)
    {
        $status = $this->deleteMulti([$key]);
        $status[0]->throwIfError();
    }

    /**
     * Delete multiple records identified by a list of keys.
     *
     * This method will only throw an exception if there was an error
     * making the call.  To determine the success of individual delete
     * operations check `isError()` on the returned Status instances.
     *
     * Example:
     *
     *     $keys = $client->keys("slug", [
     *         "the-three-musketeers",
     *         "the-remains-of-the-day",
     *         "1984",
     *     ]);
     *
     *     $resps = $client->deleteMulti($keys);
     *
     *     foreach($resps as $resp) {
     *         if ($resp->isError()) {
     *            echo "error deleting record: " . $resp . "\n";
     *         }
     *     }
     *
     * @param Key[] $keys Array of Keys of the records to be deleted.
     * @return Status[] Array of Status objects describing each record
     * deletion operation.
     * @throws Error\Exception
     */
    public function deleteMulti(array $keys)
    {
        $protoKeys = Internal\Key::toProtoKeys($keys);

        list($resp, $status) = $this->getStoreClient()->Delete(
            $protoKeys,
            $this->getCallMeta()
        )->wait();

        Internal\Status::fromRpcCallStatus($status)->throwIfError();

        return Internal\Status::fromProtoStatuses($resp->getStatus());
    }

    /**
     * Edit the record corresponding to key.
     *
     * This method is equivalent to editMulti([$key],[$setField]) except
     * any errors will be thrown as exceptions.
     *
     * Example:
     *
     *     $client->edit(
     *         $client->key("slug", "the-remains-of-the-day"),
     *         [ "qty" => 10 ]
     *     );
     *
     * @param Key $key The key of the record to be editd.
     * @param array $setFields An associative array of field-value
     * pairs to set on the record.
     * @return void
     */
    public function edit(Key $key, array $setFields)
    {
        $status = $this->editMulti([$key], [$setFields]);
        $status[0]->throwIfError();
    }

    /**
     * Edit multiple records.
     *
     * This method will only throw an exception if there was an error
     * making the call.  To determine the success of individual edit
     * operations check `isError()` on the returned Status instances.
     *
     * Example:
     *
     *     $keys = $client->keys("slug", [
     *         "the-three-musketeers",
     *         "the-remains-of-the-day",
     *         "1984",
     *     ]);
     *
     *     $setFields = [
     *         ["title" => "The Three Musketeers (Original French)"],
     *         ["qty" => 10],
     *         ["title" => "George Orwell's 1984"],
     *     ];
     *
     *     $resps = $client->editMulti($keys, $setFields);
     *
     *     foreach($resps as $resp) {
     *         if ($resp->isError()) {
     *            echo "error editing record: " . $resp . "\n";
     *         }
     *     }
     *
     * @param Key[] $keys Array of keys corresponding to the
     * records to set values on.
     * @param array Array of associative arrays containing field-value
     * pairs to set on the records.
     * @return Status[] Array of Status objects describing each record
     * edit operation.
     * @throws \Exception
     */
    public function editMulti(array $keys, array $setFields)
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

        Internal\Status::fromRpcCallStatus($status)->throwIfError();

        return Internal\Status::fromProtoStatuses($resp->getStatus());
    }

    /**
     * Create a handler for a pipeline.
     *
     * Pipelines can be used for adding records or performing searches.
     *
     * Example:
     *
     *     $results = $client->pipeline("books")->search([
     *         "q" => "musketeers"
     *     ]);
     *
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
     *
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

        Internal\Status::fromRpcCallStatus($status)->throwIfError();

        return Query\Response::fromProto($resp->getSearchResponse(), iterator_to_array($resp->getTokens()));
    }
}
