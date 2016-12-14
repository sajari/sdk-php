<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

use sajari\engine\query\v1\InstanceBoost\PosNeg as EnginePosNeg;
use sajari\engine\query\v1\InstanceBoost as EngineInstanceBoost;

class PosNegInstanceBoost extends InstanceBoost
{
    /** @var float $value */
    private $value;

    /**
     * PosNegInstanceBoost constructor.
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
        $pn = new EnginePosNeg();
        $pn->setValue($this->value);

        $ib = new EngineInstanceBoost();
        $ib->setPosNeg($pn);

        return $ib;
    }
}
