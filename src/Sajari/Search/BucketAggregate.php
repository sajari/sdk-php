<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/query.php';

use sajari\engine\query\Aggregate\Bucket as ProtoBucket;
use sajari\engine\query\Aggregate as ProtoAggregate;
use sajari\engine\query\Request\AggregatesEntry as ProtoAggregatesEntry;

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
        $b = new ProtoBucket();

        foreach ($this->buckets as $bucket) {
            $b->addBuckets($bucket->Proto());
        }

        $a = new ProtoAggregate();
        $a->setBucket($b);

        $ae = new ProtoAggregatesEntry();
        $ae->setKey($this->name);
        $ae->setValue($a);
        return $ae;
    }
}
