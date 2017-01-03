<?php

namespace Sajari\Record;

class Record
{
    /** @var mixed[] $values */
    private $values;

    /**
     * Document constructor.
     * @param mixed[] $values
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @return mixed[]
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param \sajari\engine\store\record\Record $protoRecord
     * @return Record
     */
    public static function FromProto(\sajari\engine\store\record\Record $protoRecord)
    {
        $values = [];

        foreach ($protoRecord->getValuesList() as $v) {
            $values[$v->getKey()] = \Sajari\Record\Value::FromProto($v->getValue());
        }

        return new Record($values);
    }

    /**
     * @return \sajari\engine\store\record\Record
     */
    public function ToProto()
    {
        $protoRecord = new \sajari\engine\store\record\Record();

        foreach ($this->values as $field => $value) {
            $valueEntry = new \sajari\engine\store\record\Record\ValuesEntry();
            $valueEntry->setKey($field);
            $valueEntry->setValue(Value::ToProto($value));
            $protoRecord->addValues($valueEntry);
        }

        return $protoRecord;
    }
}
