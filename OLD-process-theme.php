<?php
require_once 'config/initialize.php';

if (isset($_SESSION['id'])) {
  $user_id = $_SESSION['id'];
} else {
  $user_id = 'ns';
}

/* BEGIN: Theme related */
if (is_post_request() && isset($_POST['theme'])) { /* this wraps everything, all the way to the btm */

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
  
}


// $theme = configure_theme();