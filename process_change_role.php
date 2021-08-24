<?php

require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

	$user_id = $_POST['user'];
	$role = $_POST['admin'];
	$reason = $_POST['reason'];
	$mode = $_POST['mode'];

/* $mode is whether user is logged in as admin or not. 1=logged in Admin Mode, 0=not logged in Admin Mode. if they are downgraded out of Admin status then their mode needs to be changed to 0 in order to kick them out of Admin Mode if they are currently logged in and prevent them from doing anything as an Admin could or would. */
	if ($role == 0 || $role == 85 || $role == 86) {
		$mode = '0';
	} 

if (is_post_request()) {	

	if ($_SESSION['admin'] != 1 && $_SESSION['admin'] != 3) {
		$signal = 'bad';
		$msg = 'It appears you lack the necessary clearance to do this.';
	} 

	if ($_SESSION['admin'] != 1 && ($role == 1 || $role == 3)) {
		$signal = 'bad';
		$msg = 'Are you trying to find a chink in my armor? That is no bueno and your name has been reported to the authorities. Gather your belongings and hide.';	
	} else {

		if ($role == '3') {
			$change_user_role = change_user_role($user_id, $role, $mode);

		  if ($change_user_role === true) {
				$signal = '3';
			  $msg =  'Transfer successful!';
		  } else {
		  	$signal = 'bad';
		  	$msg = 'I don\'t think that worked.';
		  }
		}

		if ($role == '2') {
			$change_user_role = change_user_role($user_id, $role, $mode);

		  if ($change_user_role === true) {
				$signal = '2';
			  $msg =  'Transfer successful!';
		  } else {
		  	$signal = 'bad';
		  	$msg = 'I don\'t think that worked.';
		  }
		}

		if ($role == '0') {
			$change_user_role = change_user_role($user_id, $role, $mode);

		  if ($change_user_role === true) {
				$signal = '0';
			  $msg =  'Transfer successful!';
		  } else {
		  	$signal = 'bad';
		  	$msg = 'I don\'t think that worked.';
		  }
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