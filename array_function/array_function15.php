
<?php
$fn = create_function('', 'echo __FUNCTION__;');
$fn();
// Result: __lambda_func
echo $fn;
// Result: ºlambda_2 (the actual first character cannot be displayed)
?>