<?php

session_start();

require_once 'config/db.php';
require_once 'controllers/emailController.php';

$errors = [];
$username = "";
$email = "";
$verified = "";

function remember_me()
{
	global $connection;
	if (!empty($_COOKIE['token'])) {
		$token = $_COOKIE['token']; 
		
		$sql = "SELECT * FROM users WHERE token=? LIMIT 1";
		$stmt = $connection->prepare($sql);
		$stmt->bind_param('s', $token);

		if ($stmt->execute()) {
			$result = $stmt->get_result();
			$user = $result->fetch_assoc();

			// put user in session (log them in)
			$_SESSION['id'] = $user['id_user'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['verified'] = $user['verified'];
		}
	} 
}

remember_me();


if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$passwordConf = $_POST['passwordConf'];

	if (empty($username)) {
		$errors['username'] = "Please enter a username";
	}


	if ((!empty($username)) && (strlen($username) > 16)) {
		$errors['username'] = "Keep Username 16 characters or less";
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

	if ( ((!empty($password)) && (empty(!$passwordConf)))  &&   ($password !== $passwordConf)) {
		$errors['password'] = "Passwords don't match";
	}

	$emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
	$stmt = $connection->prepare($emailQuery);
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
		$stmt = $connection->prepare($sql);
		$stmt->bind_param('ssdss', $username, $email, $verified, $token, $password);

		if ($stmt-> execute()) {
			// login user
			$user_id = $connection->insert_id;
			$_SESSION['id'] = $user_id;
			$_SESSION['username'] = $username;
			$_SESSION['email'] = $email;
			// don't send a verified token because they're not verified yet!
			$_SESSION['verified'] = $verified;

		  	sendVerificationEmail($username, $email, $token);

			// set flash message
			$_SESSION['message'] = "Success! Almost there...";
			$_SESSION['alert-class'] = "alert-success";
			header('location: index.php');
			exit();

		} else {
			$errors['db_error'] = "Database error: failed to register";
		}
	}
}

// if user clicks on login
if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	// validation
	if (empty($username)) {
		$errors['username'] = "Username or email required";
	}

	if (empty($password)) {
		$errors['password'] = "Password required";
	}

	if (count($errors) === 0) {

		// having to accept email or username because of how Apple/ios binds these two
		// in their login management
		$sql = "SELECT * FROM users WHERE email=? OR username=? LIMIT 1";
		$stmt = $connection->prepare($sql);
		$stmt->bind_param('ss', $username, $username);
		$stmt->execute();
		$result = $stmt->get_result();
		$user = $result->fetch_assoc();

		if (password_verify($password, $user['password'])) {
			// login success
			$_SESSION['id'] = $user['id_user'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['verified'] = $user['verified'];

			// you're not verified yet -> go see a msg telling you we're waiting for
			// email verification
			if (($user['verified']) === 0) {
				$_SESSION['message'] = "Email has not been verified";
				$_SESSION['alert-class'] = "alert-danger";				
				header('location: index.php');
				exit();
			} else {

				// user is logged in and verified. did they check the rememberme?
				if (isset($_POST['remember_me'])) {
					$token = bin2hex(random_bytes(50)); // generate a unique token

					// if so, update token in db
					$update_token_query = "UPDATE users SET token='$token' WHERE id=" . $user['id_user'];
					if (mysqli_query($connection, $update_token_query)) {
						// set cookie with same credentials
						setCookie('token', $token, time() + (1825 * 24 * 60 * 60));
					}
				}
				// everything checks out -> you're good to go!
				header('location: home_private.php');
				exit();
			}

		} else {
			// the combination of stuff you typed doesn't match anything in the db
			$errors['login_fail'] = "Wrong credentials. Username is case sensitive.";
		}
	}
}


// verify user by token
function verifyUser($token) {

	global $connection;
	$sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
	$result = mysqli_query($connection, $sql);

	if (mysqli_num_rows($result) > 0) {
		$user = mysqli_fetch_assoc($result);
		$update_query = "UPDATE users SET verified=1 WHERE token='$token'";

		if (mysqli_query($connection, $update_query)) {
			// login success
			$_SESSION['id'] = $user['id_user'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['verified'] = 1;
			// set flash message
			$_SESSION['message'] = "Your email address was successfully verified! You can now login.";
			$_SESSION['alert-class'] = "alert-success";
			header('location: login.php');
			exit();
		}
	} else {
		echo 'User not found';
	}
}

// if user clicks on forgot password 
if (isset($_POST['forgot-password'])) {
	$email = $_POST['email'];

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = "Email is invalid";
	}

	if (empty($email)) {
		$errors['email'] = "Email required";
	}

	if (count($errors) == 0) {

		$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
		$result = mysqli_query($connection, $sql);
		$user = mysqli_fetch_assoc($result);
		$token = $user['token'];
		sendPasswordResetLink($email, $token);
		header('location: password_message.php');
		exit(0);
	}
}

// if user clicked on the reset password 
if (isset($_POST['reset-password-btn'])) {
	$password = $_POST['password'];
	$passwordConf = $_POST['passwordConf'];

	if (empty($password) || empty($passwordConf)) {
		$errors['password'] = "Password required";
	}

	if ($password !== $passwordConf) {
		$errors['password'] = "Passwords don't match";
	}

	$password = password_hash($password, PASSWORD_DEFAULT);
	$email = $_SESSION['email'];

	if(count($errors) == 0) {
		$sql = "UPDATE users SET password='$password' WHERE email='$email'";
		$result = mysqli_query($connection, $sql);
		if ($result) {
			$_SESSION['message'] = "Your password was changed successfully. You can now login with your new credentials.";
			$_SESSION['alert-class'] = "pass-reset";
			header('location: index.php');
			exit(0);
		}
	}
}

function resetPassword($token) 
{
	global $connection;
	$sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
	$result = mysqli_query($connection, $sql);
	$user = mysqli_fetch_assoc($result);
	$_SESSION['email'] = $user['email'];
	header('location: reset_password.php');
	exit(0);

}

