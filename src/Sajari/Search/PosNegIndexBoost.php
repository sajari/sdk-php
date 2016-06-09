<?php

namespace Sajari\Search;

function PosNegBoost($value)
{
    return new PosNegIndexBoost($value);
}

class PosNegIndexBoost extends IndexBoost
{
    /** @var float $value */
    private $value;

    /**
     * PosNegIndexBoost constructor.
     * @param float $value
     */
    public function __construct($value)
    {
        $this->value = $value;
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
        $pn = new engine\query\IndexBoost\PosNeg();
        $pn->setValue($this->value);

        $ib = new engine\query\IndexBoost();
        $ib->setPosNeg($pn);

        return $ib;
    }
}