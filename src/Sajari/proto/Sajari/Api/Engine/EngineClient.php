<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Sajari\Api\Engine {

  // Engine defines internal methods for admin control of an engine, including
  // creating/loading/unloading/listing (loaded) collections.
  class EngineClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
      parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Create a collection.
     * @param \Sajari\Api\Engine\Collection $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function CreateCollection(\Sajari\Api\Engine\Collection $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.api.engine.Engine/CreateCollection',
      $argument,
      ['\Sajari\Rpc\GPBEmpty', 'decode'],
      $metadata, $options);
    }

    /**
     * Deletes all resources associated with this collection. Collections must first
     * be unloaded before they can be deleted.
     * @param \Sajari\Api\Engine\Collection $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function DeleteCollection(\Sajari\Api\Engine\Collection $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.api.engine.Engine/DeleteCollection',
      $argument,
      ['\Sajari\Rpc\GPBEmpty', 'decode'],
      $metadata, $options);
    }

  }

}
