<?php

namespace Sajari\Internal;

class Record
{
    /**
     * @param \Sajari\Engine\Store\Record\Record $protoRecord
     * @return array
     */
    public static function fromProto(\Sajari\Engine\Store\Record\Record $protoRecord)
    {
        $values = [];
        foreach ($protoRecord->getValues() as $k => $v) {
            $values[$k] = \Sajari\Internal\Value::fromProto($v);
        }
        return $values;
    }

    /**
     * @param array Associated array of field-value pairs.
     * @return \Sajari\Engine\Store\Record\Record
     */
    public static function toProto(array $values)
    {
        $protoRecord = new \Sajari\Engine\Store\Record\Record();
        $fields = [];
        foreach ($values as $field => $value) {
            $fields[$field] = Value::toProto($value);
        }
        $protoRecord->setValues($fields);
        return $protoRecord;
    }
}
