<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/query.php';

use sajari\engine\query\IndexBoost\Field as ProtoField;
use sajari\engine\query\IndexBoost as ProtoIndexBoost;

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
        $f = new ProtoField();
        $f->setField($this->field);
        $f->setValue($this->value);

        $ib = new ProtoIndexBoost();
        $ib->setField($f);

        return $ib;
    }
}
