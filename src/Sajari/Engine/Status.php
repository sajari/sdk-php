<?php

namespace Sajari\Engine;

/**
 * Class Status
 * @package Sajari\Engine
 */
class Status
{
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
     * @param \sajari\engine\Status $protoStatus
     * @return Status
     */
    public static function FromProto(\sajari\engine\Status $protoStatus)
    {
        return new Status($protoStatus->getCode(), $protoStatus->getMessage());
    }
}