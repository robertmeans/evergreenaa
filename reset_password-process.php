<?php
require_once 'config/initialize.php';

$signal = '';
$msg = '';
$li = '';
$class = '';
// $session_email = $_SESSION['email'];

// if user clicks on login
if (is_post_request() && isset($_POST['resetpass'])) {

  $password = $_POST['password'];
  $passwordConf = $_POST['passwordConf'];

  // validation
  if (empty($password) || empty($passwordConf)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li>Password required</li>';
    $class = 'red';    
  }
  if ($password !== $passwordConf) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li>Passwords don\'t match. Note: passwords are case sensitive.</li>';
    $class = 'red'; 
  }



  if ($li === '') {

    $password = password_hash($password, PASSWORD_DEFAULT);
    $email = strtolower($_SESSION['email']);


    // global $conn;
    $sql = "UPDATE users SET password='$password' WHERE LOWER(email)='$email'";
    // $result = mysqli_query($conn, $sql);

    if (mysqli_query($conn, $sql)) {
      $_SESSION['message'] = "Your password was changed successfully. You can now login with your new credentials.";
      $_SESSION['alert-class'] = "pass-reset";
      // header('location: login.php');
      // exit(0);
      $signal = 'ok';
    } else {
      $signal = 'bad';
      $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
      $li .= '<li>There\'s been a database error. The crackpot team of busy beavers at the hosting company are surely fretting away. Please try again later and report this error at the bottom of the screen if you are so inclined.</li>';
      $class = 'red';

    }
  } else {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li>It looks like you may have submitted a password reset request more than once and you are using an outdated token. Please initiate another <a class="fp-link" href="' . WWW_ROOT . '/forgot_password.php">reset</a> and use the link from that email. If you feel you are seeing this in error please let me know at the bottom of this page.</li>';
    $class = 'red';    
  }

}
$data = array(
  'signal' => $signal,
  'msg' => $msg,
  'li' => $li,
  'class' => $class
);
echo json_encode($data);
