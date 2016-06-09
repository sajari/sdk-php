<?php

namespace Sajari\Search;

class IntervalMetaBoostPoint
{
    /** @var float $point */
    private $point;
    /** @var float $value */
    private $value;

    /**
     * IntervalMetaBoostPoint constructor.
     * @param float $point
     * @param float $value
     */
    public function __construct($point, $value)
    {
        $this->point = $point;
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getPoint()
    {
        return $this->point;
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
        $p = new engine\query\MetaBoost\Interval\Point();
        $p->setPoint($this->point);
        $p->setValue($this->value);
        return $p;
    }
}