<?php

namespace Sajari\Record;

class setField implements \Sajari\Record\FieldMutation {

    private $field;
    private $value;

    public function __construct($field, $value) {
        $this->field = $field;
        $this->value = $value;
    }

    public function Proto() {
        $protoFieldMutation = new \Sajari\Engine\Store\Record\MutateRequest_RecordMutation_FieldMutation();

        $protoFieldMutation->setField($this->field);
        $protoFieldMutation->setSet(\Sajari\Value\Value::ToProto($this->value));

        return $protoFieldMutation;
    }
}

/**
 * Class RecordMutation
 * @package Sajari\Record
 */
class RecordMutation implements \Sajari\Internal\Proto
{
    /** @var \Sajari\Key\Key $key */
    private $key;
    /** @var \Sajari\Record\FieldMutation[] $fieldMutations */
    private $fieldMutations;

    /**
     * KeyValue constructor.
     * @param \Sajari\Key\Key $key
     * @param \Sajari\Record\FieldMutation[] $fieldMutations
     */
    public function __construct(\Sajari\Key\Key $key, array $fieldMutations) {
        $this->key = $key;
        $this->fieldMutations = $fieldMutations;
    }

    public static function SetField($field, $value) {
        return new setField($field, $value);
    }

    /**
     * @return \sajariGen\engine\store\record\KeysfieldMutations\RecordMutation
     */
    public function Proto() {
        $protoKeyValue = new \Sajari\Engine\Store\Record\MutateRequest_RecordMutation();

        $k = new \Sajari\Engine\Key();
        $k->setField($this->key->getField());

        $v = new \Sajari\Engine\Value();

        $v->setSingle($this->key->getValue());
        $k->setValue($v);

        $protoKeyValue->setKey($k);

        $fieldMutations = [];
        foreach ($this->fieldMutations as $m) {
            $fieldMutations[] = $m->Proto();
        }
        $protoKeyValue->setFieldMutations(\Sajari\Internal\Utils::MakeRepeated($fieldMutations, \Google\Protobuf\Internal\GPBType::MESSAGE, \Sajari\Engine\Store\Record\MutateRequest_RecordMutation_FieldMutation::class));

        return $protoKeyValue;
    }
}
