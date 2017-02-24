<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class BucketAggregate
 * @package Sajari\Query
 */
class BucketAggregate implements Aggregate, \Sajari\Internal\Proto
{
    /** @var string $name */
    private $name;
    /** @var BucketAggregateEntry[] $buckets */
    private $buckets;

    /**
     * BucketAggregate constructor.
     * @param string $name
     * @param BucketAggregateEntry[] $buckets
     */
    public function __construct($name, array $buckets)
    {
        $this->name = $name;
        $this->buckets = $buckets;
    }

    /**
     * @return BucketAggregateEntry[]
     */
    public function getBuckets()
    {
        return $this->buckets;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return \Sajari\Engine\Query\V1\SearchRequest\AggregatesEntry
     */
    public function Proto()
    {
        $b = new \Sajari\Engine\Query\V1\Aggregate\Bucket();

        foreach ($this->buckets as $bucket) {
            $b->addBuckets($bucket->Proto());
        }

        $a = new \Sajari\Engine\Query\V1\Aggregate();
        $a->setBucket($b);

        $ae = new \Sajari\Engine\Query\V1\SearchRequest\AggregatesEntry();
        $ae->setKey($this->name);
        $ae->setValue($a);
        return $ae;
    }
}
