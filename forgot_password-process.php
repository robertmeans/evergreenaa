<?php
require_once 'config/initialize.php';
require_once 'controllers/emailController.php';

$signal = '';
$msg = '';
$li = '';
$class = '';

// if user clicks on login
if (is_post_request() && isset($_POST['forgotpass'])) {
  $email = strtolower($_POST['email']);

  // validation
  if (empty($email)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li>Please enter the email address you used to create an account here and I\'ll send you a reset link.</li>';
    $class = 'red';
  }
  if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li>Email is invalid</li>';
    $class = 'red';    
  }


  if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $emailQuery = "SELECT * FROM users WHERE LOWER(email)=? LIMIT 1";
    $stmt = $conn->prepare($emailQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();

    /* updated to PHP v7.2 on GoDaddy and unchecked mysqli and checked nd_mysqli */
    /* in order to get this command to work */
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $userCount = $result->num_rows;
    $stmt->close();

    if ($userCount > 0) {
      $token = $user['token'];
      
      if (WWW_ROOT != 'http://localhost/evergreenaa') {
        sendPasswordResetLink($email, $token);
      }
      /*  else statement below set aside so you can easily toggle on and off when testing locally.
          leaving it on will cause the signup form to stall (indefinitely) on "Preparing Account".
          This will allow you to study that step in dev mode but still work online in case you
          forgot to un-comment when in production. */
      // else {
      //   sendVerificationEmail($username, $email, $token);
      // }
      

      $signal = 'ok';
      $msg = '<span class="login-txt">Help on the way!</span>';
      $li .= '<li>Please check your email (can take a minute or two).</li>';
      $class = 'green';
    } else {
      $signal = 'bad';
      $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
      $li .= '<li>There is no user here with that email address.</li>';
      $class = 'red';
    }

  }

}
$data = array(
  'signal' => $signal,
  'msg' => $msg,
  'li' => $li,
  'class' => $class
);
echo json_encode($data);
