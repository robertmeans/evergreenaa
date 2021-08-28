<?php 
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

if (is_post_request()) {

	 if (isset($_POST['post-id'])) {
		$row = [];

		if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3) {
			// let admin delete this
			$row['id_user'] = $_POST['uid'];
		} else {
			$row['id_user'] = $_SESSION['id'];
		}

		$row['id_topic'] 	 = $_POST['post-id'];

		$result = delete_post($row);

		if ($result === true) {
			$signal = 'ok';
		  $msg =  'Transfer successful!';
		} else {
			$signal = 'bad';
			$msg = 'That didn\'t work. I\'ve got no more information for you either. Maybe restart your browser and try it again?';
		}

	} else {
			$signal = 'bad';
			$msg = 'not getting post array...?!';
	}

}

$data = array(
	'signal' => $signal,
	'msg' => $msg
);
echo json_encode($data);

// stop
