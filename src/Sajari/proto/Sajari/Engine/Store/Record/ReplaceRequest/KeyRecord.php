<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/engine/store/record/record.proto

namespace Sajari\Engine\Store\Record\ReplaceRequest;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Key record pairs for replacement.
 *
 * Generated from protobuf message <code>sajari.engine.store.record.ReplaceRequest.KeyRecord</code>
 */
class KeyRecord extends \Google\Protobuf\Internal\Message
{
    /**
     * Key to identify record with.
     *
     * Generated from protobuf field <code>.sajari.engine.Key key = 1;</code>
     */
    private $key = null;
    /**
     * Record to replace existing record with.
     *
     * Generated from protobuf field <code>.sajari.engine.store.record.Record record = 2;</code>
     */
    private $record = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Sajari\Engine\Key $key
     *           Key to identify record with.
     *     @type \Sajari\Engine\Store\Record\Record $record
     *           Record to replace existing record with.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Sajari\Engine\Store\Record\Record::initOnce();
        parent::__construct($data);
    }

    /**
     * Key to identify record with.
     *
     * Generated from protobuf field <code>.sajari.engine.Key key = 1;</code>
     * @return \Sajari\Engine\Key
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Key to identify record with.
     *
     * Generated from protobuf field <code>.sajari.engine.Key key = 1;</code>
     * @param \Sajari\Engine\Key $var
     * @return $this
     */
    public function setKey($var)
    {
        GPBUtil::checkMessage($var, \Sajari\Engine\Key::class);
        $this->key = $var;

        return $this;
    }

    /**
     * Record to replace existing record with.
     *
     * Generated from protobuf field <code>.sajari.engine.store.record.Record record = 2;</code>
     * @return \Sajari\Engine\Store\Record\Record
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * Record to replace existing record with.
     *
     * Generated from protobuf field <code>.sajari.engine.store.record.Record record = 2;</code>
     * @param \Sajari\Engine\Store\Record\Record $var
     * @return $this
     */
    public function setRecord($var)
    {
        GPBUtil::checkMessage($var, \Sajari\Engine\Store\Record\Record::class);
        $this->record = $var;

        return $this;
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(KeyRecord::class, \Sajari\Engine\Store\Record\ReplaceRequest_KeyRecord::class);
