<?php

namespace Sajari\Internal {
    class Utils {
        public static function MakeRepeated(array $values, $type, $messageType = null) {

            // const DOUBLE   =  1;
            // const FLOAT    =  2;
            // const INT64    =  3;
            // const UINT64   =  4;
            // const INT32    =  5;
            // const FIXED64  =  6;
            // const FIXED32  =  7;
            // const BOOL     =  8;
            // const STRING   =  9;
            // const GROUP    = 10;
            // const MESSAGE  = 11;
            // const BYTES    = 12;
            // const UINT32   = 13;
            // const ENUM     = 14;
            // const SFIXED32 = 15;
            // const SFIXED64 = 16;
            // const SINT32   = 17;
            // const SINT64   = 18;

            $arr = new \Google\Protobuf\Internal\RepeatedField($type, $messageType);
            foreach ($values as $value) {
                $arr[] = $value;
            }
            return $arr;
        }

        public static function _require_all($dir, $depth=0) {
            // require all php files
            $scan = glob("$dir/*");
            foreach ($scan as $path) {
                if (preg_match('/\.php$/', $path)) {
                    require_once $path;
                }
                elseif (is_dir($path)) {
                    Utils::_require_all($path, $depth+1);
                }
            }
        }
    }

}
