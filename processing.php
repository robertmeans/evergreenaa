<?php

/* BEGIN: error checking for President only 
   - only one outside 'is_post_request()'    */
if (isset($_GET['filename_of_errors'])) {
  $filename = $_GET['filename_of_errors'];

  if (file_exists($filename) && filesize($filename) > 0) {
    echo "File is not empty";
  } else {
    echo "File is empty or does not exist";
  }
} /* 'filename_of_errors' */


require_once 'config/initialize.php';

if (is_post_request()) { /* closes at very bottom of page */

/* BEGIN: reset errors (President only) */
if (isset($_POST['process_reset_errors'])) {
  $filename = "_errors.txt";
  if (unlink($filename)) {
    echo 'ok';
    } else {
      echo 'nope';
    }
  }

/* END: reset errors */

/* BEGIN: login */
if (isset($_POST['login_routine'])) {

  $signal = '';
  $msg = '';
  $li = '';
  $class = '';
  $password_txt = '';
  $msg_txt = '';
  $count = '';
  $theme = '';

  // if user clicks on login
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // if (WWW_ROOT == 'http://localhost/evergreenaa') { sleep(2); }

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

        if ($userCount == 1 && password_verify($password, $user['password'])) {
          // login success
          $_SESSION['id']       = $user['id_user'];
          $_SESSION['username'] = $user['username'];
          $_SESSION['email']    = $user['email'];
          $_SESSION['verified'] = $user['verified'];
          $_SESSION['role']    = $user['role'];
          $_SESSION['mode']     = $user['mode'];
          $_SESSION['email_opt'] = $user['email_opt'];
          $_SESSION['db-tz']      = $user['tz'];
          $_SESSION['db-theme'] = $user['theme'];
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

} /* 'login_routine' */



/* BEGIN: sign up */
if (isset($_POST['sign_up_process_routine'])) {

  require_once 'controllers/emailController.php';

  $signal = '';
  $msg = '';
  $li = '';
  $class = '';
  $password_txt = '';
  $msg_txt = '';

  // if user clicks on signup
  if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = strtolower($_POST['email']);
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];

    if (WWW_ROOT == 'http://localhost/evergreenaa') { sleep(2); }

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
        
        $user_id = $conn->insert_id;

        $_SESSION['id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        // don't send a verified token because they're not verified yet!
        $_SESSION['verified'] = $verified;
        $_SESSION['role'] = '20';
        $_SESSION['mode'] = '0';
        $_SESSION['email_opt'] = '1';

        // set flash message
        $_SESSION['message'] = "Success! Almost there...";
        $_SESSION['alert-class'] = "alert-success";

        if (WWW_ROOT != 'http://localhost/evergreenaa') {
          sendVerificationEmail($username, $email, $token);
        } else {
          sleep(3); // for local testing
        }

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


} /* 'sign_up_process_routine' */

/* BEGIN: forgot password */
if (isset($_POST['forgot_password_routine'])) {

  require_once 'controllers/emailController.php';

  if (isset($_POST['forgotpass'])) {
    $signal = '';
    $msg = '';
    $li = '';
    $class = '';
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
        $username = $user['username'];
        
        if (WWW_ROOT != 'http://localhost/evergreenaa') {
          sendPasswordResetLink($username, $email, $token);
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

} /* 'forgot_password_routine' */

/* BEGIN: reset password */
if (isset($_POST['reset_password_routine'])) {
  $signal = '';
  $msg = '';
  $li = '';
  $class = '';
  // $session_email = $_SESSION['email'];

  // if user clicks on login
  if (isset($_POST['resetpass'])) {

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
   
        $signal = 'ok';
      } else {
        $signal = 'bad';
        $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
        $li .= '<li>There\'s been a database error. The crackpot team of busy beavers at the hosting company are surely fretting away. Please try again later and report this error at the bottom of the screen if you are so inclined.</li>';
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
} /* 'reset_password_routine' */

/* BEGIN: Theme related */
if (isset($_POST['my-new-ip'])) {

  if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
  } else {
    $user_id = 'ns';
  }

  $passed_list = $_POST['current-list'];
  $current_list = $passed_list;
  $my_current_ip = $_POST['my-new-ip'];
  $new_ip_list = $current_list . ',' . $my_current_ip;

  $url = $_POST['this-here-url'];

  $result = add_ip($new_ip_list);

  if ($result === true) {
    header('location:' . $url);
  } else {
    $errors = $result;
  }
} /* close 'my-new-ip' */




/* BEGIN: theme popup */
if (isset($_POST['process_theme_popup'])) {

  /*  Notes on this -

      in _scripts-staging.js there's $(document).ready(function().. [search: $("#theme-options").hide();] that runs this on every page load to determine whether or not to show _includes/msg-theme-message.php

      files involved with this popup:
      1. config/initialize.php
      2. _includes/messages.php
      3. javascript-to-compile/_scripts-staging.js
      4. included in: home
  */

  if (!isset($theme_popup_on_off)) { return; } else { /* '$theme_popup_on_off' master switch in initialize.php */
    
    $i = 0;

    // if (empty($_COOKIE['theme-popup'])) { /* dev */
    if (!empty($_COOKIE['theme-popup'])  ) { /* pro */

      /* this is everything right here. if they have a $_COOKIE['theme-popup'] that means they've seen the popup. while I want something that persists across logged in <-> not logged in, that could be impractical in certain, rare, circumstances (e.g., 2 people use same computer. 1 as visitor the other as member. if member changed the theme the visitor would never see the popup, or vice versa.) ...overthink much? */ 
      $popup_signal = 'nope';


    } else if (!isset($_COOKIE['theme-popup-count']) || $_COOKIE['theme-popup-count'] < 1) {
      $i++; /* show on 2nd visit just to make sure they've seen the dark theme first */
      setCookie('theme-popup-count', $i, time() + (3650 * 24 * 60 * 60), '/'); // 10 years
      $popup_signal = 'nope';
    } else {
      /* just a layer of reduncancy to ensure nobody accidently sees this popup a 2nd time */
      if (  (!empty($_COOKIE['sessionTheme']) && $_COOKIE['sessionTheme'] == '1') || 
            (isset($_SESSION['db-theme']) && $_SESSION['db-theme'] == '1')      ) {
        $popup_signal = 'nope';
      } else {
        setCookie('theme-popup', 'shown', time() + (3650 * 24 * 60 * 60), '/'); // 10 years
        $popup_signal = 'ok'; 

      }

    }
    $data = array(
      'popup_signal' => $popup_signal
    );
    echo json_encode($data);

  }

} /* 'process_theme_popup' */






/* BEGIN: toggling admin mode on & off */
if (isset($_POST['process-admin-mode'])) {

  $id       = $_SESSION['id'];
  $mode     = $_POST['mode'];
  $url      = $_POST['url'];

  $result = update_admin_mode($id, $mode);

  if ($result === true) {
  $_SESSION['mode'] = $mode;

    header('location:' . $url);
  } else {
  $errors = $result;
  }
} /* close 'process-admin-mode' */













/* BEGIN: changing theme */
if (isset($_POST['change-theme'])) { 

  if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
  } else {
    $user_id = 'ns';
  }

  /* this page has to fire in order to log a theme change either to a cookie (for visitors) or a cookie + db for members. the random stuff wrapped in 'if (isset($analytics_on_off))' is to isolate all the *extra* stuff I'm watching without disturbing the basic functionality that's necessary to let the theme toggle work. all the extra stuff can be turned on/off from config/initialize.php. */ 

  if (isset($analytics_on_off)) {
    if (!isset($_SESSION['bi'])) { /* using 'bi' here so I can make one change in process-analytics.php to reset all these session vars */
      $me = array('1', '2');
      $ip = get_ip_list();
      $also_me = explode(',', $ip['ip_ignore']);
      $their_ip = $_SERVER['REMOTE_ADDR'];

      $_SESSION['bbiw'] = 'set'; /* so this block + sql query only has to run once per visit */
      $_SESSION['bi'] = $me; /* bob's id's */
      $_SESSION['ca'] = $ip; /* compare against */
      $_SESSION['am'] = $also_me;
      $_SESSION['ti'] = $their_ip;

    }
    if (!isset($_SESSION['id'])) { $a_user_id = 'ns'; } else { $a_user_id = $_SESSION['id']; }
  }

  if ($user_id != 'ns') { /* members who are logged in */
    $theme = $_POST['theme'];
    $url = $_POST['themeurl'];
    
    if (isset($analytics_on_off)) { /* log a theme change into theme_use table to placate my own vanity - so I can bask in the validation of all this effort, that someone, somewhere found this and actually used it. */

      if (!in_array($a_user_id, $_SESSION['bi']) && !in_array($_SESSION['ti'], $_SESSION['am'])) { /* exclude me from count - or anyone using same IP as me */
        $date = new DateTime('now', new DateTimeZone('America/Denver'));
        $now = $date->format("H:i D, m.d.y");

        if ($theme === '0') { $color = 'Dark'; } else { $color = 'Bright'; }
        monitor_theme_usage($now, $user_id, $color, $_SESSION['ti']);
      }
    }

    /* set alert to '1' so I get a visual notification on the frontend (menu tab changes to green) */
    $turn_on_alert = update_alert_notification();

    /* now update their theme in the users table */
    $result = set_theme($theme, $user_id);
    /* they're not getting a cookie because, ultimately, if they're logged in, what's in the db will take precedence over a cookie anyway. when they're logged in $theme = $_SESSION['db-theme']. see functions.php: 'configure_theme()' */

    if ($result === true) {
      $_SESSION['db-theme'] = $theme;
      header('location:' . $url);
    } else {
      /* hmm, if it fails, I guess I'm not going to do anything about it? it will just refresh with the previous theme and it will look like it doesn't work instead of just being a one-off Internet hiccup or server issue. */
      header('location:' . $url);
    }

  } else { /* visitors or members who are NOT logged in */
    $theme = $_POST['theme'];
    $url = $_POST['themeurl'];

    $date = new DateTime('now', new DateTimeZone('America/Denver'));
    $now = $date->format("H:i D, m.d.y");
    if ($theme === '0') { $color = 'Dark'; } else { $color = 'Bright'; }

    if (isset($analytics_on_off)) { /* logged in or not, I need to see if someone is using this! */
      if (!in_array($_SESSION['ti'], $_SESSION['am'])) {
        /* exclude my IP (for testing when not logged in) */
        monitor_theme_usage($now, $user_id, $color, $_SESSION['ti']);
        /* no error checking. if it fails, it fails. not terribly important thing going on here */
      }
    }
    
    /* set alert to '1' so I get a visual notification on the frontend (menu tab changes to green) */
    $turn_on_alert = update_alert_notification();

    setCookie('sessionTheme', $theme, time() + (3650 * 24 * 60 * 60), '/'); // 10 years
    $_SESSION['session-theme'] = $theme;
    header('location:' . $url);
  }
  
} /* 'change-theme' */












/* BEGIN: change user role */
if (isset($_POST['change_user_rl'])) {

  $user_id = $_POST['user'];
  $role = $_POST['role'];
  $reason = $_POST['reason'];
  $mode = $_POST['mode'];

  /* $mode is whether user is logged in as admin or not. 1=logged in Admin Mode, 0=not logged in Admin Mode. if they are downgraded out of Admin status then their mode needs to be changed to 0 in order to kick them out of Admin Mode if they are currently logged in and prevent them from doing anything as an Admin could or would. */
  if ($role == 0 || $role == 1) {
    $mode = '0';
  }

  if (!is_executive()) {
    $signal = 'bad';
    $msg = 'It appears you lack the necessary clearance to do this.';
  } 

  if ($_SESSION['role'] != 99 && ($role == 99 || $role == 80)) {
    $signal = 'bad';
    $msg = 'Are you trying to find a chink in my armor? That is no bueno and your name has been reported to the authorities. Gather your belongings and hide.'; 
  } else {

    if ($role == '80') {
      $change_user_role = change_user_role($user_id, $role, $mode);

      if ($change_user_role === true) {
        $signal = '80';
        $msg =  'Transfer successful!';
      } else {
        $signal = 'bad';
        $msg = 'I don\'t think that worked.';
      }
    }

    if ($role == '60') {
      $change_user_role = change_user_role($user_id, $role, $mode);

      if ($change_user_role === true) {
        $signal = '60';
        $msg =  'Transfer successful!';
      } else {
        $signal = 'bad';
        $msg = 'I don\'t think that worked.';
      }
    }

    if ($role == '40') {
      $change_user_role = change_user_role($user_id, $role, $mode);

      if ($change_user_role === true) {
        $signal = '40';
        $msg =  'Transfer successful!';
      } else {
        $signal = 'bad';
        $msg = 'I don\'t think that worked.';
      }
    }

    if ($role == '20') {
      $change_user_role = change_user_role($user_id, $role, $mode);

      if ($change_user_role === true) {
        $signal = '20';
        $msg =  'Transfer successful!';
      } else {
        $signal = 'bad';
        $msg = 'I don\'t think that worked.';
      }
    }

    if ($role == '0') {
      $change_user_role = change_user_role($user_id, $role, $mode);

      if ($change_user_role === true) {
        $signal = '0';
        $msg =  'Transfer successful!';
      } else {
        $signal = 'bad';
        $msg = 'I don\'t think that worked.';
      }
    }

    if ($role == '1') {
      $change_user_role = change_user_role($user_id, $role, $mode);

      if ($change_user_role === true) {
        $signal = '1';
        $msg =  'Transfer successful!';
      } else {
        $signal = 'bad';
        $msg = 'I don\'t think that worked.';
      }
    } 

  }
  $data = array(
    'signal' => $signal,
    'msg' => $msg
  );
  echo json_encode($data);

} /* 'sub-susp-form' */

/* BEGIN: suspend user */
if (isset($_POST['sssuser'])) { /* super sneaky suspend user */

  $user_id = $_POST['user'];
  $role = $_POST['role'];
  $reason = trim(h($_POST['reason']) ?? '');
 
  if ($_SESSION['role'] != 99 && $_SESSION['role'] != 80) {
    $signal = 'bad';
    $msg = 'It appears you lack the necessary clearance to do this.';
  } else {

   if (trim($reason)) {
      if ($role == '1') { // start

        if (strlen($reason) < 250) {

          $suspend_this_user = suspend_user_partial($role, $reason, $user_id);

          if ($suspend_this_user === true) {
            $signal = '1';
            $msg =  'success';
          } else {
            $signal = 'bad';
            $msg = 'I don\'t think that worked.';
          }

        } else {
          $signal = 'bad';
          $msg = 'Let\'s keep this to 250 characters or less. Right now you\'ve got ' . strlen($reason) . ' characters.';
        }

      } // end

      if ($role == '0') {

        if (strlen($reason) < 250) {
          $suspend_this_user = suspend_user_total($role, $reason, $user_id);

          if ($suspend_this_user === true) {
            $signal = '0';
            $msg =  'Transfer successful!';
          } else {
            $signal = 'bad';
            $msg = 'I don\'t think that worked.';
          }

        } else {
          $signal = 'bad';
          $msg = 'Let\'s keep this to 250 characters or less. Right now you\'ve got ' . strlen($reason) . ' characters.';
        }

      }
    } else {
      $signal = 'bad';
      $msg = 'Please give them some kind of reason for getting suspended.';
    }

  }
  $data = array(
    'signal' => $signal,
    'msg' => $msg
  );
  echo json_encode($data);

} /* 'sssuser' */

/* BEGIN: reset analytics */
if (isset($_POST['new_DB_start_date'])) {

  global $db;
  $row = [];

  $row['now'] = $_POST['new_DB_start_date'];
  $row['user-id'] = ''; 
  $row['username'] = ''; 
  $row['email'] = ''; 
  $row['device'] = ''; 
  $row['page'] = 'xxx'; 
  $row['day'] = ''; 
  $row['host-id'] = ''; 
  $row['mtg-id'] = '';
  $row['mtg-name'] = ''; 
  $row['mtg-days'] = ''; 
  $row['mtg-day'] = '';
  $row['onetap'] = '';
  $row['zoom'] = '';
  $row['dir'] = ''; 
  $row['their-ip'] = '';

  $reset = reset_analytics();

  if ($reset) {

    $log_action = log_activity_for_analytics($row);

    if ($log_action) {
      $signal = 'ok';
      $msg = 'Done!';
    } else {
      $signal = 'nope';
      $msg = 'Adding the new reset date was unsuccessful. Seems the table got dumped so at least there\'s that. Maybe close this dialog and try running the whole thing again?';
    }

  } else {
    $signal = 'nope';
    $msg = 'The deletion of records was unsuccessful. Try closing this dialog and running the whole thing again.';
        
  }

  $data = array(
    'signal' => $signal,
    'msg' => $msg
  );
  echo json_encode($data);

} /* 'new_DB_start_date' */

/* BEGIN: master analytics stuff */
if (isset($_POST['master_analytics_key'])) {

  if (!isset($analytics_on_off)) { return; } else {

    if (!isset($_SESSION['bbiw'])) { /* add extra letter to end of 'bbiw' to reset all the session vars. make sure to make consistent 6 lines below. this way you can force an update to all analytics without causing an undeclared var error even if someone is in a session when you make an update. */
      $me = array('1', '2'); /* id's of those who will not get tracked regardless of IP */
      $ip = get_ip_list();
      $also_me = explode(',', $ip['ip_ignore']);
      $their_ip = $_SERVER['REMOTE_ADDR'];

      $_SESSION['bbiw'] = 'set'; /* so this block + sql query only has to run once per visit (big bro is watching :)) */
      $_SESSION['bi'] = $me; /* bob's id's */
      $_SESSION['ca'] = $ip['ip_ignore']; /* compare against */
      $_SESSION['am'] = $also_me;
      $_SESSION['ti'] = $their_ip;
      if (isset($_SESSION['id']) && ($_SESSION['id'] == '1' || $_SESSION['id'] == '2')) {
        $_SESSION['alertb'] = $ip['alert']; /*  */
      }
    }
    if (!isset($_SESSION['id'])) { $a_user_id = 'ns'; } else { $a_user_id = $_SESSION['id']; }

    /* primary processing begin */
    if ((is_post_request() && isset($_POST['primary_key'])) && (!in_array($a_user_id, $_SESSION['bi']) && !in_array($_SESSION['ti'], $_SESSION['am']))) {

      /* don't track index */
      if (isset($_POST['page']) && $_POST['page'] === 'index') { return; } 
      
      global $db;
      $row = [];

      $date = new DateTime('now', new DateTimeZone('America/Denver'));
      $row['now'] = $date->format("H:i:s D, m.d.y");
      $row['their-ip'] = $_SESSION['ti'];

      if (isset($_SESSION['id'])) {         $row['user-id'] = $_SESSION['id'];         } else { $row['user-id'] = ''; }
      if (isset($_SESSION['username'])) {   $row['username'] = $_SESSION['username'];  } else { $row['username'] = 'visitor'; }
      if (isset($_SESSION['email'])) {      $row['email'] = $_SESSION['email'];        } else { $row['email'] = ''; }
      if (isset($_POST['device'])) {        $row['device'] = $_POST['device'];         } else { $row['device'] = 'undetected'; }
      if (isset($_POST['page'])) {          $row['page'] = $_POST['page'];             } else { $row['page'] = ''; }
      if (isset($_POST['day'])) {           $row['day'] = $_POST['day'];               } else { $row['day'] = ''; }

      if (isset($_POST['host_id'])) {       $row['host-id'] = $_POST['host_id'];       } else { $row['host-id'] = ''; }
      if (isset($_POST['mtg_id'])) {        $row['mtg-id'] = $_POST['mtg_id'];         } else { $row['mtg-id'] = ''; }
      if (isset($_POST['mtgName'])) {       $row['mtg-name'] = $_POST['mtgName'];      } else { $row['mtg-name'] = ''; }
      if (isset($_POST['mtg_days'])) {      $row['mtg-days'] = $_POST['mtg_days'];     } else { $row['mtg-days'] = ''; }
      if (isset($_POST['mtgDay'])) {        $row['mtg-day'] = $_POST['mtgDay'];        } else { $row['mtg-day'] = ''; }

      if (isset($_POST['onetap'])) {        $row['onetap'] = $_POST['onetap'];         } else { $row['onetap'] = ''; }
      if (isset($_POST['zoom'])) {          $row['zoom'] = $_POST['zoom'];             } else { $row['zoom'] = ''; }
      if (isset($_POST['dir'])) {           $row['dir'] = $_POST['dir'];               } else { $row['dir'] = ''; }

      $log_action = log_activity_for_analytics($row);
      // $turn_on_alert = update_alert_notification();
     
    }
    /* primary processing end */

    /* delete list if ip's from internal_analytics.php page - begin */
    if (is_post_request() && isset($_POST['delete_ip_list_key'])) {

      $bot_ips = $_POST['ip_delete_list']; 

      $results = remove_likely_bots($bot_ips);

      if ($results === true) {
        $delete_signal = 'ok';
        $delete_msg =  'Delete successful!'; 
      } else {
        $delete_signal = 'bad';
        $delete_msg = 'Hmm, that didn\'t seem to take. There\'s no telling what happened. That query is complex so maybe it did work but threw a 0 when it should have thrown a 1 back and it really did work - ? Refresh the page and find out.';
      }
      $data = array(
        'delete_signal' => $delete_signal,
        'delete_msg' => $delete_msg
      );
      echo json_encode($data);

    } /* delete list if ip's from internal_analytics.php page - end */

  } /* close of $analytics_on_off() */

} /* 'master_analytics_key' */

/* BEGIN: new meeting review submit */
if (isset($_POST['new_review_submit_pg'])) {
  $id = $_POST['new_review_submit_pg'];

  $row = [];
  $row['visible'] = $_POST['visible'] ?? '';

  $result = finalize_new_meeting($id, $row);

  if ($result === true) {
      header('location: manage.php');
  } else {
    $errors = $result;
  }

} /* 'new_review_submit_pg' */



/* BEGIN: transfer meeting */
if (isset($_POST['transfer_meeting_key'])) {

  $mtg_id = $_POST['current-mtg'];
  $host_email = $_POST['host-email'];
  $email = strtolower(trim($_POST['email'] ?? ''));

  if ($email) {

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $nhe = find_new_host($email); // take entered email address
    $exists = mysqli_num_rows($nhe); // run a query on it
    $newhost_id = mysqli_fetch_assoc($nhe); // put results in var $newhost_id
    if (isset($newhost_id['id_user'])) {
      $new_host = $newhost_id['id_user']; // now you've got the id of new user from entered email
    }
    
      if ($exists > 0) {

        if ($host_email != $email) {

          $change_host = update_host($mtg_id, $new_host);

          if ($change_host === true) {
            $signal = 'ok';
            $msg =  'Transfer successful!';
          } else {
            $signal = 'bad';
            $msg = 'uh oh... The Internet might have hiccupped while this was in process and it may or may not have transferred successfully. This is a very unique occrurance. Please confirm with the other user that they have the meeting. If it did not transfer successfully email me at the bottom of any page and I will fix it. Again, this is a really hard messge to see. Congratulations. :)';
          }
        } else {
          $signal = 'bad';
          $msg = 'You\'re trying to transfer this to the current owner.';
        }

      } else {
        $signal = 'bad';
        $msg = 'That email address is not registered here. The new host has to be a member of EvergreenAA.com before you can transfer a meeting to them.';
      }

    } else {
      $signal = 'bad';
      $msg = 'Invalid email address. Please fix.';
    }

  } else {
    $signal = 'bad';
    $msg = 'Please enter email address of the member to whom you are transferring this meeting.';
  }
  $data = array(
    'signal' => $signal,
    'msg' => $msg
  );
  echo json_encode($data);

} /* 'transfer_meeting_key' */

/* BEGIN: delete meeting */
if (isset($_POST['delete_meeting_routine'])) {

  $id = $_POST['delete_meeting_routine'];

  $sql = "DELETE FROM meetings ";
  $sql .= "WHERE id_mtg='" . $id . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);

  if($result) {
    header('location: manage.php');
  } else {
    // delete failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }

} /* 'delete_meeting_routine' */

/* BEGIN: suspension explanation notes */
if (isset($_POST['suspension_explanation'])) {

  $reason     = trim(h($_POST['reason']) ?? '');
  $user       = $_POST['user-id'];

  if ($reason) {


    $update_sus_notes = update_sus_note($reason, $user);

    if ($update_sus_notes === true) {
      $signal = 'ok';
      $msg =  'Transfer successful!'; 
    } else {
      $signal = 'bad';
      $msg = 'Hmm, that didn\'t seem to take. You can try refreshing the page and doing it again or maybe your Internet is down? You\'d still see this message even if your Internet connection had dropped since you started this.';
    }
  } else {
    $signal = 'bad';
    $msg = 'Please give them some kind of reason for getting suspended.';
  }
  $data = array(
    'signal' => $signal,
    'msg' => $msg
  );
  echo json_encode($data);

} /* 'suspension_explanation' */

/* BEGIN: email opt in or out */
if (isset($_POST['email_opt_in_or_out'])) {

  $id = $_SESSION['id'];
  $email_opt      = $_POST['email-updates'];

  $result = email_opt($id, $email_opt);

  if ($result === true) {
    $signal = 'ok';
    $msg =  'Update successful!';
  } else {
    $signal = 'bad';
    $msg = 'That didn\'t work. Are you clicking over and over real fast? I may have skipped a beat somewhere. Reload this page and try again.';
  }
  $data = array(
    'signal' => $signal,
    'msg' => $msg
  );
  echo json_encode($data);  

} /* 'email_opt_in_or_out' */

/* BEGIN: new message board post */
if (isset($_POST['new_message_board_post'])) {

  if (isset($_POST['mb-title'])) { 
    $row = [];
    $row['id_user'] = $_SESSION['id'];
    $row['mb_header']   = h($_POST['mb-title']);
    $row['mb_body']    = h($_POST['mb-post']);

    $result = add_new_post($row);

    if ($result === true) {
      $signal = 'ok';
      $msg =  'Transfer successful!';
    } else {
      $signal = 'bad';
      $msg = 'That didn\'t work. I\'ve got no more information for you either. Maybe restart your browser and try it again?';
    }
  } // end new post
  $data = array(
    'signal' => $signal,
    'msg' => $msg
  );
  echo json_encode($data);

} /* 'new_message_board_post' */

/* BEGIN: new message board reply */
if (isset($_POST['new_message_board_reply'])) {

  if (isset($_POST['mb-reply'])) { // this is a reply
    $row = [];
    $row['id_user'] = $_SESSION['id'];
    $row['mb_topic']   = h($_POST['post-id']);
    $row['mb_reply']   = h($_POST['mb-reply']);

    $result = add_mb_reply($row);

    if ($result === true) {
      $signal = 'ok';
      $msg =  'Transfer successful!';
    } else {
      $signal = 'bad';
      $msg = 'That didn\'t work. I\'ve got no more information for you either. Maybe restart your browser and try it again?';
    }

  } // end reply
  $data = array(
    'signal' => $signal,
    'msg' => $msg
  );
  echo json_encode($data);

} /* 'new_message_board_reply' */

/* BEGIN: delete message board post */
if (isset($_POST['delete_message_board_post'])) {

   if (isset($_POST['post-id'])) {
    $row = [];
    /* never did finish anything message board related when doing _the_roll which is why there's still references to 'admin' */
    if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3) {
      // let admin delete this
      $row['id_user'] = $_POST['uid'];
    } else {
      $row['id_user'] = $_SESSION['id'];
    }

    $row['id_topic']   = $_POST['post-id'];

    $result = delete_post($row);

    if ($result === true) {
      $signal = 'ok';
      $msg =  'Transfer successful!';
    } else {
      $signal = 'bad';
      $msg = 'That didn\'t work. I\'ve got no more information for you either. Maybe restart your browser and try it again?';
    }

  } else {
      $signal = 'bad';
      $msg = 'not getting post array...?!';
  }
  $data = array(
    'signal' => $signal,
    'msg' => $msg
  );
  echo json_encode($data);

}

/* BEGIN: delete message board reply */
if (isset($_POST['delete_message_board_reply'])) {

   if (isset($_POST['id-reply'])) {
    $row = [];
    /* never did finish anything message board related when doing _the_roll which is why there's still references to 'admin' */
    if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3) {
      // let admin delete this
      $row['id_user'] = $_POST['uid'];
    } else {
      $row['id_user'] = $_SESSION['id'];
    }

    $row['id_reply'] = $_POST['id-reply'];

    $result = delete_reply($row);

    if ($result === true) {
      $signal = 'ok';
      $msg =  'Transfer successful!';
    } else {
      $signal = 'bad';
      $msg = 'That didn\'t work. I\'ve got no more information for you either. Maybe restart your browser and try it again?';
    }

  } else {
      $signal = 'bad';
      $msg = 'not getting post array...?!';
  }
  $data = array(
    'signal' => $signal,
    'msg' => $msg
  );
  echo json_encode($data);  

} /* 'delete_message_board_reply' */






} /* closing if (is_post_request()) at very top */
  
