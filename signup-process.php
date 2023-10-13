<?php
require_once 'config/initialize.php';
require_once 'controllers/emailController.php';

$signal = '';
$msg = '';
$li = '';
$class = '';
$password_txt = '';
$msg_txt = '';

// if user clicks on login
if (is_post_request() && isset($_POST['signup'])) {
  $username = $_POST['username'];
  $email = strtolower($_POST['email']);
  $password = $_POST['password'];
  $passwordConf = $_POST['passwordConf'];


  // validation
  if (empty($username)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li>Please enter a username</li>';
    $class = 'red';
  }

  if ((!empty($username)) && (strlen($username) > 16)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li>Keep Username 16 characters or less</li>';
    $class = 'red';
  }

  if ((!empty($username)) && (strpos($username,','))) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li>Sorry, you can\'t have a comma in your Username.</li>';
    $class = 'red';
  }

  if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li>Email is invalid</li>';
    $class = 'red';
  }

  if (empty($email)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li>Email required</li>';
    $class = 'red';
  }

  if (empty($password)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li>Password required</li>';
    $class = 'red';
  }

  if ((!empty($password)) && (strlen($password) <= 3)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li>Password needs at least 4 characters</li>';
    $class = 'red';
  }

  if ((!empty($password)) && (strlen($password) > 50)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li>Keep your password under 50 characters</li>';
    $class = 'red';
  }

  if ((!empty($password)) && (empty($passwordConf))) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li>Confirm password</li>';
    $class = 'red';
  }

  if ((empty($password)) && (empty(!$passwordConf))) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li>Slow down - Type same password in both fields</li>';
    $class = 'red';
  } 

  if ( ((!empty($password)) && (empty(!$passwordConf))) && ($password !== $passwordConf)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li>Passwords don\'t match. (Note: Passwords are case sensitive.)</li>';
    $class = 'red';
  }

  $emailQuery = "SELECT * FROM users WHERE LOWER(email)=? LIMIT 1";
  $stmt = $conn->prepare($emailQuery);
  $stmt->bind_param('s', $email);
  $stmt->execute();

  /* updated to PHP v7.2 on GoDaddy and unchecked mysqli and checked nd_mysqli */
  /* in order to get this command to work */
  $result = $stmt->get_result();

  $userCount = $result->num_rows;
  $stmt->close();

  if($li === '' && $userCount > 0) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li>Email already exists</li>';
    // $li .= '<li>Email already exists</li><li>'. $userCount . '</li>';
    $class = 'red';
  }

  if ($li === '') {
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

      if (WWW_ROOT != 'http://localhost/evergreenaa') {
        sendVerificationEmail($username, $email, $token);
      }

      // set flash message
      $_SESSION['message'] = "Success! Almost there...";
      $_SESSION['alert-class'] = "alert-success";
      // header('location:' . WWW_ROOT);
      // exit();
      $signal = 'ok';

    } else {
      $signal = 'bad';
      $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
      $li .= '<li>"Database error: failed to register. Please try again later. There are issues on the server that are being worked on.</li>';
      $class = 'red';
    }
  } 

}
$data = array(
  'signal' => $signal,
  'msg' => $msg,
  'li' => $li,
  'class' => $class,
  'password_txt' => $password_txt,
  'msg_txt' => $msg_txt
);
echo json_encode($data);
