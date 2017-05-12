<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Sajari\Api\Pipeline\V1 {

  // Store provides methods for adding, mutating and deleting records
  // using pipelines.
  class StoreClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
      parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Add adds a list of records to a collection using a store pipeline.
     * @param \Sajari\Api\Pipeline\V1\AddRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Add(\Sajari\Api\Pipeline\V1\AddRequest $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.api.pipeline.v1.Store/Add',
      $argument,
      ['\Sajari\Api\Pipeline\V1\AddResponse', 'decode'],
      $metadata, $options);
    }

  }

}
