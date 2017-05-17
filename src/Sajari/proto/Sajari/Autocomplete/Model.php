<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/autocomplete/autocomplete.proto

namespace Sajari\Autocomplete;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 * Model is an autocomplete model.
 * </pre>
 *
 * Protobuf type <code>sajari.autocomplete.Model</code>
 */
class Model extends \Google\Protobuf\Internal\Message
{
    /**
     * <pre>
     * Name of the model.
     * </pre>
     *
     * <code>string name = 1;</code>
     */
    private $name = '';

    public function __construct() {
        \GPBMetadata\Sajari\Autocomplete\Autocomplete::initOnce();
        parent::__construct();
    }

    /**
     * <pre>
     * Name of the model.
     * </pre>
     *
     * <code>string name = 1;</code>
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * <pre>
     * Name of the model.
     * </pre>
     *
     * <code>string name = 1;</code>
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;
    }

}
