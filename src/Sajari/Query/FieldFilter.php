<?php

namespace Sajari\Query;

require_once __DIR__.'/../proto/engine/value.php';
require_once __DIR__.'/../proto/engine/query/v1/query.php';

class FieldFilter implements Filter, \Sajari\Engine\Proto
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
     * @return \sajariGen\engine\query\v1\Filter
     * @throws \Sajari\Error\Exception
     */
    public function Proto()
    {
        $ff = new \sajariGen\engine\query\v1\Filter\Field();
        $ff->setField($this->field);

        $ff->setValue(\Sajari\Engine\Value::ToProto($this->value));

        $op = null;
        switch ($this->operator) {
            case "=":
                $op = \sajariGen\engine\query\v1\Filter\Field\Operator::EQUAL_TO;
                break;
            case "!=":
                $op = \sajariGen\engine\query\v1\Filter\Field\Operator::NOT_EQUAL_TO;
                break;
            case ">":
                $op = \sajariGen\engine\query\v1\Filter\Field\Operator::GREATER_THAN;
                break;
            case ">=":
                $op = \sajariGen\engine\query\v1\Filter\Field\Operator::GREATER_THAN_OR_EQUAL_TO;
                break;
            case "<":
                $op = \sajariGen\engine\query\v1\Filter\Field\Operator::LESS_THAN;
                break;
            case "<=":
                $op = \sajariGen\engine\query\v1\Filter\Field\Operator::LESS_THAN_OR_EQUAL_TO;
                break;
            case "~":
                $op = \sajariGen\engine\query\v1\Filter\Field\Operator::CONTAINS;
                break;
            case "!~":
                $op = \sajariGen\engine\query\v1\Filter\Field\Operator::DOES_NOT_CONTAIN;
                break;
            case "$":
                $op = \sajariGen\engine\query\v1\Filter\Field\Operator::HAS_SUFFIX;
                break;
            case "^":
                $op = \sajariGen\engine\query\v1\Filter\Field\Operator::HAS_PREFIX;
                break;

            default:
                throw new \Sajari\Error\Exception(sprintf("invalid field filter operator: %s", $op), 1);
        }
        $ff->setOperator($op);

        $f = new \sajariGen\engine\query\v1\Filter();
        $f->setField($ff);

        return $f;
    }
}
