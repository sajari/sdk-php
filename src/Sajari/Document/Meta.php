<?php

namespace Sajari\Document;

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
     * @return \sajari\engine\store\doc\KeysValues\KeyValues\ValuesEntry
     */
    public function Proto()
    {
        $actualValue = new \sajari\engine\Value();

        if (is_array($this->value)) {
          $actualValue->setMultiple($this->value);
        } else {
          $actualValue->setSingle($this->value);
        }

        $v = new \sajari\engine\store\doc\KeysValues\KeyValues\Value();
        $v->setSet($actualValue);

        $protoMeta = new \sajari\engine\store\doc\KeysValues\KeyValues\ValuesEntry();
        $protoMeta->setKey($this->key);
        $protoMeta->setValue($v);
        return $protoMeta;
    }
}
