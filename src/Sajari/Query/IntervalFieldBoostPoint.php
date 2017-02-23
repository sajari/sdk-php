<?php

namespace Sajari\Query;

/**
 * Class IntervalFieldBoostPoint
 * @package Sajari\Query
 */
class IntervalFieldBoostPoint implements \Sajari\Internal\Proto
{
    /** @var float $point */
    private $point;
    /** @var float $value */
    private $value;

    /**
     * IntervalFieldBoostPoint constructor.
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

    /**
     * @return \Sajari\Engine\Query\V1\FieldBoost_Interval_Point
     */
    public function Proto()
    {
        $p = new \Sajari\Engine\Query\V1\FieldBoost_Interval_Point();
        $p->setPoint($this->point);
        $p->setValue($this->value);
        return $p;
    }
}
