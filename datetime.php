<?php
date_default_timezone_set('America/Denver');

$script_tz = date_default_timezone_get();

if (strcmp($script_tz, ini_get('date.timezone'))){
    echo 'Script timezone differs from ini-set timezone.';
} else {
    echo 'Script timezone and ini-set timezone match.';
}

?><br><br><?php

echo 'In the Mountain timezone it\'s ' . date(' l, F j, Y') . " at " . date('g:i A');


$meet_time = strtotime('g:i A');
echo date($meet_time);

?>