<?php

namespace Sajari\Search;

/**
 * @param string $name
 * @param BucketAggregateEntry[] $buckets
 * @return BucketAggregate
 */
function Bucket($name, $buckets)
{
    return new BucketAggregate($name, $buckets);
}

class BucketAggregate extends Aggregate
{
    /** @var string name */
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

    public function Proto()
    {
        $b = new engine\query\Aggregate\Bucket();

        foreach ($this->buckets as $bucket) {
            $b->addBuckets($bucket->Proto());
        }

        $a = new engine\query\Aggregate();
        $a->setBucket($b);

        $ae = new engine\query\Request\AggregatesEntry();
        $ae->setKey($this->name);
        $ae->setValue($a);
        return $ae;
    }
}