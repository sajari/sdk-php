<?php

namespace Sajari\Engine\Tests;

use Guzzle\Http\Client as HttpClient;
use Guzzle\Http\Message\Response;
use Guzzle\Plugin\Mock\MockPlugin;
use Sajari\Engine\EngineClient;

class EngineClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MockPlugin
     */
    private $clientMocker;

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var EngineClient
     */
    private $engineClient;

    protected function setUp()
    {
        $this->httpClient = new HttpClient('http://localhost');
        $this->clientMocker = new MockPlugin();
        $this->httpClient->addSubscriber($this->clientMocker);

        $this->engineClient = new EngineClient($this->httpClient, array(
            'collection_name' => 'widgets',
        ));
    }

    /**
     * @dataProvider exceptionToResponseDataProvider
     */
    public function testExceptionHandling($expectedException, $response)
    {
        $this->setExpectedException($expectedException);

        $this->clientMocker->addResponse(new Response(
            0,
            null,
            $response
        ));

        $this->engineClient->add('dummy_input_data');
    }

    /**
     * @param string $expectedEncodedFilters
     * @param array  $filters
     *
     * @dataProvider filterDataProvider
     */
    public function testFilters($expectedEncodedFilters, $filters)
    {
        $this->clientMocker->addResponse(new Response(
            200,
            null,
            '{"statusCode":200,"response":{"results":[]},"msecs":1}'
        ));

        $this->engineClient->find(10, array(), array(), $filters);

        $fields = current($this->clientMocker->getReceivedRequests())
            ->getPostFields();

        $this->assertEquals($expectedEncodedFilters, $fields['filters']);
    }

    /**
     * @param string $expectedEncodedScales
     * @param array  $scales
     *
     * @dataProvider scaleDataProvider
     */
    public function testScales($expectedEncodedScales, $scales)
    {
        $this->clientMocker->addResponse(new Response(
            200,
            null,
            '{"statusCode":200,"response":{"results":[]},"msecs":1}'
        ));

        $this->engineClient->find(10, array(), $scales, array());

        $fields = current($this->clientMocker->getReceivedRequests())
            ->getPostFields();

        $this->assertEquals($expectedEncodedScales, $fields['scales']);
    }

    /**
     * @param array $invalidScales
     *
     * @dataProvider invalidScaleDataProvider
     *
     * @expectedException Sajari\Common\Exception\InvalidArgumentException
     */
    public function testInvalidScales($invalidScales)
    {
        $this->clientMocker->addResponse(new Response(
            200,
            null,
            '{"statusCode":200,"response":{"results":[]},"msecs":1}'
        ));

        $this->engineClient->find(10, array(), $invalidScales, array());
    }

    public function testAddReturnsDocumentId()
    {
        $this->clientMocker->addResponse(new Response(
            200,
            null,
            '{"statusCode":200,"response":{"docId":"1-1"},"msecs":1}'
        ));

        $result = $this->engineClient->add('dummy_input_data');

        $expectedResult = '1-1';

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @dataProvider emptyResponseDataProvider
     */
    public function testAddWhenResponseIsEmpty($emptyResponse)
    {
        $this->clientMocker->addResponse(new Response(
            200,
            null,
            $emptyResponse
        ));

        $this->engineClient->add('dummy_input_data');
    }

    public function filterDataProvider()
    {
        return array(
            array('', array()),
            array('id,1', array(
                array(
                    'id' => 1,
                ),
            )),
            array('id,1,2,3', array(
                array(
                    'id' => array(1, 2, 3),
                ),
            )),
            array('id,1|name,foo', array(
                array(
                    'id' => 1,
                ),
                array(
                    'name' => 'foo',
                ),
            )),
            array('id,1|OR:name,foo', array(
                array(
                    'id' => 1,
                ),
                array(
                    'OR:name' => 'foo',
                ),
            )),
        );
    }

    public function scaleDataProvider()
    {
        return array(
            array('', array()),
            array('foo,1234,100,1.10,0.10', array(
                array(
                    'meta' => 'foo',
                    'center' => 1234,
                    'radius' => 100,
                    'start' => 1.1,
                    'end' => 0.1,
                ),
            )),
            array('foo,1234,100,1.00,0.00', array(
                array(
                    'meta' => 'foo',
                    'center' => 1234,
                    'radius' => 100,
                    'start' => 1,
                    'end' => 0.0,
                ),
            )),
            array('foo,1234,100,1.10,0.10|bar,5678,10,1.00,1.00', array(
                array(
                    'meta' => 'foo',
                    'center' => 1234,
                    'radius' => 100,
                    'start' => 1.1,
                    'end' => 0.1,
                ),
                array(
                    'meta' => 'bar',
                    'center' => 5678,
                    'radius' => 10,
                    'start' => 1,
                    'end' => 1,
                ),
            )),
        );
    }

    public function invalidScaleDataProvider()
    {
        return array(
            array(array(
                '',
            )),
            array(array(
                array(
                    'meta' => 'foo',
                ),
            )),
            array(array(
                array(
                    'center' => 1234,
                ),
            )),
            array(array(
                array(
                    'radius' => 100,
                ),
            )),
            array(array(
                array(
                    'start' => 1.1,
                ),
            )),
            array(array(
                array(
                    'end' => 1.1,
                ),
            )),
        );
    }

    public function exceptionToResponseDataProvider()
    {
        return array(
            array(null, '{"statusCode":200,"response":{},"msecs":1}'),
            array(null, '{"statusCode":200,"response":false,"msecs":1}'),
            array(null, '{"statusCode":200}'),
            array('Sajari\Engine\Exception\EngineException', '{"statusCode":400,"response":{},"msecs":1}'),
        );
    }

    public function emptyResponseDataProvider()
    {
        return array(
            array('{"statusCode":200,"response":{},"msecs":1}'),
            array('{"statusCode":200,"response":false,"msecs":1}'),
            array('{"statusCode":200}'),
        );
    }
}
