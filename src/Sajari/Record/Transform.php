<?php

namespace Sajari\Record;

/**
 * Class Transform
 * @package Sajari\Record
 */
class Transform implements Proto
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
    public static function StopStemmerTransform()
    {
        return new Transform("stop-stemmer");
    }

    /**
     * @return Transform
     */
    public static function SplitIndexFieldsTransform()
    {
        return new Transform("split-index-fields");
    }

    /**
     * @return \sajari\engine\store\record\Transform
     */
    public function Proto()
    {
        $protoTransform = new \sajari\engine\store\record\Transform();
        $protoTransform->setIdentifier($this->transform);
        return $protoTransform;
    }
}