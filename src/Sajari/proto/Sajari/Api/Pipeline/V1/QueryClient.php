<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Sajari\Api\Pipeline\V1 {

  // Query provides methods for querying collections using pipelines.
  class QueryClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
      parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Sajari\Api\Pipeline\V1\SearchRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Search(\Sajari\Api\Pipeline\V1\SearchRequest $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.api.pipeline.v1.Query/Search',
      $argument,
      ['\Sajari\Api\Pipeline\V1\SearchResponse', 'decode'],
      $metadata, $options);
    }

  }

}
