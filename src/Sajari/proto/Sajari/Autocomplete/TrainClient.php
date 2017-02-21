<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Sajari\Autocomplete {

  // Train defines methods for training autocomplete models.
  class TrainClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
      parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Train the corpus (used for spell correction).
     * @param \Sajari\Autocomplete\TrainCorpusRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function TrainCorpus(\Sajari\Autocomplete\TrainCorpusRequest $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.autocomplete.Train/TrainCorpus',
      $argument,
      ['\Sajari\Rpc\GPBEmpty', 'decode'],
      $metadata, $options);
    }

    /**
     * Train queries (used to assist with query popularity prediction).
     * @param \Sajari\Autocomplete\TrainQueryRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function TrainQuery(\Sajari\Autocomplete\TrainQueryRequest $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.autocomplete.Train/TrainQuery',
      $argument,
      ['\Sajari\Rpc\GPBEmpty', 'decode'],
      $metadata, $options);
    }

  }

}
