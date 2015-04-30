<?php

namespace Sajari\Common\Exception\Parser;

use Guzzle\Http\Message\Response;

/**
 * Interface used to parse exceptions into an associative array of data.
 */
interface ExceptionParserInterface
{
    /**
     * Parses an exception into an array of data containing at minimum the
     * following array keys:
     * - type:       Exception type
     * - code:       Exception code
     * - message:    Exception message
     * - errors:     Exception errors
     * - parsed:     The parsed representation of the data (array, SimpleXMLElement, etc).
     *
     * @param Response $response Unsuccessful response
     *
     * @return array
     */
    public function parse(Response $response);
}
