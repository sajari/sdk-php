<?php

namespace Sajari;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

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
        switch ($protoValue->getValue()) {
            case 'null':
                return null;
            case 'single':
                return $protoValue->getSingle();
            case 'repeated':
                $valueArray = [];
                foreach ($protoValue->getRepeated()->getValues() as $value) {
                    $valueArray[] = $value;
                }
                return $valueArray;
        }
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
                    $repeated->getValues()[] = $v->format(\DateTime::ATOM);
                } else if ($v === true) {
                    $repeated->getValues()[] = "true";
                } else if ($v === false) {
                    $repeated->getValues()[] = "false";
                } else {
                    $repeated->getValues()[] = sprintf("%s", $v);
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
