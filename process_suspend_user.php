<?php

require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

	$user_id = $_POST['user'];
	$role = $_POST['admin'];
	$reason = h($_POST['reason']);

if (is_post_request()) {
 
	if ($_SESSION['admin'] != 1 && $_SESSION['admin'] != 3) {
		$signal = 'bad';
		$msg = 'It appears you lack the necessary clearance to do this.';
	} else {

	 if (trim($reason)) {
			if ($role == '85') {
				$suspend_this_user = suspend_user_partial($role, $reason, $user_id);

			  if ($suspend_this_user === true) {
					$signal = '85';
				  $msg =  'success';
			  } else {
			  	$signal = 'bad';
			  	$msg = 'I don\'t think that worked.';
			  }
			}

			if ($role == '86') {
				$suspend_this_user = suspend_user_total($role, $reason, $user_id);

			  if ($suspend_this_user === true) {
					$signal = '86';
				  $msg =  'Transfer successful!';
			  } else {
			  	$signal = 'bad';
			  	$msg = 'I don\'t think that worked.';
			  }
			}
		} else {
			$signal = 'bad';
			$msg = 'Please give them some kind of reason for getting suspended.';
		}


	}
}

	$data = array(
		'signal' => $signal,
		'msg' => $msg
	);
	echo json_encode($data);

// stop

?>