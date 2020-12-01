<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/bayes/query/query.proto

namespace Sajari\Bayes\Query;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Response returns information on the classification.
 *
 * Generated from protobuf message <code>sajari.bayes.query.Response</code>
 */
class Response extends \Google\Protobuf\Internal\Message
{
    /**
     * Scores map represents each of the potential classes and their
     * associated probability (Note: only if the probability calculation does
     * not underflow)
     *
     * Generated from protobuf field <code>map<string, double> scores = 1;</code>
     */
    private $scores;
    /**
     * Best represents the highest probability class for the input data.
     *
     * Generated from protobuf field <code>string best = 2;</code>
     */
    private $best = '';
    /**
     * Unique indicates if this classification was the solo highest probability
     * (i.e. not equal with other classes)
     *
     * Generated from protobuf field <code>bool unique = 3;</code>
     */
    private $unique = false;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type array|\Google\Protobuf\Internal\MapField $scores
     *           Scores map represents each of the potential classes and their
     *           associated probability (Note: only if the probability calculation does
     *           not underflow)
     *     @type string $best
     *           Best represents the highest probability class for the input data.
     *     @type bool $unique
     *           Unique indicates if this classification was the solo highest probability
     *           (i.e. not equal with other classes)
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Sajari\Bayes\Query\Query::initOnce();
        parent::__construct($data);
    }

    /**
     * Scores map represents each of the potential classes and their
     * associated probability (Note: only if the probability calculation does
     * not underflow)
     *
     * Generated from protobuf field <code>map<string, double> scores = 1;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getScores()
    {
        return $this->scores;
    }

    /**
     * Scores map represents each of the potential classes and their
     * associated probability (Note: only if the probability calculation does
     * not underflow)
     *
     * Generated from protobuf field <code>map<string, double> scores = 1;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setScores($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::DOUBLE);
        $this->scores = $arr;

        return $this;
    }

    /**
     * Best represents the highest probability class for the input data.
     *
     * Generated from protobuf field <code>string best = 2;</code>
     * @return string
     */
    public function getBest()
    {
        return $this->best;
    }

    /**
     * Best represents the highest probability class for the input data.
     *
     * Generated from protobuf field <code>string best = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setBest($var)
    {
        GPBUtil::checkString($var, True);
        $this->best = $var;

        return $this;
    }

    /**
     * Unique indicates if this classification was the solo highest probability
     * (i.e. not equal with other classes)
     *
     * Generated from protobuf field <code>bool unique = 3;</code>
     * @return bool
     */
    public function getUnique()
    {
        return $this->unique;
    }

    /**
     * Unique indicates if this classification was the solo highest probability
     * (i.e. not equal with other classes)
     *
     * Generated from protobuf field <code>bool unique = 3;</code>
     * @param bool $var
     * @return $this
     */
    public function setUnique($var)
    {
        GPBUtil::checkBool($var);
        $this->unique = $var;

        return $this;
    }

}
