<?php

namespace Sajari;

/**
 * Class Status
 * @package Sajari
 */
class Status
{
    /**
     * OK is returned on success.
     */
    const OK = 0;

    /**
     * Canceled indicates the operation was cancelled (typically by the caller).
     */
    const CANCELED = 1;

    /**
     * Unknown error.
     */
    const UNKNOWN = 2;

    /**
     * Invalid argument indicates client specified an invalid argument.
     */
    const INVALID_ARGUMENT = 3;

    /**
     * Deadline exceeded means operation expired before completion.
     * For operations that change the state of the system, this error may be
     * returned even if the operation has completed successfully. For
     * example, a successful response from a server could have been delayed
     * long enough for the deadline to expire.
     */
    const DEADLINE_EXCEEDED = 4;

    /**
     * Not found means some requested entity (e.g., record, collection) was
     * not found.
     */
    const NOT_FOUND = 5;

    /**
     * Already exists means an attempt to create an entity failed because one
     * already exists.
     */
    const ALREADY_EXISTS = 6;

    /**
     * Permission denied indicates the caller does not have permission to
     * execute the specified operation.
     */
    const PERMISSION_DENIED = 7;

    /**
     * Unauthenticated indicates the request does not have valid
     * authentication credentials for the operation.
     */
    const UNAUTHENTICATED = 16;

    /**
     * Resource exhausted indicates some resource has been exhausted, perhaps
     * a per-user quota.
     */
    const RESOURCE_EXHAUSTED = 8;

    /**
     * Failed precondition indicates operation was rejected because the
     * system is not in a state required for the operation's execution.
     */
    const FAILED_PRECONDITION = 9;

    /**
     * Aborted indicates the operation was aborted, typically due to a
     * concurrency issue like sequencer check failures, transaction aborts,
     * etc.
     */
    const ABORTED = 10;

    /**
     * Out of range means operation was attempted past the valid range.
     */
    const OUT_OF_RANGE = 11;

    /**
     * Unimplemented indicates operation is not implemented or not
     * supported/enabled in this service.
     */
    const UNIMPLEMENTED = 12;

    /**
     * Internal errors.
     */
    const INTERNAL = 13;

    /**
     * Unavailable indicates the service is currently unavailable.
     * This is a most likely a transient condition and may be corrected
     * by retrying with a backoff.
     */
    const UNAVAILABLE = 14;

    /**
     * Data loss indicates unrecoverable data loss or corruption.
     */
    const DATA_LOSS = 15;

    /** @var int $code */
    private $code;

    /** @var string $message */
    private $message;

    /**
     * Status constructor.
     * @param int $code
     * @param string $message
     */
    public function __construct($code, $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * Returns the code associated with this Status.
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Returns the associated message for this Status.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Returns true iff this status corresponds to an error.
     *
     * @return bool
     */
    public function isError()
    {
        return $this->getCode() !== Status::OK;
    }

    /**
     * Throws an exception if this status corresponds to an error.
     *
     * @throws \Sajari\Error\Exception
     * @throws \Sajari\Error\InvalidArgumentException
     * @throws \Sajari\Error\NotFoundException
     * @throws \Sajari\Error\AlreadyExistsException
     * @throws \Sajari\Error\PermissionDeniedException
     * @throws \Sajari\Error\UnavailableException
     * @throws \Sajari\Error\UnauthenticatedException
     */
    public function throwIfError()
    {
        switch ($this->getCode()) {
            case Status::OK:
                return;

            case Status::INVALID_ARGUMENT:
                throw new Error\InvalidArgumentException((string)$this, $this->getCode());

            case Status::NOT_FOUND:
                throw new Error\NotFoundException((string)$this, $this->getCode());

            case Status::ALREADY_EXISTS:
                throw new Error\AlreadyExistsException((string)$this, $this->getCode());

            case Status::PERMISSION_DENIED:
                throw new Error\PermissionDeniedException((string)$this, $this->getCode());

            case Status::UNAVAILABLE:
                throw new Error\UnavailableException((string)$this, $this->getCode());

            case Status::UNAUTHENTICATED:
                throw new Error\UnauthenticatedException((string)$this, $this->getCode());

            default:
                throw new Error\Exception((string)$this, $this->getCode());
        }
    }

    /**
    * @return string
    */
    public function __toString()
    {
        if (!$this->isError()) {
            return "OK";
        }
        return sprintf("%s: %s", Status::codeString($this->getCode()), $this->getMessage());
    }

    private static function codeString($code)
    {
        switch ($code){
            case Status::OK:
                return "OK";

            case Status::CANCELED:
                return "CANCELED";

            case Status::UNKNOWN:
                return "UNKNOWN";

            case Status::INVALID_ARGUMENT:
                return "INVALID_ARGUMENT";

            case Status::DEADLINE_EXCEEDED:
                return "DEADLINE_EXCEEDED";

            case Status::NOT_FOUND:
                return "NOT_FOUND";

            case Status::ALREADY_EXISTS:
                return "ALREADY_EXISTS";

            case Status::PERMISSION_DENIED:
                return "PERMISSION_DENIED";

            case Status::UNAUTHENTICATED:
                return "UNAUTHENTICATED";

            case Status::RESOURCE_EXHAUSTED:
                return "RESOURCE_EXHAUSTED";

            case Status::FAILED_PRECONDITION:
                return "FAILED_PRECONDITION";

            case Status::ABORTED:
                return "ABORTED";

            case Status::OUT_OF_RANGE:
                return "OUT_OF_RANGE";

            case Status::UNIMPLEMENTED:
                return "UNIMPLEMENTED";

            case Status::INTERNAL:
                return "INTERNAL";

            case Status::UNAVAILABLE:
                return "UNAVAILABLE";

            case Status::DATA_LOSS:
                return "DATA_LOSS";

            default:
                return "<INVALID CODE>";
         }
    }
}
