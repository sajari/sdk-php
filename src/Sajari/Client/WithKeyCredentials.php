<?php

namespace Sajari\Client;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

class WithKeyCredentials implements Opt
{
    /** @var $auth string */
    private $auth;

    /**
     * WithAuth constructor. Takes a key and secret supplied from the Sajari admin console.
     * @param string $key
     * @param string $secret
     */
    public function __construct($key, $secret)
    {
        $this->auth = sprintf("keysecret %s %s", $key, $secret);
    }

    /**
     * @param \Sajari\Client\Client $c
     */
    public function Apply(Client $c)
    {
        $c->setAuth($this->auth);
    }
}
