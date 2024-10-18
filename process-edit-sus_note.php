<?php 
require_once 'config/initialize.php';

if (is_post_request()) {

	$reason   	= trim(h($_POST['reason']) ?? '');
	$user 			= $_POST['user-id'];

	if($reason) {


		$update_sus_notes = update_sus_note($reason, $user);

		if ($update_sus_notes === true) {
			$signal = 'ok';
		  $msg =  'Transfer successful!';	
		} else {
	  	$signal = 'bad';
	  	$msg = 'Hmm, that didn\'t seem to take. You can try refreshing the page and doing it again or maybe your Internet is down? You\'d still see this message even if your Internet connection had dropped since you started this.';
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
