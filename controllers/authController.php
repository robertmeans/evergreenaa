<?php

session_start();

// **Awa: You probably forgot to share the db.php file with me so I commented this out
require_once 'config/db.php';
require_once 'controllers/emailController.php';
require_once '_functions/awyeeah.php';
require_once '_functions/query_functions.php';

// set global variables
$db = db_connect();
$errors = array();
$username = "";
$email = "";
$verified = "";


/* **Awa: 
	The remember me functionality uses a cookie called token. 
	Here's a brief explanation of how cookies work: We had set a cookie on the user's browser when they
	had logged in with the remember me option selected. Now each time they visit a page
	(Request a page to be served to them from the server),
	that token cookie we set earlier will be sent to the server automatically inside the PHP super global 
	array variable called $_COOKIE. We can then check for the availability of this token, and then if it exists,
	we will fetch the user with that token (the token is unique to that user) and then log that user in 
*/
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

			// put user in session (log them in)
			$_SESSION['id'] = $user['id'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['verified'] = $user['verified'];
		}
	} 
}

/* **Awa: 
	Execute the remember_me() function to remember the user (log user in automatically) 
	if they had selected the remember me checkbox the last time they logged in.
	If this file authController.php is not included in any page, then you might want to 
	include it in that page for the remember me to work there too. Or you could just define this
	function inside that file and execute it. I recommend the first option 
*/
remember_me();
	
// https://www.youtube.com/watch?v=8K4Wt37Itc4&list=PL3pyLl-dgiqDt7xKIdvhoSKrR7KqIQ9PQ
// 30:25
// if user clicks on the sign up button
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

	// ^ all input is valid on signup -> now 
	// https://www.youtube.com/watch?v=8K4Wt37Itc4&list=PL3pyLl-dgiqDt7xKIdvhoSKrR7KqIQ9PQ
	// 38:20...
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

	// https://www.youtube.com/watch?v=8K4Wt37Itc4&list=PL3pyLl-dgiqDt7xKIdvhoSKrR7KqIQ9PQ
	// 42:00
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
	$email = $_POST['email'];
	$password = $_POST['password'];

	// validation
	if (empty($email)) {
		$errors['email'] = "Email required";
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = "Email is invalid";
	}

	if (empty($password)) {
		$errors['password'] = "Password required";
	}

	if (count($errors) === 0) {
		// https://www.youtube.com/watch?v=8K4Wt37Itc4&list=PL3pyLl-dgiqDt7xKIdvhoSKrR7KqIQ9PQ
		// 1:05:38'ish
		// $sql = "SELECT * FROM users WHERE email=? OR username=? LIMIT 1";
		$sql = "SELECT * FROM users WHERE email=? LIMIT 1";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s', $email);
		$stmt->execute();
		$result = $stmt->get_result();
		$user = $result->fetch_assoc();

		if (password_verify($password, $user['password'])) {
			// login success
			$_SESSION['id'] = $user['id'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['verified'] = $user['verified'];

			// at this point you are recognized in the db however we need to determine if
			// you are verified or not. if so -> home_private, if not -> index for msg
			// saying you are not verified yet

			// you're not verified yet -> go see a msg telling you we're waiting for
			// email verification
			if (($user['verified']) === 0) {
				$_SESSION['message'] = "Email has not been verified";
				$_SESSION['alert-class'] = "alert-danger";				
				header('location: index.php');
				exit();
			} else {
				/* **Awa: User is verified and has successfully logged in at this point. 
					Now we want to check if the user gave instructions to the system to 
					remember them. We do this by checking if they checked the 'remember me' checkbox
					on the login form
				*/
				if (isset($_POST['remember_me'])) {
					$token = bin2hex(random_bytes(50)); // generate a unique token

					// Update the token field of that particular user record in the database 
					// with the newly generated token 
					$update_token_query = "UPDATE users SET token='$token' WHERE id=" . $user['id'];
					if (mysqli_query($conn, $update_token_query)) {
						// Set and send a cookie called token to be stored on the user's browswer 
						// so that they can be remembered next time they come to the website 
						setCookie('token', $token, time() + (1825 * 24 * 60 * 60));
					}
				}
				// everything checks out -> you're good to go!
				header('location: home_private.php');
				exit();
			}

		} else {
			// the combination of stuff you typed doesn't match anything in the db
			$errors['login_fail'] = "Wrong credentials";
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
			$_SESSION['id'] = $user['id'];
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
		// time 12:07 - he says to use prepared statements, not what's below
		$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
		$result = mysqli_query($conn, $sql);
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
		$result = mysqli_query($conn, $sql);
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
	global $conn;
	$sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$user = mysqli_fetch_assoc($result);
	$_SESSION['email'] = $user['email'];
	header('location: reset_password.php');
	exit(0);

}