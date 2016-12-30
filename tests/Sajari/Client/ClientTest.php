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

        $response = new \sajari\engine\store\record\DeleteResponse();
        $status = new \sajari\engine\Status();
        $status->setCode(0);
        $response->setStatus($status);

        $storeStub = $this
            ->getMockBuilder(\sajari\engine\store\record\StoreClient::class)
            ->disableOriginalConstructor()
            ->getMock();
        $storeStub
            ->method("Delete")
            ->willReturn(new DeleteWaiter([$response, new MockStatus(0, '')]));

        $client = new \Sajari\Client\Client($mockQueryClient, $storeStub, "", "", [
            new \Sajari\Client\WithAuth("", "")
        ]);

        $key = new \Sajari\Record\Key("id", "value");

        $expectedKeys = new \sajari\engine\store\record\Keys();
        $expectedKeys->addKeys($key->ToProto());

        $storeStub
            ->expects($this->once())
            ->method("Delete")
            ->with($this->equalTo($expectedKeys));

        try {
            $status = $client->Delete($key);
        } catch (\Exception $e) {
            $this->fail($e);
            return;
        }

        $this->assertNull($status);
    }

    public function testDeleteError()
    {
        $mockQueryClient = new MockQueryClient();

        $expectedException = new \Exception();

        $storeStub = $this
            ->getMockBuilder(\sajari\engine\store\record\StoreClient::class)
            ->disableOriginalConstructor()
            ->getMock();
        $storeStub
            ->method("Delete")
            ->willThrowException($expectedException);

        $client = new \Sajari\Client\Client($mockQueryClient, $storeStub, "", "", [
            new \Sajari\Client\WithAuth("", "")
        ]);

        $key = new \Sajari\Record\Key("id", "value");

        try {
            $client->Delete($key);
        } catch (\Exception $e) {
            $this->assertSame($expectedException, $e);
            return;
        }
        $this->fail("error: Exception should have been thrown");
    }
}
