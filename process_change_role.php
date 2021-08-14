<?php

require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

	$user_id = $_POST['user'];
	$role = $_POST['admin'];
	$reason = $_POST['reason'];
	$mode = $_POST['mode'];

/* $mode is whether user is logged in as admin or not. 1=logged in Admin Mode, 0=not logged in Admin Mode. if they are downgraded out of Admin status then their mode needs to be changed to 0 in order to kick them out of Admin Mode if they are currently logged in and prevent them from doing anything as an Admin could or would. */
	if ($role == 0 || $role == 85 || $role == 86) {
		$mode = 0;
	} 

// in case someone tries to hardcode a 3 in role
// if (($_SESSION['id'] != 1) && $role == 3) {
// 	$signal = 'bad';
// 	$msg = 'really?';
// }

if (is_post_request()) {

	if ($role == '3') {
		$change_user_role = change_user_role($user_id, $role, $mode);

	  if ($change_user_role === true) {
			$signal = '3';
		  $msg =  'Transfer successful!';
	  } else {
	  	$signal = 'bad';
	  	$msg = 'uh oh... The Internet might have hiccupped while this was in process and it may or may not have transferred successfully. This is a very unique occrurance. Please confirm with the other user that they have the meeting. If it did not transfer successfully email me at the bottom of any page and I will fix it. Again, this is a really hard messge to see. Congratulations. :)';
	  }
	}


	if ($role == '2') {
		$change_user_role = change_user_role($user_id, $role, $mode);

	  if ($change_user_role === true) {
			$signal = '2';
		  $msg =  'Transfer successful!';
	  } else {
	  	$signal = 'bad';
	  	$msg = 'uh oh... The Internet might have hiccupped while this was in process and it may or may not have transferred successfully. This is a very unique occrurance. Please confirm with the other user that they have the meeting. If it did not transfer successfully email me at the bottom of any page and I will fix it. Again, this is a really hard messge to see. Congratulations. :)';
	  }
	}

	if ($role == '0') {
		$change_user_role = change_user_role($user_id, $role, $mode);

	  if ($change_user_role === true) {
			$signal = '0';
		  $msg =  'Transfer successful!';
	  } else {
	  	$signal = 'bad';
	  	$msg = 'uh oh... The Internet might have hiccupped while this was in process and it may or may not have transferred successfully. This is a very unique occrurance. Please confirm with the other user that they have the meeting. If it did not transfer successfully email me at the bottom of any page and I will fix it. Again, this is a really hard messge to see. Congratulations. :)';
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