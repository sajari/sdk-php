<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/api/query/v1/query.proto

namespace Sajari\Api\Query\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 * Tokens are used to mark result documents as well/poorly ranked for a query.
 * TODO(dhowden): fix this comment!
 * </pre>
 *
 * Protobuf type <code>sajari.api.query.v1.Token</code>
 */
class Token extends \Google\Protobuf\Internal\Message
{
    protected $token;

    public function __construct() {
        \GPBMetadata\Sajari\Api\Query\V1\Query::initOnce();
        parent::__construct();
    }

    /**
     * <code>.sajari.api.query.v1.Token.Click click = 1;</code>
     */
    public function getClick()
    {
        return $this->readOneof(1);
    }

    /**
     * <code>.sajari.api.query.v1.Token.Click click = 1;</code>
     */
    public function setClick(&$var)
    {
        GPBUtil::checkMessage($var, \Sajari\Api\Query\V1\Token_Click::class);
        $this->writeOneof(1, $var);
    }

    /**
     * <code>.sajari.api.query.v1.Token.PosNeg pos_neg = 2;</code>
     */
    public function getPosNeg()
    {
        return $this->readOneof(2);
    }

    /**
     * <code>.sajari.api.query.v1.Token.PosNeg pos_neg = 2;</code>
     */
    public function setPosNeg(&$var)
    {
        GPBUtil::checkMessage($var, \Sajari\Api\Query\V1\Token_PosNeg::class);
        $this->writeOneof(2, $var);
    }

    public function getToken()
    {
        return $this->whichOneof("token");
    }

}

