<?php 
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

if (is_post_request()) {

	if (isset($_POST['mb-title'])) { // this is a new post
		$row = [];
		$row['id_user'] = $_SESSION['id'];
		$row['mb_header']   = h($_POST['mb-title']);
		$row['mb_body'] 	 = h($_POST['mb-post']);

		$result = add_new_post($row);

		if ($result === true) {
			$signal = 'ok';
		  $msg =  'Transfer successful!';
		} else {
			$signal = 'bad';
			$msg = 'That didn\'t work. I\'ve got no more information for you either. Maybe restart your browser and try it again?';
		}
	} // end new post

	if (isset($_POST['mb-reply'])) { // this is a reply
		$row = [];
		$row['id_user'] = $_SESSION['id'];
		$row['mb_topic']   = h($_POST['post-id']);
		$row['mb_reply']   = h($_POST['mb-reply']);

		$result = add_mb_reply($row);

		if ($result === true) {
			$signal = 'ok';
		  $msg =  'Transfer successful!';
		} else {
			$signal = 'bad';
			$msg = 'That didn\'t work. I\'ve got no more information for you either. Maybe restart your browser and try it again?';
		}

	} // end reply

}

$data = array(
	'signal' => $signal,
	'msg' => $msg
);
echo json_encode($data);

// stop
