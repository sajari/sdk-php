<?php

namespace Sajari\Client;

class MockQueryClient extends \sajari\api\query\v1\QueryClient
{
    public function __construct()
    {
        parent::__construct("test", [
            'credentials' => \Grpc\ChannelCredentials::createSsl()
        ], null);
    }
}

class DeleteWaiter
{
    private $response;
    public function __construct($response)
    {
        $this->response = $response;
    }

    public function wait()
    {
        return $this->response;
    }
}

class MockStatus
{
    public $code;
    public $details;

    public function __construct($code, $details)
    {
        $this->code = $code;
        $this->details = $details;
    }
}

class MockStoreClient extends \sajari\engine\store\record\StoreClient
{
    public $deleteArgs;

    public function __construct()
    {
        parent::__construct("test", [
            'credentials' => \Grpc\ChannelCredentials::createSsl()
        ], null);
    }

    public function Delete(\sajari\engine\store\record\Keys $argument, $metadata = array(), $options = array())
    {
        $this->deleteArgs = func_get_args();

        $response = new \sajari\engine\store\record\DeleteResponse();
        $status = new \sajari\engine\Status();
        $status->setCode(0);
        $response->setStatus($status);

        return new DeleteWaiter([$response, new MockStatus(0, '')]);
    }
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

    public function testDeleteSuccessful()
    {
        $mockQueryClient = new MockQueryClient();
        $mockStoreClient = new MockStoreClient();
        $client = new \Sajari\Client\Client($mockQueryClient, $mockStoreClient, "", "", [
            new \Sajari\Client\WithAuth("", "")
        ]);

        $key = new \Sajari\Record\Key("id", "value");

        try {
            $status = $client->Delete($key);
        } catch (\Exception $e) {
            $this->fail($e);
            return;
        }

        $this->assertNull($status);

        $expectedKeys = new \sajari\engine\store\record\Keys();
        $expectedKeys->addKeys($key->ToProto());

        $this->assertEquals($expectedKeys, $mockStoreClient->deleteArgs[0]);
    }
}
