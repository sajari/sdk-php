<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/query.php';

use sajari\engine\query\InstanceBoost\PosNeg as ProtoPosNeg;
use sajari\engine\query\InstanceBoost as ProtoInstanceBoost;

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
        $pn = new ProtoPosNeg();
        $pn->setValue($this->value);

        $ib = new ProtoInstanceBoost();
        $ib->setPosNeg($pn);

        return $ib;
    }
}
