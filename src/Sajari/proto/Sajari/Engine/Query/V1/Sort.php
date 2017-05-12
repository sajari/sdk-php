<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/engine/query/v1/query.proto

namespace Sajari\Engine\Query\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 * Sort defines the ordering of result documents using.
 * </pre>
 *
 * Protobuf type <code>sajari.engine.query.v1.Sort</code>
 */
class Sort extends \Google\Protobuf\Internal\Message
{
    /**
     * <pre>
     * Sorting order.
     * </pre>
     *
     * <code>.sajari.engine.query.v1.Sort.Order order = 5;</code>
     */
    private $order = 0;
    protected $type;

    public function __construct() {
        \GPBMetadata\Sajari\Engine\Query\V1\Query::initOnce();
        parent::__construct();
    }

    /**
     * <pre>
     * Sort by score.
     * </pre>
     *
     * <code>bool score = 1;</code>
     */
    public function getScore()
    {
        return $this->readOneof(1);
    }

    /**
     * <pre>
     * Sort by score.
     * </pre>
     *
     * <code>bool score = 1;</code>
     */
    public function setScore($var)
    {
        GPBUtil::checkBool($var);
        $this->writeOneof(1, $var);
    }

    /**
     * <pre>
     * Sort by query score.
     * </pre>
     *
     * <code>bool query_score = 2;</code>
     */
    public function getQueryScore()
    {
        return $this->readOneof(2);
    }

    /**
     * <pre>
     * Sort by query score.
     * </pre>
     *
     * <code>bool query_score = 2;</code>
     */
    public function setQueryScore($var)
    {
        GPBUtil::checkBool($var);
        $this->writeOneof(2, $var);
    }

    /**
     * <pre>
     * Sort by feature_score;
     * </pre>
     *
     * <code>bool feature_score = 3;</code>
     */
    public function getFeatureScore()
    {
        return $this->readOneof(3);
    }

    /**
     * <pre>
     * Sort by feature_score;
     * </pre>
     *
     * <code>bool feature_score = 3;</code>
     */
    public function setFeatureScore($var)
    {
        GPBUtil::checkBool($var);
        $this->writeOneof(3, $var);
    }

    /**
     * <pre>
     * Sort by field values.
     * </pre>
     *
     * <code>string field = 4;</code>
     */
    public function getField()
    {
        return $this->readOneof(4);
    }

    /**
     * <pre>
     * Sort by field values.
     * </pre>
     *
     * <code>string field = 4;</code>
     */
    public function setField($var)
    {
        GPBUtil::checkString($var, True);
        $this->writeOneof(4, $var);
    }

    /**
     * <pre>
     * Sorting order.
     * </pre>
     *
     * <code>.sajari.engine.query.v1.Sort.Order order = 5;</code>
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * <pre>
     * Sorting order.
     * </pre>
     *
     * <code>.sajari.engine.query.v1.Sort.Order order = 5;</code>
     */
    public function setOrder($var)
    {
        GPBUtil::checkEnum($var, \Sajari\Engine\Query\V1\Sort_Order::class);
        $this->order = $var;
    }

    public function getType()
    {
        return $this->whichOneof("type");
    }

}

