<?php
require_once 'config/initialize.php';

if (isset($_SESSION['id'])) {
  $user_id = $_SESSION['id'];
} else {
  $user_id = 'ns';
}

/* BEGIN: Theme related */
if (is_post_request() && isset($_POST['theme'])) {

  if ($user_id != 'ns') {
    $theme = $_POST['theme'];
    $url = $_POST['themeurl'];

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
    
    setCookie('sessionTheme', $theme, time() + (3650 * 24 * 60 * 60), '/'); // 10 years
    $_SESSION['session-theme'] = $theme;
    // header('location:' . WWW_ROOT);
    header('location:' . $url);
  }
}



/* what the actual ... ?! */ 
// if (isset($_SESSION['db-theme'])) {
//   // they're logged in an their tz has already been set
//   $theme = $_SESSION['db-theme'];
//   return;
// } elseif (!empty($_COOKIE['sessionTheme'])) {
//   $theme = $_COOKIE['sessionTheme'];
//   return;
// } else {
//   $theme = '0';
//   return;
// }
$theme = configure_theme();