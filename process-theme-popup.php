<?php
require_once 'config/initialize.php';

if (!isset($theme_popup_on_off)) { return; } else {

  if (!empty($_COOKIE['theme-popup'])) { 
    // return;
    $popup_signal = 'nope';
  } else {
    setCookie('theme-popup', 'shown', time() + (3650 * 24 * 60 * 60), '/'); // 10 years
    // $_SESSION['theme-popup'] = 'shown';

    $popup_signal = 'ok'; 
  }
  $data = array(
    'popup_signal' => $popup_signal
  );
  echo json_encode($data);


}
