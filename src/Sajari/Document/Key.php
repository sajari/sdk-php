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
     * @return \sajari\engine\Key
     */
    public function Proto()
    {
        $protoKey = new \sajari\engine\Key();
        $protoKey->setField($this->field);

        $value = new \sajari\engine\Value();
        if (is_array($this->value)) {
          $repeated = new \sajari\engine\Value\Repeated();
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
