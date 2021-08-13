<?php 
require_once 'config/initialize.php';

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