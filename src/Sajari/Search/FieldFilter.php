<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/value.php';
require_once __DIR__.'/../proto/engine/query/v1/query.php';

class FieldFilter implements Filter, Proto
{
    /** @var integer $operator */
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
        switch ($operator) {
            case "=":
                $this->operator = \sajari\engine\query\v1\Filter\Field\Operator::EQUAL_TO;
                break;
            case "!=":
                $this->operator = \sajari\engine\query\v1\Filter\Field\Operator::NOT_EQUAL_TO;
                break;
            case ">":
                $this->operator = \sajari\engine\query\v1\Filter\Field\Operator::GREATER_THAN;
                break;
            case ">=":
                $this->operator = \sajari\engine\query\v1\Filter\Field\Operator::GREATER_THAN_OR_EQUAL_TO;
                break;
            case "<":
                $this->operator = \sajari\engine\query\v1\Filter\Field\Operator::LESS_THAN;
                break;
            case "<=":
                $this->operator = \sajari\engine\query\v1\Filter\Field\Operator::LESS_THAN_OR_EQUAL_TO;
                break;
            case "~":
                $this->operator = \sajari\engine\query\v1\Filter\Field\Operator::CONTAINS;
                break;
            case "!~":
                $this->operator = \sajari\engine\query\v1\Filter\Field\Operator::DOES_NOT_CONTAIN;
                break;
            case "$":
                $this->operator = \sajari\engine\query\v1\Filter\Field\Operator::HAS_SUFFIX;
                break;
            case "^":
                $this->operator = \sajari\engine\query\v1\Filter\Field\Operator::HAS_PREFIX;
                break;

            default:
                throw new \Exception(sprintf("invalid field filter operator: %s", $operator), 1);
        }
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
     * @return \sajari\engine\query\v1\Filter
     */
    public function Proto()
    {
        $ff = new \sajari\engine\query\v1\Filter\Field();
        $ff->setField($this->field);

        $value = new \sajari\engine\Value();
        if (is_array($this->value)) {
          $repeated = new \sajari\engine\Value\Repeated();
          foreach ($this->value as $v) {
            $repeated->addValues($v);
          }
          $value->setRepeated($repeated);
        } else if (is_null($this->value)) {
          $value->setNull(true);
        } else {
          $value->setSingle($this->value);
        }

        $ff->setValue($value);
        $ff->setOperator($this->operator);

        $f = new \sajari\engine\query\v1\Filter();
        $f->setField($ff);

        return $f;
    }
}
