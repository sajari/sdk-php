<?php

namespace Sajari\Misc;

/**
 * Class Key
 * @package Sajari\Record
 */
class Key implements \Sajari\Engine\Proto
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
     * @param \sajariGen\engine\Key $engineKey
     * @return Key
     */
    public static function FromProto(\sajariGen\engine\Key $engineKey)
    {
        $v = $engineKey->getValue();
        if ($v->hasSingle()) {
            return new Key($engineKey->getField(), $v->getSingle());
        } else if ($v->hasRepeated()) {
            return new Key($engineKey->getField(), $v->getRepeated()->getValuesList());
        } else {
            return new Key($engineKey->getField(), NULL);
        }
    }

    /**
     * @return \sajariGen\engine\Key
     */
    public function Proto()
    {
        $protoKey = new \sajariGen\engine\Key();
        $protoKey->setField($this->field);

        $value = new \sajariGen\engine\Value();
        if (is_array($this->value)) {
          $repeated = new \sajariGen\engine\Value\Repeated();
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

    /**
     * @return string
     * @codeCoverageIgnore
     */
    function __toString()
    {
        return sprintf("Key{ field: %s, value: %s }", $this->field, $this->value);
    }
}
