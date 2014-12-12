<?php
$array_walk_recursive = create_function('&$array, $callback',
    'foreach($array as $element) {
        if(is_array($element)) {
            $funky = $GLOBALS["array_walk_recursive"];
            $funky($element, $callback);
        }
        else {
            $callback($element);
        }
    }');
?>