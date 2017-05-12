<?php

namespace Sajari\Record;

/**
 * Class KeyValue
 * @package Sajari\Record
 */
class KeyValue implements \Sajari\Internal\Proto
{
    /** @var string $key */
    private $key;
    /** @var mixed $value */
    private $value;

    /**
     * KeyValue constructor.
     * @param string $key
     * @param mixed $value
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return \sajariGen\engine\store\record\KeysValues\KeyValues\ValuesEntry
     */
    public function Proto()
    {
        $protoValue = new \sajariGen\engine\store\record\KeysValues\KeyValues\Value();
        $protoValue->setSet(\Sajari\Engine\Value::ToProto($this->value));

        $protoValueEntry = new \sajariGen\engine\store\record\KeysValues\KeyValues\ValuesEntry();
        $protoValueEntry->setKey($this->key);
        $protoValueEntry->setValue($protoValue);
        return $protoValueEntry;
    }
}
