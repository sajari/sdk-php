<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/api/pipeline/v1/pipeline.proto

namespace Sajari\Api\Pipeline\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 * SearchRequest is a request to perform a search using a pipeline.
 * </pre>
 *
 * Protobuf type <code>sajari.api.pipeline.v1.SearchRequest</code>
 */
class SearchRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * <pre>
     * Pipeline to run.
     * </pre>
     *
     * <code>.sajari.api.pipeline.v1.Pipeline pipeline = 1;</code>
     */
    private $pipeline = null;
    /**
     * <pre>
     * Values is a mapping of key -&gt; value which should be substituted
     * into the algorithm inputs.
     * </pre>
     *
     * <code>map&lt;string, string&gt; values = 2;</code>
     */
    private $values;
    /**
     * <pre>
     * Tracking is the tracking configuration.
     * </pre>
     *
     * <code>.sajari.api.query.v1.SearchRequest.Tracking tracking = 3;</code>
     */
    private $tracking = null;

    public function __construct() {
        \GPBMetadata\Sajari\Api\Pipeline\V1\Pipeline::initOnce();
        parent::__construct();
    }

    /**
     * <pre>
     * Pipeline to run.
     * </pre>
     *
     * <code>.sajari.api.pipeline.v1.Pipeline pipeline = 1;</code>
     */
    public function getPipeline()
    {
        return $this->pipeline;
    }

    /**
     * <pre>
     * Pipeline to run.
     * </pre>
     *
     * <code>.sajari.api.pipeline.v1.Pipeline pipeline = 1;</code>
     */
    public function setPipeline(&$var)
    {
        GPBUtil::checkMessage($var, \Sajari\Api\Pipeline\V1\Pipeline::class);
        $this->pipeline = $var;
    }

    /**
     * <pre>
     * Values is a mapping of key -&gt; value which should be substituted
     * into the algorithm inputs.
     * </pre>
     *
     * <code>map&lt;string, string&gt; values = 2;</code>
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * <pre>
     * Values is a mapping of key -&gt; value which should be substituted
     * into the algorithm inputs.
     * </pre>
     *
     * <code>map&lt;string, string&gt; values = 2;</code>
     */
    public function setValues(&$var)
    {
        $this->values = $var;
    }

    /**
     * <pre>
     * Tracking is the tracking configuration.
     * </pre>
     *
     * <code>.sajari.api.query.v1.SearchRequest.Tracking tracking = 3;</code>
     */
    public function getTracking()
    {
        return $this->tracking;
    }

    /**
     * <pre>
     * Tracking is the tracking configuration.
     * </pre>
     *
     * <code>.sajari.api.query.v1.SearchRequest.Tracking tracking = 3;</code>
     */
    public function setTracking(&$var)
    {
        GPBUtil::checkMessage($var, \Sajari\Api\Query\V1\SearchRequest_Tracking::class);
        $this->tracking = $var;
    }

}

