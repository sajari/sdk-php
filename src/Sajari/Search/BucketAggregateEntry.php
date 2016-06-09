<?php

namespace Sajari\Search;

/**
 * @param string $name
 * @param Filter $filter
 * @return BucketAggregateEntry
 */
function BucketEntry($name, $filter)
{
    return new BucketAggregateEntry($name, $filter);
}

class BucketAggregateEntry
{
    /** @var string $name */
    private $name;
    /** @var Filter $filter */
    private $filter;

    public function __construct($name, Filter $filter)
    {
        $this->name = $name;
        $this->filter = $filter;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Filter
     */
    public function getFilter()
    {
        return $this->filter;
    }

    public function Proto()
    {
        $be = new engine\query\Aggregate\Bucket\Bucket();
        $be->setName($this->name);
        $be->setFilter($this->filter->Proto());
        return $be;
    }
}