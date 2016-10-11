<?php

namespace Sajari\Document;

class Key
{
    /** @var $field string */
    private $field;
    private $value;

    /**
     * Key constructor.
     * @param $field string
     * @param $value
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

    /**
     * @return \sajari\engine\Key
     */
    public function Proto()
    {
        $protoKey = new \sajari\engine\Key();
        $protoKey->setField($this->field);

        $value = new \sajari\engine\Value();
        $value->setSingle($this->value);

        $protoKey->setValue($value);
        return $protoKey;
    }
}
