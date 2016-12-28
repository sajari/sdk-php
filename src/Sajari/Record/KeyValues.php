<?php

namespace Sajari\Record;

class KeyValues
{
    /** @var Key $key */
    private $key;
    /** @var \Sajari\Record\KeyValue[] $values */
    private $values;

    /**
     * KeyValue constructor.
     * @param Key $key
     * @param \Sajari\Record\KeyValue[] $values
     */
    public function __construct(Key $key, array $values)
    {
        $this->key = $key;
        $this->values = $values;
    }

    /**
     * @return Key
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return Value[]
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @return \sajari\engine\store\record\KeysValues\KeyValues
     */
    public function ToProto()
    {
        $protoKeyValue = new \sajari\engine\store\record\KeysValues\KeyValues();

        $k = new \sajari\engine\Key();
        $k->setField($this->key->getField());

        $v = new \sajari\engine\Value();

        $v->setSingle($this->key->getValue());
        $k->setValue($v);

        $protoKeyValue->setKey($k);

        foreach ($this->values as $m) {
            $protoKeyValue->addValues($m->ToProto());
        }

        return $protoKeyValue;
    }
}
