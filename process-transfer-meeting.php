<?php

require_once 'config/initialize.php';
require_once 'config/verify_admin.php';
if ($_SESSION['admin'] == 85 || $_SESSION['admin'] == 86) {
	header('location: ' . WWW_ROOT);
	exit();
}

	// $current_user = $_SESSION['admin'];
	$mtg_id = $_POST['current-mtg'];
	$host_email = $_POST['host-email'];
	$email = strtolower(trim($_POST['email'] ?? ''));

if (is_post_request()) {

	if($email) {

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

		$nhe = find_new_host($email); // take entered email address
		$exists = mysqli_num_rows($nhe); // run a query on it
		$newhost_id = mysqli_fetch_assoc($nhe); // put results in var $newhost_id
    if (isset($newhost_id['id_user'])) {
      $new_host = $newhost_id['id_user']; // now you've got the id of new user from entered email
    }
		
			if ($exists > 0) {

				if ($host_email != $email) {

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
					$msg = 'You\'re trying to transfer this to the current owner.';
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