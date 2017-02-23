<?php

namespace Sajari\Record;

class Record implements \Sajari\Internal\Proto
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
    public static function FromProto(\Sajari\Engine\Store\Record\Record $protoRecord)
    {
        $values = [];

        foreach ($protoRecord->getValues() as $k => $v) {
            $values[$k] = \Sajari\Value\Value::FromProto($v);
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
