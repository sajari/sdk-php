<?php

namespace Sajari\Query;

/**
 * Class IntervalFieldBoost
 * @package Sajari\Query
 */
class IntervalFieldBoost implements FieldBoost, \Sajari\Internal\Proto
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

    /**
     * @return \Sajari\Engine\Query\V1\FieldBoost
     */
    public function Proto()
    {
        $imb = new \Sajari\Engine\Query\V1\FieldBoost_Interval();
        $imb->setField($this->field);
        $points = [];
        foreach ($this->points as $point) {
            $points[] = $point->Proto();

        }
        $imb->setPoints(\Sajari\Internal\Utils::MakeRepeated($points, \Google\Protobuf\Internal\GPBType::MESSAGE, \Sajari\Engine\Query\V1\FieldBoost_Interval_Point::class));

        $mb = new \Sajari\Engine\Query\V1\FieldBoost();
        $mb->setInterval($imb);
        return $mb;
    }
}
