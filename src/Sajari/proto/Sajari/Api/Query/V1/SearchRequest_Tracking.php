<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/api/query/v1/query.proto

namespace Sajari\Api\Query\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Protobuf type <code>sajari.api.query.v1.SearchRequest.Tracking</code>
 */
class SearchRequest_Tracking extends \Google\Protobuf\Internal\Message
{
    /**
     * <pre>
     * Tracking mode for query.
     * Tracking is done using tokens which are added to result sets and identify individual results.
     * Tokens are used to improve the ranking of documents by reporting clicks (i.e. positive action)
     * or pos/neg (i.e positive or negative reporting) on the position of a document in results.
     * </pre>
     *
     * <code>.sajari.api.query.v1.SearchRequest.Tracking.Type type = 1;</code>
     */
    private $type = 0;
    /**
     * <pre>
     * Query ID of the query.  If this is empty, then one is generated.
     * </pre>
     *
     * <code>string query_id = 2;</code>
     */
    private $query_id = '';
    /**
     * <pre>
     * Sequence number of query.
     * </pre>
     *
     * <code>int32 sequence = 3;</code>
     */
    private $sequence = 0;
    /**
     * <pre>
     * Tracking field (must be unique in the collection) used to identify documents in the collection.
     * </pre>
     *
     * <code>string field = 4;</code>
     */
    private $field = '';
    /**
     * <pre>
     * Custom values to be included in tracking data.
     * </pre>
     *
     * <code>map&lt;string, string&gt; data = 5;</code>
     */
    private $data;

    public function __construct() {
        \GPBMetadata\Sajari\Api\Query\V1\Query::initOnce();
        parent::__construct();
    }

    /**
     * <pre>
     * Tracking mode for query.
     * Tracking is done using tokens which are added to result sets and identify individual results.
     * Tokens are used to improve the ranking of documents by reporting clicks (i.e. positive action)
     * or pos/neg (i.e positive or negative reporting) on the position of a document in results.
     * </pre>
     *
     * <code>.sajari.api.query.v1.SearchRequest.Tracking.Type type = 1;</code>
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * <pre>
     * Tracking mode for query.
     * Tracking is done using tokens which are added to result sets and identify individual results.
     * Tokens are used to improve the ranking of documents by reporting clicks (i.e. positive action)
     * or pos/neg (i.e positive or negative reporting) on the position of a document in results.
     * </pre>
     *
     * <code>.sajari.api.query.v1.SearchRequest.Tracking.Type type = 1;</code>
     */
    public function setType($var)
    {
        GPBUtil::checkEnum($var, \Sajari\Api\Query\V1\SearchRequest_Tracking_Type::class);
        $this->type = $var;
    }

    /**
     * <pre>
     * Query ID of the query.  If this is empty, then one is generated.
     * </pre>
     *
     * <code>string query_id = 2;</code>
     */
    public function getQueryId()
    {
        return $this->query_id;
    }

    /**
     * <pre>
     * Query ID of the query.  If this is empty, then one is generated.
     * </pre>
     *
     * <code>string query_id = 2;</code>
     */
    public function setQueryId($var)
    {
        GPBUtil::checkString($var, True);
        $this->query_id = $var;
    }

    /**
     * <pre>
     * Sequence number of query.
     * </pre>
     *
     * <code>int32 sequence = 3;</code>
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * <pre>
     * Sequence number of query.
     * </pre>
     *
     * <code>int32 sequence = 3;</code>
     */
    public function setSequence($var)
    {
        GPBUtil::checkInt32($var);
        $this->sequence = $var;
    }

    /**
     * <pre>
     * Tracking field (must be unique in the collection) used to identify documents in the collection.
     * </pre>
     *
     * <code>string field = 4;</code>
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * <pre>
     * Tracking field (must be unique in the collection) used to identify documents in the collection.
     * </pre>
     *
     * <code>string field = 4;</code>
     */
    public function setField($var)
    {
        GPBUtil::checkString($var, True);
        $this->field = $var;
    }

    /**
     * <pre>
     * Custom values to be included in tracking data.
     * </pre>
     *
     * <code>map&lt;string, string&gt; data = 5;</code>
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * <pre>
     * Custom values to be included in tracking data.
     * </pre>
     *
     * <code>map&lt;string, string&gt; data = 5;</code>
     */
    public function setData(&$var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::STRING);
        $this->data = $arr;
    }

}
