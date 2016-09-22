<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/value.php';
require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/query.php';

use sajari\engine\query\Filter\Field as ProtoField;
use sajari\engine\query\Filter as ProtoFilter;
use sajari\engine\Value;

class FieldFilter extends Filter
{
    const EQUAL_TO = 0;
    const DOES_NOT_EQUAL = 1;
    const GREATER_THAN = 2;
    const GREATER_THAN_OR_EQUAL_TO = 3;
    const LESS_THAN = 4;
    const LESS_THAN_OR_EQUAL_TO = 5;
    const CONTAINS = 6;
    const DOES_NOT_CONTAIN = 7;
    const ENDS_WITH = 8;
    const STARTS_WITH = 9;
    /** @var integer $operator */
    private $operator;
    /** @var string $field */
    private $field;
    private $value;

    /**
     * FieldFilter constructor.
     * @param int $operator
     * @param string $field
     * @param $value
     */
    public function __construct($operator, $field, $value)
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
     * @param string $field
     * @param $value
     * @return FieldFilter
     */
    public static function EqualTo($field, $value)
    {
        return new FieldFilter(FieldFilter::EQUAL_TO, $field, $value);
    }

    /**
     * @param string $field
     * @param $value
     * @return FieldFilter
     */
    public static function DoesNotEqual($field, $value)
    {
        return new FieldFilter(FieldFilter::DOES_NOT_EQUAL, $field, $value);
    }

    /**
     * @param string $field
     * @param $value
     * @return FieldFilter
     */
    public static function GreaterThan($field, $value)
    {
        return new FieldFilter(FieldFilter::GREATER_THAN, $field, $value);
    }
    /**
     * @param string $field
     * @param $value
     * @return FieldFilter
     */
    public static function GreaterThanOrEqualTo($field, $value)
    {
        return new FieldFilter(FieldFilter::GREATER_THAN_OR_EQUAL_TO, $field, $value);
    }

    /**
     * @param string $field
     * @param $value
     * @return FieldFilter
     */
    public static function LessThan($field, $value)
    {
        return new FieldFilter(FieldFilter::LESS_THAN, $field, $value);
    }

    /**
     * @param string $field
     * @param $value
     * @return FieldFilter
     */
    public static function LessThanOrEqualTo($field, $value)
    {
        return new FieldFilter(FieldFilter::LESS_THAN_OR_EQUAL_TO, $field, $value);
    }

    /**
     * @param string $field
     * @param $value
     * @return FieldFilter
     */
    public static function Contains($field, $value)
    {
        return new FieldFilter(FieldFilter::CONTAINS, $field, $value);
    }

    /**
     * @param string $field
     * @param $value
     * @return FieldFilter
     */
    public static function DoesNotContain($field, $value)
    {
        return new FieldFilter(FieldFilter::DOES_NOT_CONTAIN, $field, $value);
    }

    /**
     * @param string $field
     * @param $value
     * @return FieldFilter
     */
    public static function EndsWith($field, $value)
    {
        return new FieldFilter(FieldFilter::ENDS_WITH, $field, $value);
    }

    /**
     * @param string $field
     * @param $value
     * @return FieldFilter
     */
    public static function StartsWith($field, $value)
    {
        return new FieldFilter(FieldFilter::STARTS_WITH, $field, $value);
    }

    /**
     * @return engine\query\Filter\Field
     */
    public function Proto()
    {
        $ff = new ProtoField();
        $ff->setField($this->field);
        $v = new Value();
        $v->setSingle($this->value); // TODO(tbillington): Handle multiple
        $ff->setValue($v);
        $ff->setOperator($this->operator);

        $f = new ProtoFilter();
        $f->setField($ff);

        return $f;
    }
}
