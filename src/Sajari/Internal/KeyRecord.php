<?php

namespace Sajari\Internal;

class KeyRecord
{
    /**
     * @param array Associated array of field-value pairs.
     * @return \Sajari\Engine\Store\Record\ReplaceRequest\KeyRecord
     */
    public static function toProto(\Sajari\Key $key, array $record)
    {
        $protoKeyRecord = new \Sajari\Engine\Store\Record\ReplaceRequest\KeyRecord();
        $protoKeyRecord->setKey(Key::toProto($key));
        $protoKeyRecord->setRecord(Record::toProto($record));
        return $protoKeyRecord;
    }
}
