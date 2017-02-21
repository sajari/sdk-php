<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Sajari\Engine\Store\Record {

  // Score is a service which defines methods for setting and incrementing
  // term instance scores.
  class ScoreClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
      parent::__construct($hostname, $opts, $channel);
    }

    /**
     * SetScores sets record-term instance pos/neg scores in the Store.
     * @param \Sajari\Engine\Store\Record\SetRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Set(\Sajari\Engine\Store\Record\SetRequest $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.engine.store.record.Score/Set',
      $argument,
      ['\Sajari\Engine\Store\Record\SetResponse', 'decode'],
      $metadata, $options);
    }

    /**
     * IncrScores incrementally updates record-term instance pos/neg scores in the Store.
     * @param \Sajari\Engine\Store\Record\IncrementRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Increment(\Sajari\Engine\Store\Record\IncrementRequest $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.engine.store.record.Score/Increment',
      $argument,
      ['\Sajari\Engine\Store\Record\IncrementResponse', 'decode'],
      $metadata, $options);
    }

  }

}
