<?php

require_once 'config/initialize.php';
require_once 'config/verify_admin.php';
if ($_SESSION['admin'] == 85 || $_SESSION['admin'] == 86) {
	header('location: ' . WWW_ROOT);
	exit();
}

	$current_user = $_SESSION['admin'];
	$mtg_id = $_POST['current-mtg'];
	$host_email = $_POST['host-email'];
	$email = strtolower(trim($_POST['email']));

if (is_post_request()) {

	if($email) {

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

		$nhe = find_new_host($email);
		$exists = mysqli_num_rows($nhe);
		$newhost_id = mysqli_fetch_assoc($nhe);
		$new_host = $newhost_id['id_user'];
		
			if ($exists > 0) {

				if (($current_user == 1 || $current_user == 2 || $current_user == 3) && $host_email != $email) {

					$change_host = update_host($mtg_id, $new_host);

				  if ($change_host === true) {
						$signal = 'ok';
					  $msg =  'Transfer successful!';
				  } else {
				  	$signal = 'bad';
				  	$msg = 'uh oh... The Internet might have hiccupped while this was in process and it may or may not have transferred successfully. This is a very unique occrurance. Please confirm with the other user that they have the meeting. If it did not transfer successfully email me at the bottom of any page and I will fix it. Again, this is a really hard messge to see. Congratulations. :)';
				  }
				} else {
					$signal = 'bad';
					$msg = 'This is already one of your meetings.';
				}

			} else {
				$signal = 'bad';
				$msg = 'That email address is not registered here. The new host has to be a member of EvergreenAA.com before you can transfer a meeting to them.';
			}

		} else {
		  $signal = 'bad';
		  $msg = 'Invalid email address. Please fix.';
		}

	} else {
		$signal = 'bad';
		$msg = 'Please enter email address of the member to whom you are transferring this meeting.';
	}

}
	$data = array(
		'signal' => $signal,
		'msg' => $msg
	);
	echo json_encode($data);

// stop

?>