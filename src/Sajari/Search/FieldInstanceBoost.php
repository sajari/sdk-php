<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

use sajari\engine\query\v1\InstanceBoost\Field as EngineField;
use sajari\engine\query\v1\InstanceBoost as EngineInstanceBoost;

class FieldInstanceBoost extends InstanceBoost
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

    public function Proto()
    {
        $f = new EngineField();
        $f->setField($this->field);
        $f->setValue($this->value);

        $ib = new EngineInstanceBoost();
        $ib->setField($f);

        return $ib;
    }
}
