
<?php
runkit_function_copy('create_function', 'create_function_native');
runkit_function_redefine('create_function', '$arg,$body', 'return __create_function($arg,$body);');

function __create_function($arg, $body) {
    static $cache = array();
    static $maxCacheSize = 64;
    static $sorter;

    if ($sorter === NULL) {
        $sorter = function($a, $b) {
            if ($a->hits == $b->hits) {
                return 0;
            }

            return ($a->hits < $b->hits) ? 1 : -1;
        };
    }

    $crc = crc32($arg . "\\x00" . $body);

    if (isset($cache[$crc])) {
        ++$cache[$crc][1];
        return $cache[$crc][0];
    }

    if (sizeof($cache) >= $maxCacheSize) {
        uasort($cache, $sorter);
        array_pop($cache);
    }

    $cache[$crc] = array($cb = eval('return function('.$arg.'){'.$body.'};'), 0);
    return $cb;
}
?>
