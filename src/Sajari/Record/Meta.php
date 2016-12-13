<?php

namespace Sajari\Record;

use sajari\engine\Value;
use sajari\engine\Value\Repeated;
use sajari\engine\store\record\KeysValues\KeyValues\Value as KeyValueValue;
use sajari\engine\store\record\KeysValues\KeyValues\ValuesEntry;

class Meta
{
    private $key;
    private $value;

    /**
     * Meta constructor.
     * @param $key
     * @param $value
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return ValuesEntry
     */
    public function Proto()
    {
        $actualValue = new Value();

        if (is_array($this->value)) {
          $repeated = new Repeated();
          foreach ($this->value as $v) {
            $repeated->addValues($v);
          }
          $actualValue->setRepeated($repeated);
        } else if (is_null($this->value)) {
          $actualValue->setNull(true);
        } else {
          $actualValue->setSingle($this->value);
        }

        $v = new KeyValueValue();
        $v->setSet($actualValue);

        $protoMeta = new ValuesEntry();
        $protoMeta->setKey($this->key);
        $protoMeta->setValue($v);
        return $protoMeta;
    }
}
