<?php

namespace Sajari;

Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class Pipeline
 * @package Sajari
 */
class Pipeline
{
    private $grpcQueryClient;
    private $grpcRecordClient;
    private $callMeta;
    private $pipelineName;

    /**
     * Create a new pipeline handler.
     *
     * @param Api\Pipeline\V1\QueryClient $grpcQueryClient Query client to use.
     * @param Api\Pipeline\V1\StoreClient $grpcStoreClient Store client to use.
     * @param array $callMeta Metadata to attach to calls.
     * @param string $pipelineName Name of the pipeline.
     */
    public function __construct(
        Api\Pipeline\V1\QueryClient $grpcQueryClient,
        Api\Pipeline\V1\StoreClient $grpcRecordClient,
        array $callMeta,
        $pipelineName
    ) {
        $this->grpcQueryClient = $grpcQueryClient;
        $this->grpcRecordClient = $grpcRecordClient;
        $this->callMeta = $callMeta;
        $this->pipelineName = $pipelineName;
    }

    private function pipelineProto() {
        $pipeline = new Api\Pipeline\V1\Pipeline();
        $pipeline->setName($this->pipelineName);
        return $pipeline;
    }

    /**
     * Search performs a search using a pipeline.
     *
     * @param array $values Associative array of key-value pairs for
     * configuring the pipeline.
     * @param Query\Tracking $tracking Optional Tracking object to use for the search.
     */
    public function search(array $values, Query\Tracking $tracking = null) {
        $searchRequest = new Api\Pipeline\V1\SearchRequest();
        $pp = $this->pipelineProto();
        $searchRequest->setPipeline($pp);
        $searchRequest->setValues($values);
        if (!isset($tracking)) {
            $tracking = new Query\Tracking();
        }
        $trackingProto = $tracking->proto();
        $searchRequest->setTracking($trackingProto);

        list($reply, $status) = $this->grpcQueryClient->Search(
            $searchRequest,
            $this->callMeta
        )->wait();

        Internal\Status::fromRpcCallStatus($status)->throwIfError();

        return Query\Response::fromProto(
            $reply->getSearchResponse(),
            iterator_to_array($reply->getTokens())
        );
    }

    /**
     * Add a record to a collection using a pipeline.
     *
     * @param array $values Associative array of key-value pairs for
     * configuring the pipeline.
     * @return Key $key
     */
    public function add(array $values, array $record) {
        $resp = $this->addMulti($values, [$record]);
        $resp[0]->getStatus()->throwIfError();
        return $resp[0]->getKey();
    }

    /**
     * Add multiple records to a collection using a pipeline.
     *
     * @param array $values Associative array of key-value pairs for
     * configuring the pipeline.
     * @return AddResponse[]
     */
    public function addMulti(array $values, array $records) {
        $addRequest = new Api\Pipeline\V1\AddRequest();
        $pipelineProto = $this->pipelineProto();
        $addRequest->setPipeline($pipelineProto);
        $addRequest->setValues($values);

        foreach($records as $record) {
            $addRequest->getRecords()[] = Internal\Record::toProto($record);
        }

        list($resp, $status) = $this->grpcRecordClient->Add(
            $addRequest,
            $this->callMeta
        )->wait();

        Internal\Status::fromRpcCallStatus($status)->throwIfError();

        $resp = $resp->getResponse();
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
}
