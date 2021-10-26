<?php 
require_once 'config/initialize.php';

if (is_post_request()) {

	if(isset($_POST['email-updates'])) {
		$id = $_SESSION['id'];
		$email_opt 			= $_POST['email-updates'];

		$result = email_opt($id, $email_opt);

		if ($result === true) {
			$signal = 'ok';
		  $msg =  'Update successful!';
		} else {
			$signal = 'bad';
			$msg = 'That didn\'t work. Are you clicking over and over real fast? I may have skipped a beat somewhere. Reload this page and try again.';
		}
	}
}

$data = array(
	'signal' => $signal,
	'msg' => $msg
);
echo json_encode($data);
