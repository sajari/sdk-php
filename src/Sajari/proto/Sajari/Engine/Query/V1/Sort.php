<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/engine/query/v1/query.proto

namespace Sajari\Engine\Query\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Sort defines the ordering of result records using.
 *
 * Generated from protobuf message <code>sajari.engine.query.v1.Sort</code>
 */
class Sort extends \Google\Protobuf\Internal\Message
{
    /**
     * Sorting order.
     *
     * Generated from protobuf field <code>.sajari.engine.query.v1.Sort.Order order = 5;</code>
     */
    private $order = 0;
    protected $type;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type bool $score
     *           Sort by score.
     *     @type bool $query_score
     *           Sort by query score.
     *     @type bool $feature_score
     *           Sort by feature_score;
     *     @type string $field
     *           Sort by field values.
     *     @type int $order
     *           Sorting order.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Sajari\Engine\Query\V1\Query::initOnce();
        parent::__construct($data);
    }

    /**
     * Sort by score.
     *
     * Generated from protobuf field <code>bool score = 1;</code>
     * @return bool
     */
    public function getScore()
    {
        return $this->readOneof(1);
    }

    /**
     * Sort by score.
     *
     * Generated from protobuf field <code>bool score = 1;</code>
     * @param bool $var
     * @return $this
     */
    public function setScore($var)
    {
        GPBUtil::checkBool($var);
        $this->writeOneof(1, $var);

        return $this;
    }

    /**
     * Sort by query score.
     *
     * Generated from protobuf field <code>bool query_score = 2;</code>
     * @return bool
     */
    public function getQueryScore()
    {
        return $this->readOneof(2);
    }

    /**
     * Sort by query score.
     *
     * Generated from protobuf field <code>bool query_score = 2;</code>
     * @param bool $var
     * @return $this
     */
    public function setQueryScore($var)
    {
        GPBUtil::checkBool($var);
        $this->writeOneof(2, $var);

        return $this;
    }

    /**
     * Sort by feature_score;
     *
     * Generated from protobuf field <code>bool feature_score = 3;</code>
     * @return bool
     */
    public function getFeatureScore()
    {
        return $this->readOneof(3);
    }

    /**
     * Sort by feature_score;
     *
     * Generated from protobuf field <code>bool feature_score = 3;</code>
     * @param bool $var
     * @return $this
     */
    public function setFeatureScore($var)
    {
        GPBUtil::checkBool($var);
        $this->writeOneof(3, $var);

        return $this;
    }

    /**
     * Sort by field values.
     *
     * Generated from protobuf field <code>string field = 4;</code>
     * @return string
     */
    public function getField()
    {
        return $this->readOneof(4);
    }

    /**
     * Sort by field values.
     *
     * Generated from protobuf field <code>string field = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setField($var)
    {
        GPBUtil::checkString($var, True);
        $this->writeOneof(4, $var);

        return $this;
    }

    /**
     * Sorting order.
     *
     * Generated from protobuf field <code>.sajari.engine.query.v1.Sort.Order order = 5;</code>
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Sorting order.
     *
     * Generated from protobuf field <code>.sajari.engine.query.v1.Sort.Order order = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setOrder($var)
    {
        GPBUtil::checkEnum($var, \Sajari\Engine\Query\V1\Sort_Order::class);
        $this->order = $var;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->whichOneof("type");
    }

}
