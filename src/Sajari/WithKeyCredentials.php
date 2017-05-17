<?php

namespace Sajari;

/**
 * Class WithKeyCredentials
 *
 * A Client option for setting the credentials to use in each RPC call.
 *
 * @package Sajari
 */
class WithKeyCredentials implements Opt
{
    /** @var $credentials string */
    private $credentials;

    /**
     * WithKeyCredentials constructor.
     *
     * Creates a Client option for setting the credentials to use in
     * each RPC call.
     *
     * Example:
     *
     *     $client = new Client("your-project", "your-collection", [
     *         new WithKeyCredentials("key-id", "key-secret")
     *     ]);
     *
     * @param string $keyId Key ID for these credentials.
     * @param string $keySecret Key secret for these credentials.
     */
    public function __construct($keyId, $keySecret)
    {
        $this->credentials = sprintf("keysecret %s %s", $keyId, $keySecret);
    }

    /**
     * @param Client $c
     */
    public function Apply(Client $c)
    {
        $c->setCredentials($this->credentials);
    }
}
