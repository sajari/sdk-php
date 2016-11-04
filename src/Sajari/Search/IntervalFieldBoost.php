<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/query.php';

use sajari\engine\query\FieldBoost\Interval as ProtoInterval;
use sajari\engine\query\FieldBoost as ProtoFieldBoost;
use sajari\engine\query\FieldBoost\Interval\Point as ProtoPoint;

class IntervalFieldBoost extends FieldBoost
{
    /** @var string $field */
    private $field;
    /** @var IntervalFieldBoostPoint[] $point */
    private $points;

    /**
     * IntervalFieldBoost constructor.
     * @param string $field
     * @param IntervalFieldBoostPoint[] $points
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
     * @return IntervalFieldBoostPoint[]
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * IntervalFieldBoostPoint constructor.
     * @param float $point
     * @param float $value
     * @return IntervalFieldBoostPoint
     */
    public static function Point($point, $value)
    {
      return new IntervalFieldBoostPoint($point, $value);
    }

    public function Proto()
    {
        $imb = new ProtoInterval();
        $imb->setField($this->field);
        foreach ($this->points as $point) {
            $imb->addPoints($point->Proto());
        }

        $mb = new ProtoFieldBoost();
        $mb->setInterval($imb);
        return $mb;
    }
}

class IntervalFieldBoostPoint
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

    public function Proto()
    {
        $p = new ProtoPoint();
        $p->setPoint($this->point);
        $p->setValue($this->value);
        return $p;
    }
}
