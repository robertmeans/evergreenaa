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

// sign-up
if (is_post_request() && isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = strtolower($_POST['email']);
	$password = $_POST['password'];
	$passwordConf = $_POST['passwordConf'];

	if (empty($username)) {
		$errors['username'] = "Please enter a username";
	}

	if ((!empty($username)) && (strlen($username) > 16)) {
		$errors['username'] = "Keep Username 16 characters or less";
	}

	if ((!empty($username)) && (strpos($username,','))) {
		$errors['username'] = "Sorry, you can't have a comma in your Username.";
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = "Email is invalid";
	}

	if (empty($email)) {
		$errors['email'] = "Email required";
	}

	if (empty($password)) {
		$errors['password'] = "Password required";
	}

	if ((!empty($password)) && (strlen($password) <= 3)) {
		$errors['password'] = "Password needs at least 4 characters";
	}

	if ((!empty($password)) && (strlen($password) > 50)) {
		$errors['password'] = "Keep your password under 50 characters";
	}

	if ((!empty($password)) && (empty($passwordConf))) {
		$errors['password'] = "Confirm password";
	}

	if ((empty($password)) && (empty(!$passwordConf))) {
		$errors['password'] = "Slow down - Type same password in both fields";
	}	

	if ( ((!empty($password)) && (empty(!$passwordConf))) && ($password !== $passwordConf)) {
		$errors['password'] = "Passwords don't match. Note: passwords are case sensitive.";
	}

	$emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
	$stmt = $conn->prepare($emailQuery);
	$stmt->bind_param('s', $email);
	$stmt->execute();

	/* updated to PHP v7.2 on GoDaddy and unchecked mysqli and checked nd_mysqli */
	/* in order to get this command to work */
	$result = $stmt->get_result();

	$userCount = $result->num_rows;
	$stmt->close();

	if($userCount > 0) {
		$errors['email'] = "Email already exists";
	}

	if (count($errors) === 0) {
		$password = password_hash($password, PASSWORD_DEFAULT);
		$token = bin2hex(random_bytes(50));
		$verified = false;

		$sql = "INSERT INTO users (username, email, verified, token, password) VALUES (?, ?, ?, ?, ?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('ssdss', $username, $email, $verified, $token, $password);

		if ($stmt-> execute()) {
			// login user
			$user_id = $conn->insert_id;
			$_SESSION['id'] = $user_id;
			$_SESSION['username'] = $username;
			$_SESSION['email'] = $email;
			// don't send a verified token because they're not verified yet!
			$_SESSION['verified'] = $verified;
			$_SESSION['admin'] = '0';
			$_SESSION['mode'] = '0';
			$_SESSION['email_opt'] = '1';

		  	sendVerificationEmail($username, $email, $token);

			// set flash message
			$_SESSION['message'] = "Success! Almost there...";
			$_SESSION['alert-class'] = "alert-success";
			header('location:' . WWW_ROOT);
			exit();

		} else {
			$errors['db_error'] = "Database error: failed to register";
		}
	}
}

// if user clicks on login
if (is_post_request() && isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	// validation
	if (empty($username)) {
		$errors['username'] = "Username or email required";
	}

	if (empty($password)) {
		$errors['password'] = "Password required";
	}

	// $userQuery = "SELECT * FROM users WHERE username=? LIMIT 2";
	$userQuery = "SELECT * FROM users WHERE LOWER(username) LIKE LOWER(?) LIMIT 2";
	$stmt = $conn->prepare($userQuery);
	$stmt->bind_param('s', $username);
	$stmt->execute();

	$result = $stmt->get_result();

	$userCount = $result->num_rows;
	$stmt->close();

	if($userCount > 1) {
		$errors['usermane'] = "There are multiple \"" . $username . "'s\" here AND you have the same password... but you don't have the same email address! You'll have to use your email address to login.";
	}	

	if (count($errors) === 0) {

		// having to accept email or username because of how Apple/ios binds these two
		// in their login management
		// $sql = "SELECT * FROM users WHERE email=? OR username=? LIMIT 1";
		$sql = "SELECT * FROM users WHERE LOWER(email) LIKE LOWER(?) OR LOWER(username) LIKE LOWER(?) LIMIT 1";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('ss', $username, $username);
		$stmt->execute();
		$result = $stmt->get_result();
		$userCount = $result->num_rows;
		$user = $result->fetch_assoc();

		if (password_verify($password, $user['password'])) {
			// login success
			$_SESSION['id'] 			= $user['id_user'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['email'] 		= $user['email'];
			$_SESSION['verified'] = $user['verified'];
			$_SESSION['admin'] 		= $user['admin'];
			$_SESSION['mode'] 		= $user['mode'];
			$_SESSION['email_opt'] = $user['email_opt'];
			$_SESSION['db-tz'] 			= $user['tz'];
			$_SESSION['token'] 		= $user['token'];

			// you're not verified yet -> go see a msg telling you we're waiting for
			// email verification
			if (($user['verified']) === 0) {
				$_SESSION['message'] = "Email has not been verified";
				$_SESSION['alert-class'] = "alert-danger";				
				header('location:'. WWW_ROOT);
				exit();
			} else {

				// user is logged in and verified. did they check the rememberme?
				if (isset($_POST['remember_me'])) {
					$token = $_SESSION['token'];
					setCookie('token', $token, time() + (1825 * 24 * 60 * 60));
				}
				// everything checks out -> you're good to go!
				// header('location: home_private.php');
				header('location:' . WWW_ROOT);
				exit();
			}

		} else if ($userCount < 1) {
			$errors['login_fail'] = "That user does not exist";
		} else {
			// the combination of stuff you typed doesn't match anything in the db
			$errors['login_fail'] = "Wrong Username/Password combination. Note: passwords are case sensitive.";
		}
	}
}


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
			header('location:'. WWW_ROOT);
			exit();
		}
	} else {
		echo 'User not found';
	}
}

// if user clicks on forgot password 
if (is_post_request() && isset($_POST['forgot-password'])) {
	$email = $_POST['email'];

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = "Email is invalid";
	}

	if (empty($email)) {
		$errors['email'] = "Email required";
	}

	if (count($errors) == 0) {

		$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($result);
		$user_exists = mysqli_num_rows($result);

		if ($user_exists > 0) {
			$token = $user['token'];
			sendPasswordResetLink($email, $token);
			header('location: password_message.php');
			exit(0);
		} else {
			$_SESSION['message'] = "There is no user here with that email address.";
			$_SESSION['alert-class'] = "alert-danger";				
			header('location:'. WWW_ROOT . '/forgot_password.php');
			exit();
		}
	}
}

// if user clicked on the reset password 
if (is_post_request() && isset($_POST['reset-password-btn'])) {
	$password = $_POST['password'];
	$passwordConf = $_POST['passwordConf'];

	if (empty($password) || empty($passwordConf)) {
		$errors['password'] = "Password required";
	}

	if ($password !== $passwordConf) {
		$errors['password'] = "Passwords don't match. Note: passwords are case sensitive.";
	}

	$password = password_hash($password, PASSWORD_DEFAULT);
	$email = $_SESSION['email'];

	if(count($errors) == 0) {
		$sql = "UPDATE users SET password='$password' WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			$_SESSION['message'] = "Your password was changed successfully. You can now login with your new credentials.";
			$_SESSION['alert-class'] = "pass-reset";
			header('location: login.php');
			exit(0);
		}
	}
}

function resetPassword($token) 
{
	global $conn;
	$sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$user = mysqli_fetch_assoc($result);
	$_SESSION['email'] = $user['email'];
	header('location: reset_password.php');
	exit(0);

}

