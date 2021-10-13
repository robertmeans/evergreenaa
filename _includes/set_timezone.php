<?php
require_once 'config/initialize.php';

if (isset($_SESSION['id'])) {
	$user_id = $_SESSION['id'];
	$user_role = $_SESSION['admin'];
} else {
	$user_id = 'ns';
	$user_role = '0';
}

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

?>

<?php

if (is_post_request() && isset($_POST['set-tz'])) {

	if ($user_id != 'ns') {
		$timezone = $_POST['timezone'];
		$url = $_POST['tz-url'];

		$result = set_timezone($timezone, $user_id);

		if ($result === true) {
			setCookie('timezone', $timezone, time() + (3650 * 24 * 60 * 60), '/'); // 10 years
			$_SESSION['tz'] = $timezone;
		  header('location:' . $url);
		} else {
			$errors = $result;
		}
	} else {
		$timezone = $_POST['timezone'];
		
		setCookie('timezone', $timezone, time() + (3650 * 24 * 60 * 60), '/'); // 10 years
		$_SESSION['tz'] = $timezone;
	  header('location:' . WWW_ROOT);
	}
}

?>

