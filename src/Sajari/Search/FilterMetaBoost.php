<?php

namespace Sajari\Search;

abstract class MetaBoost
{
    /** @return engine\query\MetaBoost */
    abstract public function Proto();
}

class FilterMetaBoost extends MetaBoost
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
     * @return engine\query\MetaBoost
     */
    public function Proto()
    {
        $fmb = new engine\query\MetaBoost\Filter();
        $fmb->setFilter($this->filter->Proto());
        $fmb->setValue($this->value);

        $mb = new engine\query\MetaBoost();
        $mb->setFilter($fmb);
        return $mb;
    }
}