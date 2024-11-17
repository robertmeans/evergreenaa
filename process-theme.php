<?php
require_once 'config/initialize.php';

if (isset($_SESSION['id'])) {
  $user_id = $_SESSION['id'];
} else {
  $user_id = 'ns';
}

/* BEGIN: Theme related */
if (is_post_request() && isset($_POST['theme'])) {

  /* this page has to fire in order to log a theme change either to a cookie (for visitors) or a cookie + db for members. the random stuff wrapped in 'if (isset($analytics_on_off))' is to isolate all the *extra* stuff I'm watching without disturbing the basic functionality that's necessary to let the theme toggle work. all the extra stuff can be turned on/off from controllers/analytics.php. */ 
  if (isset($analytics_on_off)) {
    $me = array('1', '2');
    $ip = get_ip_list();
    $also_me = explode(',', $ip['ip_ignore']);
    $their_ip = $_SERVER['REMOTE_ADDR'];
  }
  
  if ($user_id != 'ns') {
    $theme = $_POST['theme'];
    $url = $_POST['themeurl'];
    
    if (isset($analytics_on_off)) {
      if (!in_array($user_id, $me) && !in_array($their_ip, $also_me)) { 
        /* exclude me from count - or anyone using same IP as me */
        $date = new DateTime('now', new DateTimeZone('America/Denver'));
        $now = $date->format("H:i D, m.d.y");

        if ($theme === '0') { $color = 'Dark'; } else { $color = 'Bright'; }
        monitor_theme_usage($now, $user_id, $color, $their_ip);
      }
    }

    $result = set_theme($theme, $user_id);

    if ($result === true) {
      $_SESSION['db-theme'] = $theme;
      header('location:' . $url);
    } else {
      // $errors = $result;
      header('location:' . $url);
    }

  } else {
    $theme = $_POST['theme'];
    $url = $_POST['themeurl'];

    $date = new DateTime('now', new DateTimeZone('America/Denver'));
    $now = $date->format("H:i D, m.d.y");
    if ($theme === '0') { $color = 'Dark'; } else { $color = 'Bright'; }

    if (isset($analytics_on_off)) {
      if (!in_array($their_ip, $also_me)) {
        /* exclude my IP (for testing when not logged in) */
        monitor_theme_usage($now, $user_id, $color, $their_ip);
        /* no error checking. if it fails, it fails. not terribly important thing going on here */
      }
    }

    setCookie('sessionTheme', $theme, time() + (3650 * 24 * 60 * 60), '/'); // 10 years
    $_SESSION['session-theme'] = $theme;
    header('location:' . $url);
  }
  
}


// $theme = configure_theme();