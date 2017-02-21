<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Sajari\Autocomplete {

  // Control defines methods for creating and deleting autocomplete models.
  class AdminClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
      parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Create a new autocomplete model.
     * @param \Sajari\Autocomplete\Model $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Create(\Sajari\Autocomplete\Model $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.autocomplete.Admin/Create',
      $argument,
      ['\Sajari\Rpc\GPBEmpty', 'decode'],
      $metadata, $options);
    }

    /**
     * Delete an existing model
     * @param \Sajari\Autocomplete\Model $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Delete(\Sajari\Autocomplete\Model $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.autocomplete.Admin/Delete',
      $argument,
      ['\Sajari\Rpc\GPBEmpty', 'decode'],
      $metadata, $options);
    }

  }

}
