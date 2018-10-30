<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Sajari\Autocomplete;

/**
 * Query defines methods for quering an autocomplete model.
 */
class QueryClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Autocomplete a phrase. Potentially also fix spelling mistakes.
     * @param \Sajari\Autocomplete\AutoCompleteRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function AutoComplete(\Sajari\Autocomplete\AutoCompleteRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.autocomplete.Query/AutoComplete',
        $argument,
        ['\Sajari\Autocomplete\AutoCompleteResponse', 'decode'],
        $metadata, $options);
    }

}
