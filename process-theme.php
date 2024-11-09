<?php
require_once 'config/initialize.php';

if (isset($_SESSION['id'])) {
  $user_id = $_SESSION['id'];
} else {
  $user_id = 'ns';
}

/* BEGIN: Theme related */
if (is_post_request() && isset($_POST['theme'])) {

  
  /* special instructions if on new or edit page to preserve content of fields if they've changed while on this page. Yeah, I know, this was just for fun. like how likely is this to ever happen? :) */
  /* user is logged in, otherwise they couldn't get to either of these pages therefore we don't need the whole, "if ($user_id != 'ns')" that starts the else statement below          */
  $ctpg = $_POST['ctpg'];
  if ($ctpg === 'manage_new.php' || $ctpg === 'manage_edit.php') {


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

} /* close if (is_post_request()...) */


// $theme = configure_theme();