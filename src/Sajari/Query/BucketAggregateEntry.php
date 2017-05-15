<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class BucketAggregateEntry
 * @package Sajari\Query
 */
class BucketAggregateEntry implements \Sajari\Internal\Proto
{
    /** @var string $name */
    private $name;
    /** @var Filter $filter */
    private $filter;

    /**
     * BucketAggregateEntry constructor.
     * @param string $name
     * @param Filter $filter
     */
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

    /**
     * @return \Sajari\Engine\Query\V1\Aggregate_Bucket_Bucket
     */
    public function proto()
    {
        $be = new \Sajari\Engine\Query\V1\Aggregate_Bucket_Bucket();
        $be->setName($this->name);
        $be->setFilter($this->filter->proto());
        return $be;
    }
}
