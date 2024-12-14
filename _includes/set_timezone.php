<?php
require_once 'config/initialize.php';

if (isset($_SESSION['id'])) {
	$user_id = $_SESSION['id'];
	$user_role = $_SESSION['role'];
} else {
	$user_id = 'ns';
	$user_role = '0';
}


/* BEGIN: TZ related */
// processing has to come before if statements so it can catch a submission (duh)
if (is_post_request() && isset($_POST['set-tz'])) {

	if ($user_id != 'ns') {
		$timezone = $_POST['timezone'];
		$url = $_POST['tz-url'];

		$result = set_timezone($timezone, $user_id);

		if ($result === true) {
			// setCookie('timezone', $timezone, time() + (3650 * 24 * 60 * 60), '/'); // 10 years
			$_SESSION['db-tz'] = $timezone;
		  header('location:' . $url);
		} else {
			$errors = $result;
		}
	} else {
		$timezone = $_POST['timezone'];
		
		setCookie('sessionTZ', $timezone, time() + (3650 * 24 * 60 * 60), '/'); // 10 years
		$_SESSION['session-tz'] = $timezone;
	  header('location:' . WWW_ROOT);
	}
}


$new_tz = '';
$tz = 'America/Denver';

if (isset($_SESSION['db-tz']) && $_SESSION['db-tz'] != 'not-set') {
	// they're logged in an their tz has already been set
	$tz = $_SESSION['db-tz'];
	return;
} elseif (isset($_SESSION['db-tz']) && $_SESSION['db-tz'] == 'not-set') {
	// they're logged in but they haven't set their tz yet
	$new_tz = 'member';
	$tz = 'America/Denver';
	return;
} elseif (!empty($_COOKIE['sessionTZ'])) {
	$tz = $_COOKIE['sessionTZ'];
	return;
} elseif (isset($_SESSION['session-tz'])) {
	$tz = $_SESSION['session-tz'];
	return;
}
/* END: TZ related */
