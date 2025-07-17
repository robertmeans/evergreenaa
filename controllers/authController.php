<?php

require_once 'controllers/emailController.php';

$errors = [];
$username = "";
$email = "";
$verified = "";
$admin = "";
$visible = "";

function remember_me() {
  global $pdo_db;

  if (!empty($_COOKIE['token'])) {
    $token = $_COOKIE['token'];

    try {
      $sql  = "SELECT id_user, username, email, verified, mode, role, email_opt, tz, theme ";
      $sql .= "FROM users ";
      $sql .= "WHERE token = :token ";
      $sql .= "LIMIT 1";

      $stmt = $pdo_db->prepare($sql);
      $stmt->execute(['token' => $token]);

      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($user) {
        // put variables in session
        $_SESSION['id'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['verified'] = $user['verified'];
        $_SESSION['mode'] = $user['mode'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['email_opt'] = $user['email_opt'];
        $_SESSION['db-tz'] = $user['tz'];
        $_SESSION['db-theme'] = $user['theme'];
      }

    } catch (PDOException $e) {
      error_log('Remember Me Error: ' . $e->getMessage());
      // Optional: clear the cookie to prevent repeated failure
      setcookie('token', '', time() - 3600, '/');
    }
  }
}

remember_me();


// verify user by token
// function verifyUser($token) {

// 	global $conn;
// 	$sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
// 	$result = mysqli_query($conn, $sql);

// 	if (mysqli_num_rows($result) > 0) {
// 		$user = mysqli_fetch_assoc($result);
// 		$update_query = "UPDATE users SET verified=1 WHERE token='$token'";

// 		if (mysqli_query($conn, $update_query)) {
// 			// login success
//       $_SESSION['skip'] = 'skip-intro';
// 			$_SESSION['id'] = $user['id_user'];
// 			$_SESSION['username'] = $user['username'];
// 			$_SESSION['email'] = $user['email'];
// 			$_SESSION['verified'] = 1;
// 			$_SESSION['mode'] = $user['mode'];
//       $_SESSION['role'] = $user['role'];
// 			$_SESSION['email_opt'] = $user['email_opt'];
// 			$_SESSION['db-tz'] = $user['tz'];
//       $_SESSION['db-theme'] = $user['theme'];
// 			$_SESSION['message'] = "Your email address was successfully verified! You can now login.";
// 			$_SESSION['alert-class'] = "alert-success";
// 			header('location:'. WWW_ROOT . '/verified.php?token=' . $token);
// 			exit();
// 		}
// 	} else {
//     $_SESSION['verified'] = 0;
// 		$_SESSION['message'] = "User not found.";
// 	}
// }


function verifyUser($token) {
  global $pdo_db;

  try {
    $stmt = $pdo_db->prepare("
      SELECT 
        id_user, username, email, mode, role, email_opt, tz, theme 
      FROM users 
      WHERE token = :token 
      LIMIT 1
    ");
    $stmt->execute(['token' => $token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      $update_stmt = $pdo_db->prepare("
        UPDATE users 
        SET verified = 1 
        WHERE token = :token 
        LIMIT 1
      ");
      $update_stmt->execute(['token' => $token]);
      // login success
      $_SESSION['skip'] = 'skip-intro';
      $_SESSION['id'] = $user['id_user'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['verified'] = 1;
      $_SESSION['mode'] = $user['mode'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['email_opt'] = $user['email_opt'];
      $_SESSION['db-tz'] = $user['tz'];
      $_SESSION['db-theme'] = $user['theme'];
      $_SESSION['message'] = "Your email address was successfully verified! You can now login.";
      $_SESSION['alert-class'] = "alert-success";

    } else {
      $_SESSION['verified'] = 0;
      $_SESSION['message'] = "User not found.";
    }

    header('location:'. WWW_ROOT . '/verified.php?token=' . $token);
    exit();

  } catch (PDOException $e) {
    // optional - log error to error log
    $_SESSION['message'] = "The token provided does not match anyone here. If you copied & pasted, you may have missed something.";
    header('location:' . WWW_ROOT);
    exit();
  }
}












function resetPassword($token) {
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

