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
                if ($v instanceof \DateTime) {
                    $repeated->addValues($v->format(\DateTime::ATOM));
                } else {
                    $repeated->addValues(sprintf("%s", $v));
                }
            }
            $protoValue->setRepeated($repeated);
        } else if (is_null($value)) {
            $protoValue->setNull(true);
        } else {
            if ($value instanceof \DateTime) {
                $protoValue->setSingle($value->format(\DateTime::ATOM));
            } else {
                $protoValue->setSingle(sprintf("%s", $value));
            }
        }

        return $protoValue;
    }
}
