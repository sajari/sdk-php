<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

use sajari\engine\query\v1\Aggregate\Bucket\Bucket as EngineBucket;

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
        $be = new EngineBucket();
        $be->setName($this->name);
        $be->setFilter($this->filter->Proto());
        return $be;
    }
}
