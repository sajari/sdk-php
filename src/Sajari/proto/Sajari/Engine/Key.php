<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/engine/key.proto

namespace Sajari\Engine;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Key is a key-value pair that uniquely determines a record in a collection.
 * Any unique field in a collection can be used to create a key.
 *
 * Generated from protobuf message <code>sajari.engine.Key</code>
 */
class Key extends \Google\Protobuf\Internal\Message
{
    /**
     * Field is the meta field (must be a unique field).
     *
     * Generated from protobuf field <code>string field = 1;</code>
     */
    private $field = '';
    /**
     * Value is the identifying value.
     *
     * Generated from protobuf field <code>.sajari.engine.Value value = 2;</code>
     */
    private $value = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $field
     *           Field is the meta field (must be a unique field).
     *     @type \Sajari\Engine\Value $value
     *           Value is the identifying value.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Sajari\Engine\Key::initOnce();
        parent::__construct($data);
    }

    /**
     * Field is the meta field (must be a unique field).
     *
     * Generated from protobuf field <code>string field = 1;</code>
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Field is the meta field (must be a unique field).
     *
     * Generated from protobuf field <code>string field = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setField($var)
    {
        GPBUtil::checkString($var, True);
        $this->field = $var;

        return $this;
    }

    /**
     * Value is the identifying value.
     *
     * Generated from protobuf field <code>.sajari.engine.Value value = 2;</code>
     * @return \Sajari\Engine\Value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Value is the identifying value.
     *
     * Generated from protobuf field <code>.sajari.engine.Value value = 2;</code>
     * @param \Sajari\Engine\Value $var
     * @return $this
     */
    public function setValue($var)
    {
        GPBUtil::checkMessage($var, \Sajari\Engine\Value::class);
        $this->value = $var;

        return $this;
    }

}
