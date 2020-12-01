<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/engine/query/v1/query.proto

namespace Sajari\Engine\Query\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * FieldBoost is used to influence the score of a record based on its field values.
 * The effect of a FieldBoost is the value that it contributes to the overall score.
 * All boost effects are between 0 and 1 inclusive.
 *
 * Generated from protobuf message <code>sajari.engine.query.v1.FieldBoost</code>
 */
class FieldBoost extends \Google\Protobuf\Internal\Message
{
    protected $field_boost;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Sajari\Engine\Query\V1\FieldBoost\Filter $filter
     *     @type \Sajari\Engine\Query\V1\FieldBoost\Interval $interval
     *     @type \Sajari\Engine\Query\V1\FieldBoost\Element $element
     *     @type \Sajari\Engine\Query\V1\FieldBoost\Text $text
     *     @type \Sajari\Engine\Query\V1\FieldBoost\Cosine $cosine
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Sajari\Engine\Query\V1\Query::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.sajari.engine.query.v1.FieldBoost.Filter filter = 1;</code>
     * @return \Sajari\Engine\Query\V1\FieldBoost\Filter
     */
    public function getFilter()
    {
        return $this->readOneof(1);
    }

    /**
     * Generated from protobuf field <code>.sajari.engine.query.v1.FieldBoost.Filter filter = 1;</code>
     * @param \Sajari\Engine\Query\V1\FieldBoost\Filter $var
     * @return $this
     */
    public function setFilter($var)
    {
        GPBUtil::checkMessage($var, \Sajari\Engine\Query\V1\FieldBoost_Filter::class);
        $this->writeOneof(1, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.sajari.engine.query.v1.FieldBoost.Interval interval = 2;</code>
     * @return \Sajari\Engine\Query\V1\FieldBoost\Interval
     */
    public function getInterval()
    {
        return $this->readOneof(2);
    }

    /**
     * Generated from protobuf field <code>.sajari.engine.query.v1.FieldBoost.Interval interval = 2;</code>
     * @param \Sajari\Engine\Query\V1\FieldBoost\Interval $var
     * @return $this
     */
    public function setInterval($var)
    {
        GPBUtil::checkMessage($var, \Sajari\Engine\Query\V1\FieldBoost_Interval::class);
        $this->writeOneof(2, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.sajari.engine.query.v1.FieldBoost.Element element = 3;</code>
     * @return \Sajari\Engine\Query\V1\FieldBoost\Element
     */
    public function getElement()
    {
        return $this->readOneof(3);
    }

    /**
     * Generated from protobuf field <code>.sajari.engine.query.v1.FieldBoost.Element element = 3;</code>
     * @param \Sajari\Engine\Query\V1\FieldBoost\Element $var
     * @return $this
     */
    public function setElement($var)
    {
        GPBUtil::checkMessage($var, \Sajari\Engine\Query\V1\FieldBoost_Element::class);
        $this->writeOneof(3, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.sajari.engine.query.v1.FieldBoost.Text text = 4;</code>
     * @return \Sajari\Engine\Query\V1\FieldBoost\Text
     */
    public function getText()
    {
        return $this->readOneof(4);
    }

    /**
     * Generated from protobuf field <code>.sajari.engine.query.v1.FieldBoost.Text text = 4;</code>
     * @param \Sajari\Engine\Query\V1\FieldBoost\Text $var
     * @return $this
     */
    public function setText($var)
    {
        GPBUtil::checkMessage($var, \Sajari\Engine\Query\V1\FieldBoost_Text::class);
        $this->writeOneof(4, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.sajari.engine.query.v1.FieldBoost.Cosine cosine = 5;</code>
     * @return \Sajari\Engine\Query\V1\FieldBoost\Cosine
     */
    public function getCosine()
    {
        return $this->readOneof(5);
    }

    /**
     * Generated from protobuf field <code>.sajari.engine.query.v1.FieldBoost.Cosine cosine = 5;</code>
     * @param \Sajari\Engine\Query\V1\FieldBoost\Cosine $var
     * @return $this
     */
    public function setCosine($var)
    {
        GPBUtil::checkMessage($var, \Sajari\Engine\Query\V1\FieldBoost_Cosine::class);
        $this->writeOneof(5, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getFieldBoost()
    {
        return $this->whichOneof("field_boost");
    }

}
