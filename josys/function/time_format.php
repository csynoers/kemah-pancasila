<?php
function time_format($value, $format="") {
    $time   = substr($value,11,8);
    if($format == "24") {
        $results    = date("H:i:s", strtotime($time));
    }
    else {
        $results    = date("g:i a", strtotime($time));
    }
    return $results;
}
