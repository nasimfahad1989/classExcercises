
<?php

usort($sv, create_function('$a,$b','return strlen($b) - strlen($a);'));
print_r($sv);

?>
