<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

class ScoreInstanceBoost extends \Sajari\Internal\Proto
{
    /** @var integer $minCount */
    private $minCount;
    /** @var float @threshold */
    private $threshold;

    /**
     * PosNegInstanceBoost constructor.
     * @param integer $minCount
     * @param float $threshold
     */
    public function __construct($minCount, $threshold)
    {
        $this->minCount = $minCount;
        $this->threshold = $threshold;
    }

    public function proto()
    {
        $sib = new \Sajari\Engine\Query\V1\InstanceBoost_Score();
        $sib->setMinCount($this->minCount);
        $sib->setThreshold($this->threshold);

        $ib = new \Sajari\Engine\Query\V1\InstanceBoost();
        $ib->setScore($sib);

        return $ib;
    }
}
