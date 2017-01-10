<?php

namespace Sajari\Record;

/**
 * Class Transform
 * @package Sajari\Record
 */
class Transform implements \Sajari\Engine\Proto
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
    public static function StopStemmer()
    {
        return new Transform("stop-stemmer");
    }

    /**
     * @return Transform
     */
    public static function SplitIndexFields()
    {
        return new Transform("split-index-fields");
    }

    /**
     * @return \sajariGen\engine\store\record\Transform
     */
    public function Proto()
    {
        $protoTransform = new \sajariGen\engine\store\record\Transform();
        $protoTransform->setIdentifier($this->transform);
        return $protoTransform;
    }
}