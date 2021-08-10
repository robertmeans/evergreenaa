<?php

require_once 'config/initialize.php';
require_once 'config/verify_admin.php';
if ($_SESSION['admin'] == 85 || $_SESSION['admin'] == 86) {
	header('location: ' . WWW_ROOT);
	exit();
}

	$user_id = $_POST['user'];
	$role = $_POST['admin'];
	$reason = $_POST['reason'];

if (is_post_request()) {

	if ($role == '2') {
		$change_user_role = change_user_role($user_id, $role);

	  if ($change_user_role === true) {
			$signal = 'ok';
		  $msg =  'Transfer successful!';
	  } else {
	  	$signal = 'bad';
	  	$msg = 'uh oh... The Internet might have hiccupped while this was in process and it may or may not have transferred successfully. This is a very unique occrurance. Please confirm with the other user that they have the meeting. If it did not transfer successfully email me at the bottom of any page and I will fix it. Again, this is a really hard messge to see. Congratulations. :)';
	  }
	}

	if ($role == '0') {
		$change_user_role = change_user_role($user_id, $role);

	  if ($change_user_role === true) {
			$signal = 'okeedokee';
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