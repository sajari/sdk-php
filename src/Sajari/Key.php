<?php

namespace Sajari;

/**
 * Class Key
 *
 * @package Sajari
 */
class Key
{
    /** @var $field string */
    private $field;

    /** @var $value mixed */
    private $value;

    /**
     * Key constructor.
     * @param $field string
     * @param $value mixed
     */
    public function __construct($field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function __toString() {
        return sprintf("Key<%s:%s>", $this->field, $this->value);
    }
}
