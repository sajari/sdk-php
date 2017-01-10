<?php

namespace Sajari\Query;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

/**
 * Class BucketAggregateEntry
 * @package Sajari\Query
 */
class BucketAggregateEntry implements Proto
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
     * @return \sajari\engine\query\v1\Aggregate\Bucket\Bucket
     */
    public function Proto()
    {
        $be = new \sajari\engine\query\v1\Aggregate\Bucket\Bucket();
        $be->setName($this->name);
        $be->setFilter($this->filter->Proto());
        return $be;
    }
}
