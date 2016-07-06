<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/query.php';

use sajari\engine\query\IndexBoost\PosNeg as ProtoPosNeg;
use sajari\engine\query\IndexBoost as ProtoIndexBoost;

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
        $pn = new ProtoPosNeg();
        $pn->setValue($this->value);

        $ib = new ProtoIndexBoost();
        $ib->setPosNeg($pn);

        return $ib;
    }
}
