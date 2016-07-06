<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/query.php';

use sajari\engine\query\MetaBoost\Interval as ProtoInterval;
use sajari\engine\query\MetaBoost as ProtoMetaBoost;
use sajari\engine\query\MetaBoost\Interval\Point as ProtoPoint;

class IntervalMetaBoost extends MetaBoost
{
    /** @var string $field */
    private $field;
    /** @var IntervalMetaBoostPoint[] $point */
    private $points;

    /**
     * IntervalMetaBoost constructor.
     * @param string $field
     * @param IntervalMetaBoostPoint[] $points
     */
    public function __construct($field, array $points)
    {
        $this->field = $field;
        $this->points = $points;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return IntervalMetaBoostPoint[]
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * IntervalMetaBoostPoint constructor.
     * @param float $point
     * @param float $value
     * @return IntervalMetaBoostPoint
     */
    public static function Point($point, $value)
    {
      return new IntervalMetaBoostPoint($point, $value);
    }

    public function Proto()
    {
        $imb = new ProtoInterval();
        $imb->setField($this->field);
        foreach ($this->points as $point) {
            $imb->addPoints($point->Proto());
        }

        $mb = new ProtoMetaBoost();
        $mb->setInterval($imb);
        return $mb;
    }
}

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
        $p = new ProtoPoint();
        $p->setPoint($this->point);
        $p->setValue($this->value);
        return $p;
    }
}
