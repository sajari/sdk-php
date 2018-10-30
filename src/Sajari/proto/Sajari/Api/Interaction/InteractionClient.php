<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Sajari\Api\Interaction;

/**
 * Interaction provides methods for handling interactions with content.
 */
class InteractionClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Consume accepts and records interactions.
     * @param \Sajari\Api\Interaction\ConsumeRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Consume(\Sajari\Api\Interaction\ConsumeRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.api.interaction.Interaction/Consume',
        $argument,
        ['\Sajari\Rpc\PBEmpty', 'decode'],
        $metadata, $options);
    }

}
