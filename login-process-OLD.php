<?php
require_once 'config/initialize.php';

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
    $errors['usermane'] = "There are multiple \"" . $username . "'s\" here. You'll have to use your email address to login.";
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
      $_SESSION['id']       = $user['id_user'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['email']    = $user['email'];
      $_SESSION['verified'] = $user['verified'];
      $_SESSION['admin']    = $user['admin'];
      $_SESSION['mode']     = $user['mode'];
      $_SESSION['email_opt'] = $user['email_opt'];
      $_SESSION['db-tz']      = $user['tz'];
      $_SESSION['token']    = $user['token'];

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