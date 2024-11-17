<?php

$analytics_on_off = 'set';
/* ^  master switch for analytics. 
      comment var and everything analytics-related turns off. everything hinges on 'if (isset($analytics_on_off))' down the line. */

/* create conditions for different actions to log data to db... */

if (isset($_SESSION['mode']) && $_SESSION['mode'] == 1) { return; } else { 

  if (!isset($_SESSION['verified'])) { 
    /* log VISITOR stuff */
    // require 'home.php';
    // exit;
  }

  if (((isset($_SESSION['verified']) && ($_SESSION['verified'] != "0")) && (!isset($_SESSION['message'])))) {
    /* log MEMBER stuff */
    // require 'home_private.php';
    // exit;
  }

}

