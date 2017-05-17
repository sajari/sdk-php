<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/engine/query/v1/query.proto

namespace Sajari\Engine\Query\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 * AggregateResponse contains statistical information representing aggregation results
 * </pre>
 *
 * Protobuf type <code>sajari.engine.query.v1.AggregateResponse</code>
 */
class AggregateResponse extends \Google\Protobuf\Internal\Message
{
    protected $aggregate_response;

    public function __construct() {
        \GPBMetadata\Sajari\Engine\Query\V1\Query::initOnce();
        parent::__construct();
    }

    /**
     * <code>.sajari.engine.query.v1.AggregateResponse.Metric metric = 1;</code>
     */
    public function getMetric()
    {
        return $this->readOneof(1);
    }

    /**
     * <code>.sajari.engine.query.v1.AggregateResponse.Metric metric = 1;</code>
     */
    public function setMetric(&$var)
    {
        GPBUtil::checkMessage($var, \Sajari\Engine\Query\V1\AggregateResponse_Metric::class);
        $this->writeOneof(1, $var);
    }

    /**
     * <code>.sajari.engine.query.v1.AggregateResponse.Count count = 2;</code>
     */
    public function getCount()
    {
        return $this->readOneof(2);
    }

    /**
     * <code>.sajari.engine.query.v1.AggregateResponse.Count count = 2;</code>
     */
    public function setCount(&$var)
    {
        GPBUtil::checkMessage($var, \Sajari\Engine\Query\V1\AggregateResponse_Count::class);
        $this->writeOneof(2, $var);
    }

    /**
     * <code>.sajari.engine.query.v1.AggregateResponse.Buckets buckets = 3;</code>
     */
    public function getBuckets()
    {
        return $this->readOneof(3);
    }

    /**
     * <code>.sajari.engine.query.v1.AggregateResponse.Buckets buckets = 3;</code>
     */
    public function setBuckets(&$var)
    {
        GPBUtil::checkMessage($var, \Sajari\Engine\Query\V1\AggregateResponse_Buckets::class);
        $this->writeOneof(3, $var);
    }

    public function getAggregateResponse()
    {
        return $this->whichOneof("aggregate_response");
    }

}
