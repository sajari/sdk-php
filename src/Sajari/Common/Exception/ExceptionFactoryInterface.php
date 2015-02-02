<?php

namespace Sajari\Common\Exception;

use Guzzle\Http\Message\Response;

/**
 * Interface used to create Sajari exceptions.
 */
interface ExceptionFactoryInterface
{
    /**
     * Returns a Sajari service specific exception.
     *
     * @param Response $response Unsuccessful response that was encountered
     *
     * @return \Exception|SajariExceptionInterface
     */
    public function fromResponse(Response $response);
}
