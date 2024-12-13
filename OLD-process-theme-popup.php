<?php
require_once 'config/initialize.php';

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
