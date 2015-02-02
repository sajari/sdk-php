<?php

namespace Sajari\Common\Exception;

use Guzzle\Http\Message\Response;

/**
 * ServiceResponseException for Sajari SDK.
 *
 * @author Jonathan Ingram <jingram@sajari.com>
 */
class ServiceResponseException extends RuntimeException
{
    /**
     * @var Response Response
     */
    protected $response;

    /**
     * @var string Exception type (client / server)
     */
    protected $exceptionType;

    /**
     * @var string Exception code
     */
    protected $exceptionCode;

    /**
     * Set the exception code.
     *
     * @param string $code Exception code
     */
    public function setExceptionCode($code)
    {
        $this->exceptionCode = $code;
    }

    /**
     * Get the exception code.
     *
     * @return string|null
     */
    public function getExceptionCode()
    {
        return $this->exceptionCode;
    }

    /**
     * Set the exception type.
     *
     * @param string $type Exception type
     */
    public function setExceptionType($type)
    {
        $this->exceptionType = $type;
    }

    /**
     * Get the exception type (one of client or server).
     *
     * @return string|null
     */
    public function getExceptionType()
    {
        return $this->exceptionType;
    }

    /**
     * Set the associated response.
     *
     * @param Response $response Response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     * Get the associated response object.
     *
     * @return Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Get the status code of the response.
     *
     * @return int|null
     */
    public function getStatusCode()
    {
        return $this->response ? $this->response->getStatusCode() : null;
    }

    /**
     * Cast to a string.
     *
     * @return string
     */
    public function __toString()
    {
        return get_class($this).': '
            .'Sajari error code: '.$this->getExceptionCode().', '
            .'Status code: '.$this->getStatusCode().', '
            .'Sajari error type: '.$this->getExceptionType().', '
            .'Sajari error message: '.$this->getMessage();
    }
}
