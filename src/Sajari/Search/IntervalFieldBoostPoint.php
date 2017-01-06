<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

/**
 * Class IntervalFieldBoostPoint
 * @package Sajari\Search
 */
class IntervalFieldBoostPoint implements Proto
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
     * @return \sajari\engine\query\v1\FieldBoost\Interval\Point
     */
    public function Proto()
    {
        $p = new \sajari\engine\query\v1\FieldBoost\Interval\Point();
        $p->setPoint($this->point);
        $p->setValue($this->value);
        return $p;
    }
}
