<?php

function run_function( $function )
{
    // Get Arguments, Unset Exisitng Parameter
    $params = func_get_args();
    unset( $params[0] );

    if( ( $count = count( $params ) ) > 0 )
    {
        $args = '$a';
        $inc = 'b';

        // Create Argument String - Formats as '$a, $b, $c' Per Number of Arguments
        for( $x = 1; $x < $count; $x++ )
        {
            $args .= ', $' . $inc;
            $inc++;
        }

        // Create Lambda Function and Format Paramters
        $lambda = create_function( $args, 'return ' . $function . '(' . $args . ');' );
        $params = "'" . implode('\', \'', $params) . "'";

        // Build and Evaluate Function with Parameters
        $eval = '$return = $lambda(' . $params . ');';
        eval($eval);

        return $return;
    }
    else
    {
        return false;
    }
}
?>