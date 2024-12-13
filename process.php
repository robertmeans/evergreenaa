<?php
require_once 'config/initialize.php';

if (is_post_request()) {

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

      in _scripts-staging.js there's $(document).ready(function().. [search: $("#theme-options").hide();] that runs this page on every page load to determine whether or not to show _includes/msg-theme-message.php

      files involved with this popup:
      1. config/initialize.php
      2. _includes/msg-theme-message.php
      3. javascript-to-compile/_scripts-staging.js
      4. included in: home, home_private and home_admin
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
if (isset($_POST['change-theme'])) { /* this wraps everything, all the way to the btm */

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
      $turn_on_alert = update_alert_notification();
     
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

}














} /* closing if (is_post_request()) at very top */
  
