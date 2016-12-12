<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/value.php';
require_once __DIR__.'/../proto/engine/query/v1/query.php';

use sajari\engine\query\v1\Filter\Field as EngineFilterField;
use sajari\engine\query\v1\Filter as EngineFilter;
use sajari\engine\Value;
use sajari\engine\Value\Repeated;

use sajari\engine\query\v1\Filter\Field\Operator;

class FieldFilter extends Filter
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
     */
    public function __construct($field, $operator, $value)
    {
        switch ($operator) {
            case "=":
                $this->operator = Operator::EQUAL_TO;
                break;
            case "!=":
                $this->operator = Operator::NOT_EQUAL_TO;
                break;
            case ">":
                $this->operator = Operator::GREATER_THAN;
                break;
            case ">=":
                $this->operator = Operator::GREATER_THAN_OR_EQUAL_TO;
                break;
            case "<":
                $this->operator = Operator::LESS_THAN;
                break;
            case "<=":
                $this->operator = Operator::LESS_THAN_OR_EQUAL_TO;
                break;
            case "~":
                $this->operator = Operator::CONTAINS;
                break;
            case "!~":
                $this->operator = Operator::DOES_NOT_CONTAIN;
                break;
            case "$":
                $this->operator = Operator::HAS_SUFFIX;
                break;
            case "^":
                $this->operator = Operator::HAS_PREFIX;
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
     * @return engine\query\Filter\Field
     */
    public function Proto()
    {
        $ff = new EngineFilterField();
        $ff->setField($this->field);

        $value = new Value();
        if (is_array($this->value)) {
          $repeated = new Repeated();
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

        $f = new EngineFilter();
        $f->setField($ff);

        return $f;
    }
}
