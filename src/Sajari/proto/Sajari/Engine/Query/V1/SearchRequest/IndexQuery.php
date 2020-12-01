<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/engine/query/v1/query.proto

namespace Sajari\Engine\Query\V1\SearchRequest;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * IndexQuery defines criteria for matching and scoring records based on full-text style
 * term matching and record field values.
 * All boost applied here are multiplicative.
 *
 * Generated from protobuf message <code>sajari.engine.query.v1.SearchRequest.IndexQuery</code>
 */
class IndexQuery extends \Google\Protobuf\Internal\Message
{
    /**
     * Body is a list of weighted free text.
     *
     * Generated from protobuf field <code>repeated .sajari.engine.query.v1.Body body = 1;</code>
     */
    private $body;
    /**
     * Terms is a list of weighted terms, where terms represent tokenised sequences of text.
     * DEPRECATED: no longer supported, use new indexes property in Body instead.
     *
     * Generated from protobuf field <code>repeated .sajari.engine.query.v1.Term terms = 2;</code>
     */
    private $terms;
    /**
     * InstanceBoosts are boost rules computed against a record's term instances.
     * Instance boosting allows callers to boost records which have terms that match
     * a rule.
     *
     * Generated from protobuf field <code>repeated .sajari.engine.query.v1.InstanceBoost instance_boosts = 3;</code>
     */
    private $instance_boosts;
    /**
     * Score mode used for computing.
     *
     * Generated from protobuf field <code>.sajari.engine.query.v1.SearchRequest.IndexQuery.InstanceScoreMode instance_score_mode = 5;</code>
     */
    private $instance_score_mode = 0;
    /**
     * FieldBoosts are rules checked against a record's field values.
     * Field boosting allows callers to boost records which have field values that
     * match a rule.
     *
     * Generated from protobuf field <code>repeated .sajari.engine.query.v1.FieldBoost field_boosts = 4;</code>
     */
    private $field_boosts;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Sajari\Engine\Query\V1\Body[]|\Google\Protobuf\Internal\RepeatedField $body
     *           Body is a list of weighted free text.
     *     @type \Sajari\Engine\Query\V1\Term[]|\Google\Protobuf\Internal\RepeatedField $terms
     *           Terms is a list of weighted terms, where terms represent tokenised sequences of text.
     *           DEPRECATED: no longer supported, use new indexes property in Body instead.
     *     @type \Sajari\Engine\Query\V1\InstanceBoost[]|\Google\Protobuf\Internal\RepeatedField $instance_boosts
     *           InstanceBoosts are boost rules computed against a record's term instances.
     *           Instance boosting allows callers to boost records which have terms that match
     *           a rule.
     *     @type int $instance_score_mode
     *           Score mode used for computing.
     *     @type \Sajari\Engine\Query\V1\FieldBoost[]|\Google\Protobuf\Internal\RepeatedField $field_boosts
     *           FieldBoosts are rules checked against a record's field values.
     *           Field boosting allows callers to boost records which have field values that
     *           match a rule.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Sajari\Engine\Query\V1\Query::initOnce();
        parent::__construct($data);
    }

    /**
     * Body is a list of weighted free text.
     *
     * Generated from protobuf field <code>repeated .sajari.engine.query.v1.Body body = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Body is a list of weighted free text.
     *
     * Generated from protobuf field <code>repeated .sajari.engine.query.v1.Body body = 1;</code>
     * @param \Sajari\Engine\Query\V1\Body[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setBody($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Sajari\Engine\Query\V1\Body::class);
        $this->body = $arr;

        return $this;
    }

    /**
     * Terms is a list of weighted terms, where terms represent tokenised sequences of text.
     * DEPRECATED: no longer supported, use new indexes property in Body instead.
     *
     * Generated from protobuf field <code>repeated .sajari.engine.query.v1.Term terms = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * Terms is a list of weighted terms, where terms represent tokenised sequences of text.
     * DEPRECATED: no longer supported, use new indexes property in Body instead.
     *
     * Generated from protobuf field <code>repeated .sajari.engine.query.v1.Term terms = 2;</code>
     * @param \Sajari\Engine\Query\V1\Term[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setTerms($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Sajari\Engine\Query\V1\Term::class);
        $this->terms = $arr;

        return $this;
    }

    /**
     * InstanceBoosts are boost rules computed against a record's term instances.
     * Instance boosting allows callers to boost records which have terms that match
     * a rule.
     *
     * Generated from protobuf field <code>repeated .sajari.engine.query.v1.InstanceBoost instance_boosts = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getInstanceBoosts()
    {
        return $this->instance_boosts;
    }

    /**
     * InstanceBoosts are boost rules computed against a record's term instances.
     * Instance boosting allows callers to boost records which have terms that match
     * a rule.
     *
     * Generated from protobuf field <code>repeated .sajari.engine.query.v1.InstanceBoost instance_boosts = 3;</code>
     * @param \Sajari\Engine\Query\V1\InstanceBoost[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setInstanceBoosts($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Sajari\Engine\Query\V1\InstanceBoost::class);
        $this->instance_boosts = $arr;

        return $this;
    }

    /**
     * Score mode used for computing.
     *
     * Generated from protobuf field <code>.sajari.engine.query.v1.SearchRequest.IndexQuery.InstanceScoreMode instance_score_mode = 5;</code>
     * @return int
     */
    public function getInstanceScoreMode()
    {
        return $this->instance_score_mode;
    }

    /**
     * Score mode used for computing.
     *
     * Generated from protobuf field <code>.sajari.engine.query.v1.SearchRequest.IndexQuery.InstanceScoreMode instance_score_mode = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setInstanceScoreMode($var)
    {
        GPBUtil::checkEnum($var, \Sajari\Engine\Query\V1\SearchRequest_IndexQuery_InstanceScoreMode::class);
        $this->instance_score_mode = $var;

        return $this;
    }

    /**
     * FieldBoosts are rules checked against a record's field values.
     * Field boosting allows callers to boost records which have field values that
     * match a rule.
     *
     * Generated from protobuf field <code>repeated .sajari.engine.query.v1.FieldBoost field_boosts = 4;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getFieldBoosts()
    {
        return $this->field_boosts;
    }

    /**
     * FieldBoosts are rules checked against a record's field values.
     * Field boosting allows callers to boost records which have field values that
     * match a rule.
     *
     * Generated from protobuf field <code>repeated .sajari.engine.query.v1.FieldBoost field_boosts = 4;</code>
     * @param \Sajari\Engine\Query\V1\FieldBoost[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setFieldBoosts($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Sajari\Engine\Query\V1\FieldBoost::class);
        $this->field_boosts = $arr;

        return $this;
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(IndexQuery::class, \Sajari\Engine\Query\V1\SearchRequest_IndexQuery::class);
