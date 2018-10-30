<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Sajari\Api\Pipeline\V1;

/**
 * QueryControl is a service that controls query pipelines.
 */
class QueryControlClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Sajari\Api\Pipeline\V1\CreateQueryRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Create(\Sajari\Api\Pipeline\V1\CreateQueryRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.api.pipeline.v1.QueryControl/Create',
        $argument,
        ['\Sajari\Api\Pipeline\V1\CreateQueryResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Sajari\Api\Pipeline\V1\DeleteQueryRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Delete(\Sajari\Api\Pipeline\V1\DeleteQueryRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.api.pipeline.v1.QueryControl/Delete',
        $argument,
        ['\Sajari\Api\Pipeline\V1\DeleteQueryResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Sajari\Api\Pipeline\V1\ListQueryRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function List(\Sajari\Api\Pipeline\V1\ListQueryRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.api.pipeline.v1.QueryControl/List',
        $argument,
        ['\Sajari\Api\Pipeline\V1\ListQueryResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Sajari\Api\Pipeline\V1\ListStepsRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function ListSteps(\Sajari\Api\Pipeline\V1\ListStepsRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.api.pipeline.v1.QueryControl/ListSteps',
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
        return $this->_simpleRequest('/sajari.api.pipeline.v1.QueryControl/GetStep',
        $argument,
        ['\Sajari\Api\Pipeline\V1\GetStepResponse', 'decode'],
        $metadata, $options);
    }

}
