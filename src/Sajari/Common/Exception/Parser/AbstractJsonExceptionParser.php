<?php

namespace Sajari\Common\Exception\Parser;

use Guzzle\Http\Message\Response;

/**
 * Parses JSON encoded exception responses.
 */
abstract class AbstractJsonExceptionParser implements ExceptionParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function parse(Response $response)
    {
        // Build array of default error data
        $data = array(
            'code' => null,
            'message' => null,
            'errors' => array(),
            'type' => $response->isClientError() ? 'client' : 'server',
            'parsed' => null,
        );

        // Parse the json
        if (null !== $json = json_decode($response->getBody(true), true)) {
            $data['parsed'] = $json;
        }

        // Do additional, protocol-specific parsing and return the result
        return $this->doParse($data, $response);
    }

    /**
     * Pull relevant exception data out of the parsed json.
     *
     * @param array    $data     The exception data
     * @param Response $response The response from the service containing the error
     *
     * @return array
     */
    abstract protected function doParse(array $data, Response $response);
}
