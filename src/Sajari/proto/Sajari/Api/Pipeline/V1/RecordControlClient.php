<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Sajari\Api\Pipeline\V1;

/**
 * RecordControl is a service that controls record pipelines.
 */
class RecordControlClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Sajari\Api\Pipeline\V1\CreateRecordRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Create(\Sajari\Api\Pipeline\V1\CreateRecordRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.api.pipeline.v1.RecordControl/Create',
        $argument,
        ['\Sajari\Api\Pipeline\V1\CreateRecordResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Sajari\Api\Pipeline\V1\DeleteRecordRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Delete(\Sajari\Api\Pipeline\V1\DeleteRecordRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.api.pipeline.v1.RecordControl/Delete',
        $argument,
        ['\Sajari\Api\Pipeline\V1\DeleteRecordResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * rpc List(ListRecordRequest) returns (ListRecordResponse);
     * @param \Sajari\Api\Pipeline\V1\ListStepsRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function ListSteps(\Sajari\Api\Pipeline\V1\ListStepsRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.api.pipeline.v1.RecordControl/ListSteps',
        $argument,
        ['\Sajari\Api\Pipeline\V1\ListStepsResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Sajari\Api\Pipeline\V1\GetStepRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function GetStep(\Sajari\Api\Pipeline\V1\GetStepRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.api.pipeline.v1.RecordControl/GetStep',
        $argument,
        ['\Sajari\Api\Pipeline\V1\GetStepResponse', 'decode'],
        $metadata, $options);
    }

}
