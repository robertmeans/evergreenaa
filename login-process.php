<?php
require_once 'config/initialize.php';

$signal = '';
$msg = '';
$li = '';
$class = '';
$password_txt = '';
$msg_txt = '';
$count = '';

// if user clicks on login
if (is_post_request() && isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // validation
  if (empty($username)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Username or email required</li>';
    $class = 'red';
  }

  if (empty($password)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Please enter your password</li>';
    $class = 'red';
  }




// if (!empty($username) && !empty($password)) {
  if ($li === '') {

    // $userQuery = "SELECT * FROM users WHERE username=? LIMIT 2";
    $userQuery = "SELECT * FROM users WHERE LOWER(username) LIKE LOWER(?) LIMIT 2";
    $stmt = $conn->prepare($userQuery);
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $result = $stmt->get_result();

    $userCount = $result->num_rows;
    $stmt->close();

      if ($userCount > 1) {
        $signal = 'bad';
        $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
        $li .= '<li class="no-count">There are multiple users with the username "' . $username . '". Please use your email address to login.</li>';
        $class = 'orange';
      } else if (count($errors) === 0) {

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
          $signal = 'bad';
          $msg = '<span class="login-txt"><img src="_images/login.png"></span>';
          $li .= '<li class="no-count">Email has not been verified</li>';
          $class = 'blue';
        } else {

          // user is logged in and verified. did they check the rememberme?
          if (isset($_POST['remember_me'])) {
            $token = $_SESSION['token'];
            setCookie('token', $token, time() + (1825 * 24 * 60 * 60));
          }

        /*  local testing */   
        // if (WWW_ROOT != 'http://localhost/evergreenaa') {
        //   sleep(3600); 
        // }

          // everything checks out -> you're good to go!
          $signal = 'ok';
        }

      } else if ($userCount < 1) {
        $signal = 'bad';
        $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
        $li .= '<li class="no-count">That user does not exist</li>';
        $class = 'red';
      } else {
        // the combination of stuff you typed doesn't match anything in the db
        $signal = 'bad';
        $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
        $li .= '<li class="count">Wrong Username/Password combination. (Note: Passwords are case sensitive.)</li>';
        $class = 'red';
        $count = 'on';
      }

    }
    
  } 

}
$data = array(
  'signal' => $signal,
  'msg' => $msg,
  'li' => $li,
  'class' => $class,
  'password_txt' => $password_txt,
  'msg_txt' => $msg_txt,
  'count' => $count
);
echo json_encode($data);
