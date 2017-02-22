<?php

namespace Sajari\Misc {
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
    }

}
