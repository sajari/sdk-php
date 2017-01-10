<?php

namespace Sajari\Record;

/**
 * Class KeyValues
 * @package Sajari\Record
 */
class KeyValues implements \Sajari\Engine\Proto
{
    /** @var \Sajari\Engine\Key $key */
    private $key;
    /** @var \Sajari\Engine\KeyValue[] $values */
    private $values;

    /**
     * KeyValue constructor.
     * @param \Sajari\Engine\Key $key
     * @param \Sajari\Engine\KeyValue[] $values
     */
    public function __construct(\Sajari\Engine\Key $key, array $values)
    {
        $this->key = $key;
        $this->values = $values;
    }

    /**
     * @return \Sajari\Engine\Key
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed[]
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @return \sajariGen\engine\store\record\KeysValues\KeyValues
     */
    public function Proto()
    {
        $protoKeyValue = new \sajariGen\engine\store\record\KeysValues\KeyValues();

        $k = new \sajariGen\engine\Key();
        $k->setField($this->key->getField());

        $v = new \sajariGen\engine\Value();

        $v->setSingle($this->key->getValue());
        $k->setValue($v);

        $protoKeyValue->setKey($k);

        foreach ($this->values as $m) {
            $protoKeyValue->addValues($m->Proto());
        }

        return $protoKeyValue;
    }
}
