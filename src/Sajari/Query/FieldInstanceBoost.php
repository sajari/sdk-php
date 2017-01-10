<?php

namespace Sajari\Query;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

/**
 * Class FieldInstanceBoost
 * @package Sajari\Query
 */
class FieldInstanceBoost implements InstanceBoost, Proto
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
     * @return \sajari\engine\query\v1\InstanceBoost
     */
    public function Proto()
    {
        $f = new \sajari\engine\query\v1\InstanceBoost\Field();
        $f->setField($this->field);
        $f->setValue($this->value);

        $ib = new \sajari\engine\query\v1\InstanceBoost();
        $ib->setField($f);

        return $ib;
    }
}
