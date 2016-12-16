<?php

namespace Sajari\Record;

use sajari\engine\Value as EngineValue;
use sajari\engine\Value\Repeated;
use sajari\engine\store\record\KeysValues\KeyValues\Value as KeyValueValue;
use sajari\engine\store\record\KeysValues\KeyValues\ValuesEntry;

class Value
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
     * @param \sajari\engine\Value $protoValue
     * @return Value
     */
    public static function FromProtoValue($protoValue)
    {
        $v = $protoValue->getValue();
        if ($v->hasSingle()) {
          return new Value($protoValue->getKey(), $v->getSingle());
        } else if ($v->hasRepeated()) {
          return new Value($protoValue->getKey(), $v->getRepeated()->getValuesList());
        } else {
          return new Value($protoValue->getKey(), NULL);
        }
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
        $actualValue = new EngineValue();

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
