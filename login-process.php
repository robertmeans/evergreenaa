<?php
require_once 'config/initialize.php';

// if user clicks on login
if (is_post_request() && isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];


  // validation
  if (empty($username) && empty($password)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li = '<li>Username or email required</li><li>You forgot your password</li>';
  } else if (empty($username)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li = '<li>Username or email required</li>';
  } else if (empty($password)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li = '<li>You forgot your password</li>';
  } else if (!empty($username) && !empty($password)) {

    // $userQuery = "SELECT * FROM users WHERE username=? LIMIT 2";
    $userQuery = "SELECT * FROM users WHERE LOWER(username) LIKE LOWER(?) LIMIT 2";
    $stmt = $conn->prepare($userQuery);
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $result = $stmt->get_result();

    $userCount = $result->num_rows;
    $stmt->close();

      if($userCount > 1) {
        $signal = 'bad';
        $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
        $li = '<li>There are multiple "' . $username . '\'s" here. You\'ll have to use your email address to login.</li>';
      } else {
        $signal = 'ok';
      }


  } else {
    $signal = 'ok';
  }



}
$data = array(
  'signal' => $signal,
  'msg' => $msg,
  'li' => $li,
  'password_txt' => $password_txt,
  'msg_txt' => $msg_txt
);
echo json_encode($data);
