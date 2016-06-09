<?php

namespace Sajari\Search;

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

    public function Proto()
    {
        $imb = new engine\query\MetaBoost\Interval();
        $imb->setField($this->field);
        foreach ($this->points as $point) {
            $imb->addPoints($point->Proto());
        }

        $mb = new engine\query\MetaBoost();
        $mb->setInterval($imb);
        return $mb;
    }
}