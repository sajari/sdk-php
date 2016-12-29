<?php

namespace Sajari\Client;

class MockIndexClient
{

}

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultClientCreation()
    {
        $this->assertNotNull(
            \Sajari\Client\Client::NewClient(
                'project',
                'collection',
                []
            )
        );
    }

    public function testDelete()
    {

    }
}
