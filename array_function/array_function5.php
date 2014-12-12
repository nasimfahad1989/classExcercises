<?php
function create_function_alias($function_name, $alias_name)
{
    if(function_exists($alias_name))
        return false;
    $rf = new ReflectionFunction($function_name);
    $fproto = $alias_name.'(';
    $fcall = $function_name.'(';
    $need_comma = false;

    foreach($rf->getParameters() as $param)
    {
        if($need_comma)
        {
            $fproto .= ',';
            $fcall .= ',';
        }

        $fproto .= '$'.$param->getName();
        $fcall .= '$'.$param->getName();

        if($param->isOptional() && $param->isDefaultValueAvailable())
        {
            $val = $param->getDefaultValue();
            if(is_string($val))
                $val = "'$val'";
            $fproto .= ' = '.$val;
        }
        $need_comma = true;
    }
    $fproto .= ')';
    $fcall .= ')';

    $f = "function $fproto".PHP_EOL;
    $f .= '{return '.$fcall.';}';

    eval($f);
    return true;
}
?>