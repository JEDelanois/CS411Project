<?php
function arrayToString($arr, $delim = ","){
    if(count($arr) == 0) return NULL;

    if(count($arr) == 1) return $arr[0];
    $str = "";
    foreach($arr as $value){
        $str .= "$value" . $delim;
    }
    rtrim($str, $delim);
    return $str;
}

