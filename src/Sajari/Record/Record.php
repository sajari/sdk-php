<?php

namespace Sajari\Record;

class Record implements \Sajari\Engine\Proto
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
     * @param \sajariGen\engine\store\record\Record $protoRecord
     * @return Record
     */
    public static function FromProto(\sajariGen\engine\store\record\Record $protoRecord)
    {
        $values = [];

        foreach ($protoRecord->getValuesList() as $v) {
            $values[$v->getKey()] = \Sajari\Engine\Value::FromProto($v->getValue());
        }

        return new Record($values);
    }

    /**
     * @return \sajariGen\engine\store\record\Record
     */
    public function Proto()
    {
        $protoRecord = new \sajariGen\engine\store\record\Record();

        foreach ($this->values as $field => $value) {
            $valueEntry = new \sajariGen\engine\store\record\Record\ValuesEntry();
            $valueEntry->setKey($field);
            $valueEntry->setValue(\Sajari\Engine\Value::ToProto($value));
            $protoRecord->addValues($valueEntry);
        }

        return $protoRecord;
    }
}
