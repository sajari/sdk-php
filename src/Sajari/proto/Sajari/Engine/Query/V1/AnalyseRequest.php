<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/engine/query/v1/query.proto

namespace Sajari\Engine\Query\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * AnalyseRequest applies a search request to a record.
 *
 * Generated from protobuf message <code>sajari.engine.query.v1.AnalyseRequest</code>
 */
class AnalyseRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Request is a search request which should be applied against a record
     * in the store.
     *
     * Generated from protobuf field <code>.sajari.engine.query.v1.SearchRequest search_request = 1;</code>
     */
    private $search_request = null;
    /**
     * Key is a unique identifier corresponding to a record in the store.
     *
     * Generated from protobuf field <code>repeated .sajari.engine.Key keys = 2;</code>
     */
    private $keys;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Sajari\Engine\Query\V1\SearchRequest $search_request
     *           Request is a search request which should be applied against a record
     *           in the store.
     *     @type \Sajari\Engine\Key[]|\Google\Protobuf\Internal\RepeatedField $keys
     *           Key is a unique identifier corresponding to a record in the store.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Sajari\Engine\Query\V1\Query::initOnce();
        parent::__construct($data);
    }

    /**
     * Request is a search request which should be applied against a record
     * in the store.
     *
     * Generated from protobuf field <code>.sajari.engine.query.v1.SearchRequest search_request = 1;</code>
     * @return \Sajari\Engine\Query\V1\SearchRequest
     */
    public function getSearchRequest()
    {
        return $this->search_request;
    }

    /**
     * Request is a search request which should be applied against a record
     * in the store.
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
     * Key is a unique identifier corresponding to a record in the store.
     *
     * Generated from protobuf field <code>repeated .sajari.engine.Key keys = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getKeys()
    {
        return $this->keys;
    }

    /**
     * Key is a unique identifier corresponding to a record in the store.
     *
     * Generated from protobuf field <code>repeated .sajari.engine.Key keys = 2;</code>
     * @param \Sajari\Engine\Key[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setKeys($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Sajari\Engine\Key::class);
        $this->keys = $arr;

        return $this;
    }

}
