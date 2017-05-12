<?php

namespace Sajari;

class WithKeyCredentials implements Opt
{
    /** @var $credentials string */
    private $credentials;

    /**
     * WithKeyCredentials constructor.
     * @param string $keyId
     * @param string $keySecret
     */
    public function __construct($keyId, $keySecret)
    {
        $this->credentials = sprintf("keysecret %s %s", $keyId, $keySecret);
    }

    /**
     * @param \Sajari\Client\Client $c
     */
    public function Apply(Client $c)
    {
        $c->setCredentials($this->credentials);
    }
}
