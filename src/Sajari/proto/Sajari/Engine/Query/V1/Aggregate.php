<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/engine/query/v1/query.proto

namespace Sajari\Engine\Query\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 * Aggregate is a statistical query run on the result set of a search.
 * </pre>
 *
 * Protobuf type <code>sajari.engine.query.v1.Aggregate</code>
 */
class Aggregate extends \Google\Protobuf\Internal\Message
{
    protected $aggregate;

    public function __construct() {
        \GPBMetadata\Sajari\Engine\Query\V1\Query::initOnce();
        parent::__construct();
    }

    /**
     * <code>.sajari.engine.query.v1.Aggregate.Metric metric = 1;</code>
     */
    public function getMetric()
    {
        return $this->readOneof(1);
    }

    /**
     * <code>.sajari.engine.query.v1.Aggregate.Metric metric = 1;</code>
     */
    public function setMetric(&$var)
    {
        GPBUtil::checkMessage($var, \Sajari\Engine\Query\V1\Aggregate_Metric::class);
        $this->writeOneof(1, $var);
    }

    /**
     * <code>.sajari.engine.query.v1.Aggregate.Count count = 2;</code>
     */
    public function getCount()
    {
        return $this->readOneof(2);
    }

    /**
     * <code>.sajari.engine.query.v1.Aggregate.Count count = 2;</code>
     */
    public function setCount(&$var)
    {
        GPBUtil::checkMessage($var, \Sajari\Engine\Query\V1\Aggregate_Count::class);
        $this->writeOneof(2, $var);
    }

    /**
     * <code>.sajari.engine.query.v1.Aggregate.Bucket bucket = 3;</code>
     */
    public function getBucket()
    {
        return $this->readOneof(3);
    }

    /**
     * <code>.sajari.engine.query.v1.Aggregate.Bucket bucket = 3;</code>
     */
    public function setBucket(&$var)
    {
        GPBUtil::checkMessage($var, \Sajari\Engine\Query\V1\Aggregate_Bucket::class);
        $this->writeOneof(3, $var);
    }

    public function getAggregate()
    {
        return $this->whichOneof("aggregate");
    }

}

