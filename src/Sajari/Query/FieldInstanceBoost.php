<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class FieldInstanceBoost
 * @package Sajari\Query
 */
class FieldInstanceBoost implements InstanceBoost, \Sajari\Internal\Proto
{
    /** @var string $field */
    private $field;
    /** @var float $value */
    private $value;

    /**
     * FieldInstanceBoost constructor.
     * @param string $field
     * @param float $value
     */
    public function __construct($field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return \Sajari\Engine\Query\V1\InstanceBoost
     */
    public function Proto()
    {
        $f = new \Sajari\Engine\Query\V1\InstanceBoost_Field();
        $f->setField($this->field);
        $f->setValue($this->value);

        $ib = new \Sajari\Engine\Query\V1\InstanceBoost();
        $ib->setField($f);

        return $ib;
    }
}
