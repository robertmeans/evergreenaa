<?php

require_once 'controllers/emailController.php';

$errors = [];
$username = "";
$email = "";
$verified = "";
$admin = "";
$visible = "";

function remember_me()
{
	global $conn;
	if (!empty($_COOKIE['token'])) {
		$token = $_COOKIE['token']; 
		
		$sql = "SELECT * FROM users WHERE token=? LIMIT 1";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s', $token);

		if ($stmt->execute()) {
			$result = $stmt->get_result();
			$user = $result->fetch_assoc();

			// put variables in session
			$_SESSION['id'] = $user['id_user'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['verified'] = $user['verified'];
			$_SESSION['admin'] = $user['admin'];
			$_SESSION['mode'] = $user['mode'];
			$_SESSION['email_opt'] = $user['email_opt'];
			$_SESSION['db-tz'] = $user['tz'];
		}
	} 
}

remember_me();


// verify user by token
function verifyUser($token) {

	global $conn;
	$sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		$user = mysqli_fetch_assoc($result);
		$update_query = "UPDATE users SET verified=1 WHERE token='$token'";

		if (mysqli_query($conn, $update_query)) {
			// login success
      $_SESSION['skip'] = 'skip-intro';
			$_SESSION['id'] = $user['id_user'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['verified'] = 1;
			$_SESSION['admin'] = $user['admin'];
			$_SESSION['mode'] = $user['mode'];
			$_SESSION['email_opt'] = $user['email_opt'];
			$_SESSION['db-tz'] = $user['tz'];
			$_SESSION['message'] = "Your email address was successfully verified! You can now login.";
			$_SESSION['alert-class'] = "alert-success";
			header('location:'. WWW_ROOT . '/verified.php?token=' . $token);
			exit();
		}
	} else {
    $_SESSION['verified'] = 0;
		$_SESSION['message'] = "User not found.";
	}
}


function resetPassword($token) 
{
	global $conn;
	$sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$user = mysqli_fetch_assoc($result);
  $_SESSION['username'] = $user['username'];
	$_SESSION['email'] = $user['email'];
  $_SESSION['reset-token'] = $token;
	header('location: reset_password.php');
	exit(0);

}

