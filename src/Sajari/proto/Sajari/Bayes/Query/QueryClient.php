<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Sajari\Bayes\Query {

  // Query defines methods used to interact with the bayes query service.
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
     * Query takes a model name and an array of strings and returns a naive bayes
     * based classification for the request data using the model specified.
     * @param \Sajari\Bayes\Query\Request $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Query(\Sajari\Bayes\Query\Request $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.bayes.query.Query/Query',
      $argument,
      ['\Sajari\Bayes\Query\Response', 'decode'],
      $metadata, $options);
    }

  }

}
