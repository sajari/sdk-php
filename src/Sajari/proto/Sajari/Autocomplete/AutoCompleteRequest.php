<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/autocomplete/autocomplete.proto

namespace Sajari\Autocomplete;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * AutoCompleteRequest is a query to be autocompleted.
 *
 * Generated from protobuf message <code>sajari.autocomplete.AutoCompleteRequest</code>
 */
class AutoCompleteRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Model to train.
     *
     * Generated from protobuf field <code>.sajari.autocomplete.Model model = 1;</code>
     */
    private $model = null;
    /**
     * The phrase to be autocompleted.
     *
     * Generated from protobuf field <code>string phrase = 2;</code>
     */
    private $phrase = '';
    /**
     * The query phrase broken into terms. Typically this would use spaces
     * as delimiters, but it is not restricted to spaces for language flexibility.
     *
     * Generated from protobuf field <code>repeated string terms = 3;</code>
     */
    private $terms;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Sajari\Autocomplete\Model $model
     *           Model to train.
     *     @type string $phrase
     *           The phrase to be autocompleted.
     *     @type string[]|\Google\Protobuf\Internal\RepeatedField $terms
     *           The query phrase broken into terms. Typically this would use spaces
     *           as delimiters, but it is not restricted to spaces for language flexibility.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Sajari\Autocomplete\Autocomplete::initOnce();
        parent::__construct($data);
    }

    /**
     * Model to train.
     *
     * Generated from protobuf field <code>.sajari.autocomplete.Model model = 1;</code>
     * @return \Sajari\Autocomplete\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Model to train.
     *
     * Generated from protobuf field <code>.sajari.autocomplete.Model model = 1;</code>
     * @param \Sajari\Autocomplete\Model $var
     * @return $this
     */
    public function setModel($var)
    {
        GPBUtil::checkMessage($var, \Sajari\Autocomplete\Model::class);
        $this->model = $var;

        return $this;
    }

    /**
     * The phrase to be autocompleted.
     *
     * Generated from protobuf field <code>string phrase = 2;</code>
     * @return string
     */
    public function getPhrase()
    {
        return $this->phrase;
    }

    /**
     * The phrase to be autocompleted.
     *
     * Generated from protobuf field <code>string phrase = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setPhrase($var)
    {
        GPBUtil::checkString($var, True);
        $this->phrase = $var;

        return $this;
    }

    /**
     * The query phrase broken into terms. Typically this would use spaces
     * as delimiters, but it is not restricted to spaces for language flexibility.
     *
     * Generated from protobuf field <code>repeated string terms = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * The query phrase broken into terms. Typically this would use spaces
     * as delimiters, but it is not restricted to spaces for language flexibility.
     *
     * Generated from protobuf field <code>repeated string terms = 3;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setTerms($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->terms = $arr;

        return $this;
    }

}
