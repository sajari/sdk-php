<?php

namespace Sajari\Query;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

/**
 * Class BucketAggregate
 * @package Sajari\Query
 */
class BucketAggregate implements Aggregate, Proto
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
     * @return \sajariGen\engine\query\v1\SearchRequest\AggregatesEntry
     */
    public function Proto()
    {
        $b = new \sajariGen\engine\query\v1\Aggregate\Bucket();

        foreach ($this->buckets as $bucket) {
            $b->addBuckets($bucket->Proto());
        }

        $a = new \sajariGen\engine\query\v1\Aggregate();
        $a->setBucket($b);

        $ae = new \sajariGen\engine\query\v1\SearchRequest\AggregatesEntry();
        $ae->setKey($this->name);
        $ae->setValue($a);
        return $ae;
    }
}
