<?php
require_once 'config/initialize.php'; /* toggle all analytics on/off in initialize.php */

if (!isset($analytics_on_off)) { return; } else {

  if (!isset($_SESSION['bbiw'])) { /* add extra letter to end of 'bbiw' to reset all the session vars. make sure to make consistent 6 lines below. this way you can force an update to all analytics without causing an undeclared var error even if someone is in a session when you make an update. */
    $me = array('1', '2'); /* id's of those who will not get tracked regardless of IP */
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

  /* primary processing begin */
  if ((is_post_request() && isset($_POST['primary_key'])) && (!in_array($a_user_id, $_SESSION['bi']) && !in_array($_SESSION['ti'], $_SESSION['am']))) {

    /* don't track index */
    if (isset($_POST['page']) && $_POST['page'] === 'index') { return; } 
    
    global $db;
    $row = [];

    $date = new DateTime('now', new DateTimeZone('America/Denver'));
    $row['now'] = $date->format("H:i:s D, m.d.y");
    $row['their-ip'] = $_SESSION['ti'];

    if (isset($_SESSION['id'])) {         $row['user-id'] = $_SESSION['id'];         } else { $row['user-id'] = ''; }
    if (isset($_SESSION['username'])) {   $row['username'] = $_SESSION['username'];  } else { $row['username'] = 'visitor'; }
    if (isset($_SESSION['email'])) {      $row['email'] = $_SESSION['email'];        } else { $row['email'] = ''; }
    if (isset($_POST['device'])) {        $row['device'] = $_POST['device'];         } else { $row['device'] = 'undetected'; }
    if (isset($_POST['page'])) {          $row['page'] = $_POST['page'];             } else { $row['page'] = ''; }
    if (isset($_POST['day'])) {           $row['day'] = $_POST['day'];               } else { $row['day'] = ''; }


    if (isset($_POST['host_id'])) {       $row['host-id'] = $_POST['host_id'];       } else { $row['host-id'] = ''; }
    if (isset($_POST['mtg_id'])) {        $row['mtg-id'] = $_POST['mtg_id'];         } else { $row['mtg-id'] = ''; }
    if (isset($_POST['mtgName'])) {       $row['mtg-name'] = $_POST['mtgName'];      } else { $row['mtg-name'] = ''; }
    if (isset($_POST['mtg_days'])) {      $row['mtg-days'] = $_POST['mtg_days'];     } else { $row['mtg-days'] = ''; }
    if (isset($_POST['mtgDay'])) {        $row['mtg-day'] = $_POST['mtgDay'];        } else { $row['mtg-day'] = ''; }


    if (isset($_POST['onetap'])) {        $row['onetap'] = $_POST['onetap'];         } else { $row['onetap'] = ''; }
    if (isset($_POST['zoom'])) {          $row['zoom'] = $_POST['zoom'];             } else { $row['zoom'] = ''; }
    if (isset($_POST['dir'])) {           $row['dir'] = $_POST['dir'];               } else { $row['dir'] = ''; }





    $log_action = log_activity_for_analytics($row);
    $turn_on_alert = update_alert_notification();
   
  }
  /* primary processing end */

  /* delete list if ip's from internal_analytics.php page - begin */
  if (is_post_request() && isset($_POST['delete_ip_list_key'])) {

    $bot_ips = $_POST['ip_delete_list']; 

    $results = remove_likely_bots($bot_ips);

    if ($results === true) {
      $delete_signal = 'ok';
      $delete_msg =  'Delete successful!'; 
    } else {
      $delete_signal = 'bad';
      $delete_msg = 'Hmm, that didn\'t seem to take. There\'s no telling what happened. That query is complex so maybe it did work but threw a 0 when it should have thrown a 1 back and it really did work - ? Refresh the page and find out.';
    }
    $data = array(
      'delete_signal' => $delete_signal,
      'delete_msg' => $delete_msg
    );
    echo json_encode($data);

  }
  /* delete list if ip's from internal_analytics.php page - end */

} /* close of $analytics_on_off() */


