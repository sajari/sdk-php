<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

use sajari\engine\query\v1\Aggregate\Bucket as EngineBucket;
use sajari\engine\query\v1\Aggregate as EngineAggregate;
use sajari\engine\query\v1\Request\AggregatesEntry as EngineAggregatesEntry;

use Sajari\Search\BucketAggregateEntry;

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
        $b = new EngineBucket();

        foreach ($this->buckets as $bucket) {
            $b->addBuckets($bucket->Proto());
        }

        $a = new EngineAggregate();
        $a->setBucket($b);

        $ae = new EngineAggregatesEntry();
        $ae->setKey($this->name);
        $ae->setValue($a);
        return $ae;
    }
}
