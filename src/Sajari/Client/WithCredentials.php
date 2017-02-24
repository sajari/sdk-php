<?php

namespace Sajari\Client;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

class WithCredentials implements Opt
{
    private $credentials;

    /**
     * WithCredentials constructor.
     * @param $credentials
     */
    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    public function Apply(Client $c)
    {
        $c->setCredentials($this->credentials);
    }

}
