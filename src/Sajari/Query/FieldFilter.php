<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

class FieldFilter implements Filter, \Sajari\Internal\Proto
{
    /** @var string $operator */
    private $operator;

    /** @var string $field */
    private $field;

    /** @var mixed $value */
    private $value;

    /**
     * FieldFilter constructor.
     * @param string $field
     * @param string $operator
     * @param $value
     * @throws \Exception
     */
    public function __construct($field, $operator, $value)
    {
        $this->operator = $operator;
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return \Sajari\Engine\Query\V1\Filter
     * @throws \Sajari\Error\Exception
     */
    public function Proto()
    {
        $ff = new \Sajari\Engine\Query\V1\Filter_Field();
        $ff->setField($this->field);

        $ff->setValue(\Sajari\Value::ToProto($this->value));

        $op = null;
        switch ($this->operator) {
            case "=":
                $op = \Sajari\Engine\Query\V1\Filter_Field_Operator::EQUAL_TO;
                break;
            case "!=":
                $op = \Sajari\Engine\Query\V1\Filter_Field_Operator::NOT_EQUAL_TO;
                break;
            case ">":
                $op = \Sajari\Engine\Query\V1\Filter_Field_Operator::GREATER_THAN;
                break;
            case ">=":
                $op = \Sajari\Engine\Query\V1\Filter_Field_Operator::GREATER_THAN_OR_EQUAL_TO;
                break;
            case "<":
                $op = \Sajari\Engine\Query\V1\Filter_Field_Operator::LESS_THAN;
                break;
            case "<=":
                $op = \Sajari\Engine\Query\V1\Filter_Field_Operator::LESS_THAN_OR_EQUAL_TO;
                break;
            case "~":
                $op = \Sajari\Engine\Query\V1\Filter_Field_Operator::CONTAINS;
                break;
            case "!~":
                $op = \Sajari\Engine\Query\V1\Filter_Field_Operator::DOES_NOT_CONTAIN;
                break;
            case "$":
                $op = \Sajari\Engine\Query\V1\Filter_Field_Operator::HAS_SUFFIX;
                break;
            case "^":
                $op = \Sajari\Engine\Query\V1\Filter_Field_Operator::HAS_PREFIX;
                break;

            default:
                throw new \Sajari\Error\Exception(sprintf("invalid field filter operator: %s", $op), 1);
        }
        $ff->setOperator($op);

        $f = new \Sajari\Engine\Query\V1\Filter();
        $f->setField($ff);

        return $f;
    }
}
