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
     * @param string $field  Field name.
     * @param mixed $value Value in the field.
     */
    public function __construct($field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * Get the field of the key.
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Get the value of the key.
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
