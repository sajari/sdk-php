<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/api/pipeline/v1/query.proto

namespace Sajari\Api\Pipeline\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * SearchRequest is a request to perform a search using a pipeline.
 *
 * Generated from protobuf message <code>sajari.api.pipeline.v1.SearchRequest</code>
 */
class SearchRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Pipeline to run.
     *
     * Generated from protobuf field <code>.sajari.api.pipeline.v1.Pipeline pipeline = 1;</code>
     */
    private $pipeline = null;
    /**
     * Values is a mapping of key -> value which should be substituted
     * into the algorithm inputs.
     *
     * Generated from protobuf field <code>map<string, string> values = 2;</code>
     */
    private $values;
    /**
     * Tracking is the tracking configuration.
     *
     * Generated from protobuf field <code>.sajari.api.query.v1.SearchRequest.Tracking tracking = 3;</code>
     */
    private $tracking = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Sajari\Api\Pipeline\V1\Pipeline $pipeline
     *           Pipeline to run.
     *     @type array|\Google\Protobuf\Internal\MapField $values
     *           Values is a mapping of key -> value which should be substituted
     *           into the algorithm inputs.
     *     @type \Sajari\Api\Query\V1\SearchRequest\Tracking $tracking
     *           Tracking is the tracking configuration.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Sajari\Api\Pipeline\V1\Query::initOnce();
        parent::__construct($data);
    }

    /**
     * Pipeline to run.
     *
     * Generated from protobuf field <code>.sajari.api.pipeline.v1.Pipeline pipeline = 1;</code>
     * @return \Sajari\Api\Pipeline\V1\Pipeline
     */
    public function getPipeline()
    {
        return $this->pipeline;
    }

    /**
     * Pipeline to run.
     *
     * Generated from protobuf field <code>.sajari.api.pipeline.v1.Pipeline pipeline = 1;</code>
     * @param \Sajari\Api\Pipeline\V1\Pipeline $var
     * @return $this
     */
    public function setPipeline($var)
    {
        GPBUtil::checkMessage($var, \Sajari\Api\Pipeline\V1\Pipeline::class);
        $this->pipeline = $var;

        return $this;
    }

    /**
     * Values is a mapping of key -> value which should be substituted
     * into the algorithm inputs.
     *
     * Generated from protobuf field <code>map<string, string> values = 2;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Values is a mapping of key -> value which should be substituted
     * into the algorithm inputs.
     *
     * Generated from protobuf field <code>map<string, string> values = 2;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setValues($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::STRING);
        $this->values = $arr;

        return $this;
    }

    /**
     * Tracking is the tracking configuration.
     *
     * Generated from protobuf field <code>.sajari.api.query.v1.SearchRequest.Tracking tracking = 3;</code>
     * @return \Sajari\Api\Query\V1\SearchRequest\Tracking
     */
    public function getTracking()
    {
        return $this->tracking;
    }

    /**
     * Tracking is the tracking configuration.
     *
     * Generated from protobuf field <code>.sajari.api.query.v1.SearchRequest.Tracking tracking = 3;</code>
     * @param \Sajari\Api\Query\V1\SearchRequest\Tracking $var
     * @return $this
     */
    public function setTracking($var)
    {
        GPBUtil::checkMessage($var, \Sajari\Api\Query\V1\SearchRequest_Tracking::class);
        $this->tracking = $var;

        return $this;
    }

}
