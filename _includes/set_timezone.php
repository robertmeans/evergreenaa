<?php

if (!isset($_SESSION['tz']) || !isset($_COOKIE['timezone'])) {
	setCookie('timezone', 'not-set', time() + (3650 * 24 * 60 * 60), '/'); // 10 years
	$cookie = 'not-set';
	$tz = 'America/Denver';
} elseif ($_COOKIE['timezone'] == 'not-set') {
	$cookie = 'not-set';
	$tz = 'America/Denver';
} elseif (isset($_SESSION['tz'])) {
	$tz = $_SESSION['tz'];	
	$cookie = $tz;
} 
