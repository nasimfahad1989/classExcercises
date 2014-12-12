<?php

function create_lambda($args, $code) {
    static $list = array();
    $i = "{$args}\0{$code}";
    if (!isset($list[$i])) {
        $list[$i] = create_function($args, $code);
    }
    return $list[$i];
}