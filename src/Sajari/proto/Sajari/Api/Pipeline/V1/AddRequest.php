<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/api/pipeline/v1/record.proto

namespace Sajari\Api\Pipeline\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 * SearchRequest is a request to perform a search using a pipeline.
 * </pre>
 *
 * Protobuf type <code>sajari.api.pipeline.v1.AddRequest</code>
 */
class AddRequest extends \Google\Protobuf\Internal\Message
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
     * into the pipeline inputs.
     * </pre>
     *
     * <code>map&lt;string, string&gt; values = 2;</code>
     */
    private $values;
    /**
     * <pre>
     * List of records to add.
     * </pre>
     *
     * <code>repeated .sajari.engine.store.record.Record records = 3;</code>
     */
    private $records;

    public function __construct() {
        \GPBMetadata\Sajari\Api\Pipeline\V1\Record::initOnce();
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
     * into the pipeline inputs.
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
     * into the pipeline inputs.
     * </pre>
     *
     * <code>map&lt;string, string&gt; values = 2;</code>
     */
    public function setValues(&$var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::STRING);
        $this->values = $arr;
    }

    /**
     * <pre>
     * List of records to add.
     * </pre>
     *
     * <code>repeated .sajari.engine.store.record.Record records = 3;</code>
     */
    public function getRecords()
    {
        return $this->records;
    }

    /**
     * <pre>
     * List of records to add.
     * </pre>
     *
     * <code>repeated .sajari.engine.store.record.Record records = 3;</code>
     */
    public function setRecords(&$var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Sajari\Engine\Store\Record\Record::class);
        $this->records = $arr;
    }

}

