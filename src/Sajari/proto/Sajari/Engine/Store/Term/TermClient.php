<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Sajari\Engine\Store\Term {

  // Term defines methods for accesing terms.
  class TermClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
      parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Get the term with specified values.  Ignores any values which don't
     * have an associated term.
     * @param \Sajari\Engine\Store\Term\Values $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Get(\Sajari\Engine\Store\Term\Values $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.engine.store.term.Term/Get',
      $argument,
      ['\Sajari\Engine\Store\Term\Infos', 'decode'],
      $metadata, $options);
    }

  }

}
