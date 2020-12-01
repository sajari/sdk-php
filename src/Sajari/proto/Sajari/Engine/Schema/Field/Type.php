<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/engine/schema/schema.proto

namespace Sajari\Engine\Schema\Field;

/**
 * Type represents the underlying data type of the field. Default is a string.
 *
 * Protobuf type <code>sajari.engine.schema.Field.Type</code>
 */
class Type
{
    /**
     * Generated from protobuf enum <code>STRING = 0;</code>
     */
    const STRING = 0;
    /**
     * Generated from protobuf enum <code>INTEGER = 1;</code>
     */
    const INTEGER = 1;
    /**
     * Generated from protobuf enum <code>FLOAT = 2;</code>
     */
    const FLOAT = 2;
    /**
     * Generated from protobuf enum <code>DOUBLE = 5;</code>
     */
    const DOUBLE = 5;
    /**
     * Generated from protobuf enum <code>BOOLEAN = 3;</code>
     */
    const BOOLEAN = 3;
    /**
     * Generated from protobuf enum <code>TIMESTAMP = 4;</code>
     */
    const TIMESTAMP = 4;
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Type::class, \Sajari\Engine\Schema\Field_Type::class);
