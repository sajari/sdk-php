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
     * @return \sajari\engine\store\doc\Keys\Key
     */
    public function Proto()
    {
        $protoKey = new \sajari\engine\store\doc\Keys\Key();
        $protoKey->setField($this->field);
        $protoKey->setValue($this->value);
        return $protoKey;
    }
}