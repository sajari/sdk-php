<?php

namespace Sajari\Record;

class Value
{
    /**
     * @param \sajari\engine\Value $protoValue
     * @return mixed
     */
    public static function FromProto(\sajari\engine\Value $protoValue)
    {
        if ($protoValue->hasSingle()) {
          return $protoValue->getSingle();
        } else if ($protoValue->hasRepeated()) {
          return $protoValue->getRepeated()->getValuesList();
        }
        return null;
    }

    /**
     * @param mixed $value
     * @return \sajari\engine\Value
     */
    public static function ToProto($value)
    {
        $protoValue = new \sajari\engine\Value();

        if (is_array($value)) {
            $repeated = new \sajari\engine\Value\Repeated();
            foreach ($value as $v) {
                $repeated->addValues($v);
            }
            $protoValue->setRepeated($repeated);
        } else if (is_null($value)) {
            $protoValue->setNull(true);
        } else {
            $protoValue->setSingle($value);
        }

        return $protoValue;
    }
}
