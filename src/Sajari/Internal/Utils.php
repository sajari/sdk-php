<?php

namespace Sajari\Internal;

class Utils {
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
