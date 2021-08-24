<?php 
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';
if ($_SESSION['admin'] == 0 || $_SESSION['admin'] == 85 || $_SESSION['admin'] == 86) {
	header('location: ' . WWW_ROOT);
	exit();
}

if (is_post_request()) {

	if(isset($_POST['mode'])) {
		$id     	= $_SESSION['id'];
		$mode   	= $_POST['mode'];
		$url 			= $_POST['url'];

		$result = update_admin_mode($id, $mode);

		if ($result === true) {
		$_SESSION['mode'] = $mode;

			header('location:' . $url);
		} else {
		$errors = $result;
		}
	}
}