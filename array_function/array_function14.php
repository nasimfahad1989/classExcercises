<?php
function class_function($name,$params,$code) {

    $this->runtime_functions[$name] = create_function($params,$code);

}
?>

In a subclass of class_container, there was a function that utilized class_function() to store some custom lambda functions that were self-referential:

<?php
function myfunc($name,$code) {

    $this->class_function($name,'$theobj','$this=&$theobj;'.$code);

}
?>