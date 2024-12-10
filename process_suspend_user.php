<?php

require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

	$user_id = $_POST['user'];
	$role = $_POST['role'];
	$reason = trim(h($_POST['reason']) ?? '');

if (is_post_request()) {
 
	if ($_SESSION['role'] != 99 && $_SESSION['role'] != 80) {
		$signal = 'bad';
		$msg = 'It appears you lack the necessary clearance to do this.';
	} else {

	 if (trim($reason)) {
			if ($role == '1') { // start

				if (strlen($reason) < 250) {

					$suspend_this_user = suspend_user_partial($role, $reason, $user_id);

				  if ($suspend_this_user === true) {
						$signal = '1';
					  $msg =  'success';
				  } else {
				  	$signal = 'bad';
				  	$msg = 'I don\'t think that worked.';
				  }

				} else {
					$signal = 'bad';
					$msg = 'Let\'s keep this to 250 characters or less. Right now you\'ve got ' . strlen($reason) . ' characters.';
				}

			} // end

			if ($role == '0') {

				if (strlen($reason) < 250) {
					$suspend_this_user = suspend_user_total($role, $reason, $user_id);

				  if ($suspend_this_user === true) {
						$signal = '0';
					  $msg =  'Transfer successful!';
				  } else {
				  	$signal = 'bad';
				  	$msg = 'I don\'t think that worked.';
				  }

				} else {
					$signal = 'bad';
					$msg = 'Let\'s keep this to 250 characters or less. Right now you\'ve got ' . strlen($reason) . ' characters.';
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