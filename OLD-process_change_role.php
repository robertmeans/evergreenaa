<?php

require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

	$user_id = $_POST['user'];
	$role = $_POST['role'];
	$reason = $_POST['reason'];
	$mode = $_POST['mode'];

/* $mode is whether user is logged in as admin or not. 1=logged in Admin Mode, 0=not logged in Admin Mode. if they are downgraded out of Admin status then their mode needs to be changed to 0 in order to kick them out of Admin Mode if they are currently logged in and prevent them from doing anything as an Admin could or would. */
	if ($role == 0 || $role == 1) {
		$mode = '0';
	} 

if (is_post_request()) {	

	if (!is_executive()) {
		$signal = 'bad';
		$msg = 'It appears you lack the necessary clearance to do this.';
	} 

	if ($_SESSION['role'] != 99 && ($role == 99 || $role == 80)) {
		$signal = 'bad';
		$msg = 'Are you trying to find a chink in my armor? That is no bueno and your name has been reported to the authorities. Gather your belongings and hide.';	
	} else {

		if ($role == '80') {
			$change_user_role = change_user_role($user_id, $role, $mode);

		  if ($change_user_role === true) {
				$signal = '80';
			  $msg =  'Transfer successful!';
		  } else {
		  	$signal = 'bad';
		  	$msg = 'I don\'t think that worked.';
		  }
		}

		if ($role == '60') {
			$change_user_role = change_user_role($user_id, $role, $mode);

		  if ($change_user_role === true) {
				$signal = '60';
			  $msg =  'Transfer successful!';
		  } else {
		  	$signal = 'bad';
		  	$msg = 'I don\'t think that worked.';
		  }
		}

    if ($role == '40') {
      $change_user_role = change_user_role($user_id, $role, $mode);

      if ($change_user_role === true) {
        $signal = '40';
        $msg =  'Transfer successful!';
      } else {
        $signal = 'bad';
        $msg = 'I don\'t think that worked.';
      }
    }

    if ($role == '20') {
      $change_user_role = change_user_role($user_id, $role, $mode);

      if ($change_user_role === true) {
        $signal = '20';
        $msg =  'Transfer successful!';
      } else {
        $signal = 'bad';
        $msg = 'I don\'t think that worked.';
      }
    }

		if ($role == '0') {
			$change_user_role = change_user_role($user_id, $role, $mode);

		  if ($change_user_role === true) {
				$signal = '0';
			  $msg =  'Transfer successful!';
		  } else {
		  	$signal = 'bad';
		  	$msg = 'I don\'t think that worked.';
		  }
		}

    if ($role == '1') {
      $change_user_role = change_user_role($user_id, $role, $mode);

      if ($change_user_role === true) {
        $signal = '1';
        $msg =  'Transfer successful!';
      } else {
        $signal = 'bad';
        $msg = 'I don\'t think that worked.';
      }
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