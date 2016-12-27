<?php

namespace Sajari\Record;

class Record
{
    /** @var Value[] $value */
    private $values;

    /**
     * Document constructor.
     * @param $values
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @return Value[]
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
}
