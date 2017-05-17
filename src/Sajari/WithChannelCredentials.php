<?php

namespace Sajari;

class WithChannelCredentials implements Opt
{
    private $channelCredentials;

    /**
     * WithChannelCredentials constructor.
     * @param $channelCredentials
     */
    public function __construct($channelCredentials)
    {
        $this->channelCredentials = $channelCredentials;
    }

    public function Apply(Client $c)
    {
        $c->setChannelCredentials($this->channelCredentials);
    }

}
