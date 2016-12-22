<?php

namespace Sajari\Record;

use sajari\engine\Value as EngineValue;

class Value
{
    /** @var string $key */
    private $key;
    private $value;

    /**
     * Value constructor.
     * @param string $key
     * @param $value
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @param string $key
     * @param \sajari\engine\Value $protoValue
     * @return Value
     */
    public static function FromProto($key, \sajari\engine\Value $protoValue)
    {
        if ($protoValue->hasSingle()) {
          return new Value($key, $protoValue->getSingle());
        } else if ($protoValue->hasRepeated()) {
          return new Value($key, $protoValue->getRepeated()->getValuesList());
        } else {
          return new Value($key, null);
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
     * @return \sajari\engine\store\record\KeysValues\KeyValues\ValuesEntry
     */
    public function Proto()
    {
        $actualValue = new \sajari\engine\Value();

        if (is_array($this->value)) {
          $repeated = new \sajari\engine\Value\Repeated();
          foreach ($this->value as $v) {
            $repeated->addValues($v);
          }
          $actualValue->setRepeated($repeated);
        } else if (is_null($this->value)) {
          $actualValue->setNull(true);
        } else {
          $actualValue->setSingle($this->value);
        }

        $v = new \sajari\engine\store\record\KeysValues\KeyValues\Value();
        $v->setSet($actualValue);

        $protoMeta = new \sajari\engine\store\record\KeysValues\KeyValues\ValuesEntry();
        $protoMeta->setKey($this->key);
        $protoMeta->setValue($v);
        return $protoMeta;
    }
}
