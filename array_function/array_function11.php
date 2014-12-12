<?php
global $my_func;
if (!isset($my_func))
{
    $my_func = create_function($args, $code);
}

$my_func();
?>