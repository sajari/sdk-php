<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Sajari\Engine\Schema {

  // Service Schema defines methods for managing collection schemas.
  class SchemaClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
      parent::__construct($hostname, $opts, $channel);
    }

    /**
     * GetFields returns the fields in the schema.
     * @param \Sajari\Rpc\GPBEmpty $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function GetFields(\Sajari\Rpc\GPBEmpty $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.engine.schema.Schema/GetFields',
      $argument,
      ['\Sajari\Engine\Schema\Fields', 'decode'],
      $metadata, $options);
    }

    /**
     * AddFields adds new fields to the schema.
     * @param \Sajari\Engine\Schema\Fields $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function AddFields(\Sajari\Engine\Schema\Fields $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.engine.schema.Schema/AddFields',
      $argument,
      ['\Sajari\Engine\Schema\Response', 'decode'],
      $metadata, $options);
    }

    /**
     * MutateField mutates a field in the schema.
     * @param \Sajari\Engine\Schema\MutateFieldRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function MutateField(\Sajari\Engine\Schema\MutateFieldRequest $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.engine.schema.Schema/MutateField',
      $argument,
      ['\Sajari\Engine\Schema\Response', 'decode'],
      $metadata, $options);
    }

  }

}
