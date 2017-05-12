<?php

namespace Sajari\Record;

/**
 * Class Transform
 * @package Sajari\Record
 */
class Transform implements \Sajari\Internal\Proto
{
    /** @var string $transform */
    private $transform;

    /**
     * Transform constructor.
     * @param string $transform
     */
    public function __construct($transform)
    {
        $this->transform = $transform;
    }

    /**
     * @return Transform
     */
    public static function StopStem()
    {
        return new Transform("stop-stem");
    }

    /**
     * @return Transform
     */
    public static function SplitIndexedFields()
    {
        return new Transform("split-indexed-fields");
    }

    /**
     * @return Transform
     */
    public static function SplitStopStemIndexedFields()
    {
        return new Transform("split-stop-stem-indexed-fields");
    }

    /**
     * @return \sajariGen\engine\store\record\Transform
     */
    public function Proto()
    {
        $protoTransform = new \Sajari\Engine\Store\Record\Transform();
        $protoTransform->setIdentifier($this->transform);
        return $protoTransform;
    }
}
