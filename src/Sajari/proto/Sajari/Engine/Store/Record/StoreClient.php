<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Sajari\Engine\Store\Record;

/**
 * Store is a service which defines methods for adding, getting, patching
 * and deleting records from a collection.
 */
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
     * Add creates new records in the collection returning a key for each
     * stored record.  The key can then be used in subsequent requests to
     * get/delete/patch.
     * @param \Sajari\Engine\Store\Record\Records $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Add(\Sajari\Engine\Store\Record\Records $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.engine.store.record.Store/Add',
        $argument,
        ['\Sajari\Engine\Store\Record\AddResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * Replace existing records in the collection with the new values. If
     * a record corresponding to the key does not already exist, then it
     * is added instead.
     * @param \Sajari\Engine\Store\Record\ReplaceRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Replace(\Sajari\Engine\Store\Record\ReplaceRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.engine.store.record.Store/Replace',
        $argument,
        ['\Sajari\Engine\Store\Record\ReplaceResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * Get retrieves the records corresponding to the listed keys.
     * @param \Sajari\Engine\Store\Record\Keys $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Get(\Sajari\Engine\Store\Record\Keys $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.engine.store.record.Store/Get',
        $argument,
        ['\Sajari\Engine\Store\Record\GetResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * Delete removes the records corresponding to the listed keys.
     * @param \Sajari\Engine\Store\Record\Keys $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Delete(\Sajari\Engine\Store\Record\Keys $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.engine.store.record.Store/Delete',
        $argument,
        ['\Sajari\Engine\Store\Record\DeleteResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * Mutate applies key-value updates to records corresponding to
     * keys.
     * @param \Sajari\Engine\Store\Record\MutateRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Mutate(\Sajari\Engine\Store\Record\MutateRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.engine.store.record.Store/Mutate',
        $argument,
        ['\Sajari\Engine\Store\Record\MutateResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * Exists
     * @param \Sajari\Engine\Store\Record\Keys $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Exists(\Sajari\Engine\Store\Record\Keys $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.engine.store.record.Store/Exists',
        $argument,
        ['\Sajari\Engine\Store\Record\ExistsResponse', 'decode'],
        $metadata, $options);
    }

}
