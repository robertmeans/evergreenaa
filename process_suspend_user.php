<?php

require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

	$user_id = $_POST['user'];
	$role = $_POST['admin'];
	$reason = $_POST['reason'];

// in case someone tries to hardcode a 3 in role
// if (($_SESSION['id'] != 1) && $role == 3) {
// 	$signal = 'bad';
// 	$msg = 'really?';
// }

if (is_post_request()) {
 
 if (trim($reason)) {
		if ($role == '85') {
			$suspend_this_user = suspend_user_partial($role, $reason, $user_id);

		  if ($suspend_this_user === true) {
				$signal = '85';
			  $msg =  'success';
		  } else {
		  	$signal = 'bad';
		  	$msg = 'uh oh... The Internet might have hiccupped while this was in process and it may or may not have transferred successfully. This is a very unique occrurance. Please confirm with the other user that they have the meeting. If it did not transfer successfully email me at the bottom of any page and I will fix it. Again, this is a really hard messge to see. Congratulations. :)';
		  }
		}

		if ($role == '86') {
			$suspend_this_user = suspend_user_total($role, $reason, $user_id);

		  if ($suspend_this_user === true) {
				$signal = '86';
			  $msg =  'Transfer successful!';
		  } else {
		  	$signal = 'bad';
		  	$msg = 'uh oh... The Internet might have hiccupped while this was in process and it may or may not have transferred successfully. This is a very unique occrurance. Please confirm with the other user that they have the meeting. If it did not transfer successfully email me at the bottom of any page and I will fix it. Again, this is a really hard messge to see. Congratulations. :)';
		  }
		}
	} else {
		$signal = 'bad';
		$msg = 'Please give them some kind of reason for getting suspended.';
	}



}

	$data = array(
		'signal' => $signal,
		'msg' => $msg
	);
	echo json_encode($data);

// stop

?>