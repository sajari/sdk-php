<?php

namespace Sajari\Search;

function FieldBoost($field, $value)
{
    return new FieldIndexBoost($field, $value);
}

class FieldIndexBoost extends IndexBoost
{
    /** @var string $field */
    private $field;
    /** @var float $value */
    private $value;

    /**
     * FieldIndexBoost constructor.
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

    public function Proto()
    {
        $f = new engine\query\IndexBoost\Field();
        $f->setField($this->field);
        $f->setValue($this->value);

        $ib = new engine\query\IndexBoost();
        $ib->setField($f);

        return $ib;
    }
}