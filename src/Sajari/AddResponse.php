<?php

namespace Sajari;

/**
 * Class AddResponse
 *
 * @package Sajari
 */
class AddResponse
{
    /** @var Key $key */
    private $key;
    /** @var Status $status */
    private $status;

    /**
     * AddResponse constructor.
     *
     * @param Status $status
     * @param Key $key
     */
    public function __construct(Status $status, Key $key = null) {
        $this->status = $status;
        $this->key = $key;
    }

    /**
     * Returns the status for this response.
     *
     * @return Status
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Returns true iff the status for this response
     * indicates that an error occurred.
     *
     * @return bool
     */
    public function isError() {
        return $this->getStatus()->isError();
    }

    /**
     * Returns the Key for this response, only valid
     * if isError() returns false.
     *
     * @return Key
     */
    public function getKey() {
        return $this->key;
    }
}
