<?php

namespace Sajari\Engine\Exception;

use Sajari\Common\Exception\NamespaceExceptionFactory as BaseNamespaceExceptionFactory;
use Guzzle\Http\Message\Response;

class NamespaceExceptionFactory extends BaseNamespaceExceptionFactory
{
    /**
     * Create an prepare an exception object
     *
     * @param string   $className Name of the class to create
     * @param Response $response  Response received
     * @param array    $parts     Parsed exception data
     *
     * @return \Exception
     */
    protected function createException($className, Response $response, array $parts)
    {
        $ex = new $className($parts['message']);

        if ($ex instanceof ServiceResponseException) {
            $ex->setExceptionCode($parts['code']);
            $ex->setExceptionType($parts['type']);
            $ex->setResponse($response);
        }

        if ($ex instanceof DocumentAlreadyExistsException &&
            1 === preg_match('/Duplicate document #(\d+)/', $parts['message'], $matches) &&
            isset($matches[1])
        ) {
            $engineDocumentId = $matches[1];
            $engineDocumentId = sprintf('1-%d', $engineDocumentId); // TODO remove when https://github.com/sajari/sjengine-v9/issues/163 is fixed
            $ex->setEngineDocumentId($engineDocumentId);
        }

        return $ex;
    }
}
