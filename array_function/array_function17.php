<?php
/**
 * create_ref_function
 * Create an anonymous (lambda-style) function
 * which returns a reference
 * see http://php.net/create_function
 */
function
create_ref_function( $args, $code )
{
    static $n = 0;

    $functionName = sprintf('ref_lambda_%d',++$n);

    $declaration = sprintf('function &%s(%s) {%s}',$functionName,$args,$body);

    eval($declaration);

    return $functionName;
}
?>