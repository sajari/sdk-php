<?php

namespace Sajari\Record;

class Value
{
    /**\
     * @param \sajari\engine\Value $protoValue
     * @return mixed
     */
    public static function FromProto(\sajari\engine\Value $protoValue)
    {
        if ($protoValue->hasSingle()) {
          return $protoValue->getSingle();
        } else if ($protoValue->hasRepeated()) {
          return $protoValue->getRepeated()->getValuesList();
        }
        return null;
    }

    /**
     * @param mixed $value
     * @return \sajari\engine\Value
     */
    public static function ToProto($value)
    {
        $actualValue = new \sajari\engine\Value();

        if (is_array($value)) {
            $repeated = new \sajari\engine\Value\Repeated();
            foreach ($value as $v) {
                $repeated->addValues($v);
            }
            $actualValue->setRepeated($repeated);
        } else if (is_null($value)) {
            $actualValue->setNull(true);
        } else {
            $actualValue->setSingle($value);
        }

        return $actualValue;
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
