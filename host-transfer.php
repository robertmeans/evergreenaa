<?php

require_once 'config/initialize.php';

	$mtg_id = $_POST['current-mtg'];
	$email = strtolower(trim($_POST['email']));
	$current_email = $_POST['current-host-email'];
	// $current_emailz = $_SESSION['email'];


if (is_post_request()) {

	if($email) {

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {



		// $nh = get_new_host_id($email);
		// $rowq = mysqli_fetch_assoc($nh);

		// $newhost = $rowq['email'];
		// $emhuser = $rowq['username'];

		$nhe = find_new_host($email);
		$exists = mysqli_num_rows($nhe);
		$newhost_id = mysqli_fetch_assoc($nhe);
		$new_host = $newhost_id['id_user'];
		
			if ($exists > 0) {

				if ($current_email != $email) {


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
					$msg = 'You can\'t transfer the meeting to yourself!';
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