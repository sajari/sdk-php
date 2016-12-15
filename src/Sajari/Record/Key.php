<?php

namespace Sajari\Record;

use sajari\engine\Key as EngineKey;
use sajari\engine\Value as EngineValue;
use sajari\engine\Value\Repeated as EngineValueRepeated;

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
     * @return EngineKey
     */
    public function Proto()
    {
        $protoKey = new EngineKey();
        $protoKey->setField($this->field);

        $value = new EngineValue();
        if (is_array($this->value)) {
          $repeated = new EngineValueRepeated();
          foreach ($this->value as $v) {
            $repeated->addValues($v);
          }
          $value->setRepeated($repeated);
        } else if (is_null($this->value)) {
          $value->setNull(true);
        } else {
          $value->setSingle($this->value);
        }

        $protoKey->setValue($value);
        return $protoKey;
    }
}
