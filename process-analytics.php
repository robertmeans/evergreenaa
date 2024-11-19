<?php
require_once 'config/initialize.php'; /* toggle all analytics on/off in initialize.php */

if (!isset($analytics_on_off)) { return; } else {

  if (!isset($_SESSION['bbiw'])) { /* add extra letter to end of 'bbiw' to reset all the session vars. make sure to make consistent 6 lines below. this way you can force an update to all analytics without causing an undeclared var error even if someone is in a session when you make an update. */
    $me = array('1', '2'); /* id's of those you want to have access to analytics */
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


  if (is_post_request() && (!in_array($a_user_id, $_SESSION['bi']) && !in_array($_SESSION['ti'], $_SESSION['am']))) {
    
    global $db;

    $date = new DateTime('now', new DateTimeZone('America/Denver'));
    $now = $date->format("H:i:s D, m.d.y");
    $their_ip = $_SESSION['ti'];

    if (isset($_SESSION['id'])) {         $user_id = $_SESSION['id'];         } else { $user_id = ''; }
    if (isset($_SESSION['username'])) {   $username = $_SESSION['username'];  } else { $username = 'visitor'; }
    if (isset($_SESSION['email'])) {      $email = $_SESSION['email'];        } else { $email = ''; }
    if (isset($_POST['device'])) {        $device = $_POST['device'];         } else { $device = 'undetected'; }
    if (isset($_POST['page'])) {          $page = $_POST['page'];             } else { $page = ''; }
    if (isset($_POST['day'])) {           $day = $_POST['day'];               } else { $day = ''; }
    if (isset($_POST['mtgName'])) {       $mtg_name = $_POST['mtgName'];      } else { $mtg_name = ''; }


    $log_action = log_activity_for_analytics($now, $email, $device, $page, $day, $mtg_name, $their_ip);
    $turn_on_alert = update_alert_notification();
   
  }

}

