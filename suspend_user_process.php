<?php

require_once 'config/initialize.php';

	$user_id = $_POST['suspend-user'];
	$reason = $_POST['reason'];

if (is_post_request()) {

	$suspend_this_user = suspend_user_query($user_id, $reason);

	  if ($suspend_this_user === true) {
			$signal = 'ok';
		  $msg =  'Transfer successful!';
	  } else {
	  	$signal = 'bad';
	  	$msg = 'uh oh... The Internet might have hiccupped while this was in process and it may or may not have transferred successfully. This is a very unique occrurance. Please confirm with the other user that they have the meeting. If it did not transfer successfully email me at the bottom of any page and I will fix it. Again, this is a really hard messge to see. Congratulations. :)';
	  }
		
}

	$data = array(
		'signal' => $signal,
		'msg' => $msg
	);
	echo json_encode($data);

// stop

?>