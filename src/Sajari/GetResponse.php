<?php

namespace Sajari;

/**
 * Class GetResponse
 *
 * @package Sajari
 */
class GetResponse
{
    /** @var array $record */
    private $record;
    /** @var Status $status */
    private $status;

    /**
     * GetResponse constructor.
     *
     * @param array $record
     * @param Status $status
     */
    public function __construct(array $record, Status $status) {
        $this->record = $record;
        $this->status = $status;
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
     * Returns the record for this response, only valid
     * if isError() returns false.
     *
     * @return Key
     */
    public function getRecord() {
        return $this->record;
    }
}
