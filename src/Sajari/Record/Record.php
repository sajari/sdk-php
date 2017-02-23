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
     * @param \Sajari\Engine\Store\Record\Record $protoRecord
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
     * @return \Sajari\Engine\Store\Record\Record
     */
    public function Proto()
    {
        $protoRecord = new \Sajari\Engine\Store\Record\Record();

        $records = [];
        foreach ($this->values as $field => $value) {
            // $valueEntry = new \Sajari\Engine\Store\Record\Record\ValuesEntry();
            $records[$field] = \Sajari\Value\Value::ToProto($value);
            // $valueEntry->setKey($field);
            // $valueEntry->setValue();
        }
        $protoRecord->setValues($records);

        return $protoRecord;
    }
}
