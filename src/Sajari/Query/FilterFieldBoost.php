<?php

namespace Sajari\Query;

/**
 * Class FilterFieldBoost
 * @package Sajari\Query
 */
class FilterFieldBoost implements FieldBoost, \Sajari\Internal\Proto
{
    /** @var Filter $filter */
    private $filter;
    /** @var float $value */
    private $value;

    /**
     * FilterMetaBoost constructor.
     * @param Filter $filter
     * @param float $value
     */
    public function __construct(Filter $filter, $value)
    {
        $this->filter = $filter;
        $this->value = $value;
    }

    /**
     * @return Filter
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return \Sajari\Engine\Query\V1\FieldBoost
     */
    public function proto()
    {
        $fmb = new \Sajari\Engine\Query\V1\FieldBoost_Filter();
        $fmb->setFilter($this->filter->proto());
        $fmb->setValue($this->value);

        $mb = new \Sajari\Engine\Query\V1\FieldBoost();
        $mb->setFilter($fmb);
        return $mb;
    }
}
