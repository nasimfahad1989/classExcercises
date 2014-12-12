<?php
function createFunctor($className){
    $content = "
                static \$class;
                if(!\$class){
                        \$class = new $className;
                }
                return \$class->run(\$args);
        ";
    $f = create_function('$args', $content);
    return $f;

}
class test {
    public function run($args){
        print $args;
    }
}
$test = createFunctor('test');
$test('hello world');
?>