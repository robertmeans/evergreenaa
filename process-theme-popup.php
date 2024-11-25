<?php
require_once 'config/initialize.php';

/*  files involved with this popup:
    1. config/initialize.php
    2. _includes/msg-theme-message.php
    3. javascript-to-compile/_scripts-staging.js
    4. included in: home, home_private and home_admin
*/

if (!isset($theme_popup_on_off)) { return; } else {
  
  $i = 0;

  // if (empty($_COOKIE['theme-popup'])) { /* dev */
  if (!empty($_COOKIE['theme-popup'])) { /* production */
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
