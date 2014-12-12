<?php
function create_closure($fun, $args, $uses)
{$params=explode(',', $args.','.$uses);
    $str_params='';
    foreach ($params as $v)
    {$v=trim($v, ' &$');
        $str_params.='\''.$v.'\'=>&$'.$v.', ';
    }
    return "return function({$args}) use ({$uses}) {{$fun}(array({$str_params}));};";
}
?>

    example:
<?php
$loop->addPeriodicTimer(1, eval(create_closure('pop_message', '$timer', '$cache_key, $n, &$response, &$redis_client')));

function pop_message($params)
{extract($params, EXTR_REFS);
    $redis_client->ZRANGE($cache_key, 0, $n)
        ->then(//normal
            function($data) use ($cache_key, $n, &$timer, &$response, &$redis_client)
            {//...
            },
            //exception
            function ($e) use (&$timer, &$response, &$redis_client)
            {//...
            }
        );
}
?