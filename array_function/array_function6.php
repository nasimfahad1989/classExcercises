<?php

function create_lambda($args, $code) {
    static $func;
    if (!isset($func[$args][$code])) {
        $func[$args][$code] = create_function($args, $code);
    }
    return $func[$args][$code];
}