<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/engine/query/v1/query.proto

namespace Sajari\Engine\Query\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * EvaluateRequest contains all parameters necessary to make an Evaluate call.
 *
 * Generated from protobuf message <code>sajari.engine.query.v1.EvaluateRequest</code>
 */
class EvaluateRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Search request to run.
     *
     * Generated from protobuf field <code>.sajari.engine.query.v1.SearchRequest search_request = 1;</code>
     */
    private $search_request = null;
    /**
     * Record to search against.
     *
     * Generated from protobuf field <code>map<string, .sajari.engine.Value> record = 2;</code>
     */
    private $record;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Sajari\Engine\Query\V1\SearchRequest $search_request
     *           Search request to run.
     *     @type array|\Google\Protobuf\Internal\MapField $record
     *           Record to search against.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Sajari\Engine\Query\V1\Query::initOnce();
        parent::__construct($data);
    }

    /**
     * Search request to run.
     *
     * Generated from protobuf field <code>.sajari.engine.query.v1.SearchRequest search_request = 1;</code>
     * @return \Sajari\Engine\Query\V1\SearchRequest
     */
    public function getSearchRequest()
    {
        return $this->search_request;
    }

    /**
     * Search request to run.
     *
     * Generated from protobuf field <code>.sajari.engine.query.v1.SearchRequest search_request = 1;</code>
     * @param \Sajari\Engine\Query\V1\SearchRequest $var
     * @return $this
     */
    public function setSearchRequest($var)
    {
        GPBUtil::checkMessage($var, \Sajari\Engine\Query\V1\SearchRequest::class);
        $this->search_request = $var;

        return $this;
    }

    /**
     * Record to search against.
     *
     * Generated from protobuf field <code>map<string, .sajari.engine.Value> record = 2;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * Record to search against.
     *
     * Generated from protobuf field <code>map<string, .sajari.engine.Value> record = 2;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setRecord($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::MESSAGE, \Sajari\Engine\Value::class);
        $this->record = $arr;

        return $this;
    }

}
