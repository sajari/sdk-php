<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/engine/store/term/term.proto

namespace Sajari\Engine\Store\Term;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Information for a list of terms.
 *
 * Generated from protobuf message <code>sajari.engine.store.term.Infos</code>
 */
class Infos extends \Google\Protobuf\Internal\Message
{
    /**
     * Information for a list of terms.
     *
     * Generated from protobuf field <code>repeated .sajari.engine.store.term.Infos.Info infos = 1;</code>
     */
    private $infos;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Sajari\Engine\Store\Term\Infos\Info[]|\Google\Protobuf\Internal\RepeatedField $infos
     *           Information for a list of terms.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Sajari\Engine\Store\Term\Term::initOnce();
        parent::__construct($data);
    }

    /**
     * Information for a list of terms.
     *
     * Generated from protobuf field <code>repeated .sajari.engine.store.term.Infos.Info infos = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getInfos()
    {
        return $this->infos;
    }

    /**
     * Information for a list of terms.
     *
     * Generated from protobuf field <code>repeated .sajari.engine.store.term.Infos.Info infos = 1;</code>
     * @param \Sajari\Engine\Store\Term\Infos\Info[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setInfos($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Sajari\Engine\Store\Term\Infos\Info::class);
        $this->infos = $arr;

        return $this;
    }

}
