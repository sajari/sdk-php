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
     * Create a new Pipeline handler.
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

        Internal\Status::checkForError(
            new Status($status->code, $status->details)
        );

        return Query\Response::fromProto(
            $reply->getSearchResponse(),
            iterator_to_array($reply->getTokens())
        );
    }

    /**
     * Add a record to a Collection using a pipeline.
     *
     * @param array $values Associative array of key-value pairs for
     * configuring the pipeline.
     */
    public function add(array $values, array $record) {
        list($resp, $status) = $this->addMulti($values, [$record]);
        Internal\Status::checkForError($status[0]);
        return $resp[0];
    }

    /**
     * Add multiple records to a Collection using a pipeline.
     *
     * @param array $values Associative array of key-value pairs for
     * configuring the pipeline.
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

        Internal\Status::checkForError(
            new Status($status->code, $status->details)
        );

        $r = $resp->getResponse();
        $statuses = Internal\Status::fromProtoStatuses($r->getStatus());
        $keys = Internal\Key::fromProtoKeys($r->getKeys());
        return [$keys, $statuses];
    }
}
