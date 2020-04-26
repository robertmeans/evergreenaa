<?php
date_default_timezone_set('America/Denver');

$script_tz = date_default_timezone_get();

if (strcmp($script_tz, ini_get('date.timezone'))){
    echo 'Script timezone differs from ini-set timezone.';
} else {
    echo 'Script timezone and ini-set timezone match.';
}

?><br><br><?php

echo 'deal with the wrong time on your localhost later... ' . date(' l, F j, Y') . " at " . date('g:i');


$meet_time = strtotime('g:i');
echo date($meet_time);

?>