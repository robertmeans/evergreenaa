<?php
require_once 'config/initialize.php';

if (isset($_SESSION['id'])) {
  $user_id = $_SESSION['id'];
} else {
  $user_id = 'ns';
}

/* BEGIN: Theme related */
if (is_post_request() && isset($_POST['theme'])) {

  $me = array('1', '2');

  $ip = get_ip_list();
  $also_me = explode(',', $ip['ip_ignore']);

  $their_ip = $_SERVER['REMOTE_ADDR'];
  

  if ($user_id != 'ns') {
    $theme = $_POST['theme'];
    $url = $_POST['themeurl'];
    

    if (!in_array($user_id, $me) && !in_array($_SERVER['REMOTE_ADDR'], $also_me)) { /* exclude me from count */
      $date = new DateTime('now', new DateTimeZone('America/Denver'));
      $now = $date->format("H:i D, m.d.y");

      if ($theme === '0') { $color = 'Dark'; } else { $color = 'Bright'; }
      monitor_theme_usage($now, $user_id, $color, $their_ip);
    }

    $result = set_theme($theme, $user_id);

    if ($result === true) {
      $_SESSION['db-theme'] = $theme;
      header('location:' . $url);
    } else {
      $errors = $result;
    }


  } else {
    $theme = $_POST['theme'];
    $url = $_POST['themeurl'];


    $date = new DateTime('now', new DateTimeZone('America/Denver'));
    $now = $date->format("H:i D, m.d.y");
    if ($theme === '0') { $color = 'Dark'; } else { $color = 'Bright'; }

    if (!in_array($_SERVER['REMOTE_ADDR'], $also_me)) {
      monitor_theme_usage($now, $user_id, $color, $their_ip);
      /* no error checking. if it fails, it fails. not terribly important thing going on here */
    }

    setCookie('sessionTheme', $theme, time() + (3650 * 24 * 60 * 60), '/'); // 10 years
    $_SESSION['session-theme'] = $theme;
    header('location:' . $url);
  }
  
}


// $theme = configure_theme();