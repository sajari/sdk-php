<?php

namespace Sajari\Misc;

/**
 * Class Value
 * @package Sajari\Record
 */
class Value
{
    /**
     * @param \Sajari\Engine\Value $protoValue
     * @return mixed
     */
    public static function FromProto(\Sajari\Engine\Value $protoValue)
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
     * @return \Sajari\Engine\Value
     */
    public static function ToProto($value)
    {
        $protoValue = new \Sajari\Engine\Value();

        if (is_array($value)) {
            $repeated = new \Sajari\Engine\Value_Repeated();
            foreach ($value as $v) {
                if ($v instanceof \DateTime) {
                    $repeated->addValues($v->format(\DateTime::ATOM));
                } else if ($v === true) {
                    $repeated->addValues("true");
                } else if ($v === false) {
                    $repeated->addValues("false");
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
            } else if ($value === true) {
                $protoValue->setSingle("true");
            } else if ($value === false) {
                $protoValue->setSingle("false");
            } else {
                $protoValue->setSingle(sprintf("%s", $value));
            }
        }

        return $protoValue;
    }
}
