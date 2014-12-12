<?php
$FileName = "functions.inc";
$FileHandle = fopen($FileName,"r");
$FileContent = fread($FileHandle,filesize($FileName));
fclose($FileHandle);

preg_match_all("#function\ ?([a-zA-Z0-9-_]*)\ ?\((.*?)\)\ ?\{(.*?)\}#mixse",$FileContent,$Matches);
if ( is_array($Matches) && isset($Matches[0]) && count($Matches[0]) > 0  ) {
    foreach ( $Matches[0] as $key=>$val ) {
        $$Matches[1][$key] = create_function($Matches[2][$key],$Matches[3][$key]);
    }
}
?>
