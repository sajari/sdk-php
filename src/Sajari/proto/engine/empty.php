<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin 1.0
// Source: engine/empty.proto
//   Date: 2016-12-12 02:45:19

namespace sajari\engine {

  class Empty extends \DrSlump\Protobuf\Message {


    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'sajari.engine.Empty');

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }
  }
}

