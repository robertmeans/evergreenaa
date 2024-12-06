<?php

require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

if (is_post_request() && isset($_POST['new_DB_start_date'])) {

  global $db;
  $row = [];

  $row['now'] = $_POST['new_DB_start_date'];
  $row['user-id'] = ''; 
  $row['username'] = ''; 
  $row['email'] = ''; 
  $row['device'] = ''; 
  $row['page'] = 'xxx'; 
  $row['day'] = ''; 
  $row['host-id'] = ''; 
  $row['mtg-id'] = '';
  $row['mtg-name'] = ''; 
  $row['mtg-days'] = ''; 
  $row['mtg-day'] = '';
  $row['onetap'] = '0';
  $row['zoom'] = '0';
  $row['dir'] = '0'; 
  $row['their-ip'] = '';

  $reset = reset_analytics();

  if ($reset) {

    $log_action = log_activity_for_analytics($row);

    if ($log_action) {
      $signal = 'ok';
      $msg = 'Done!';
    } else {
      $signal = 'nope';
      $msg = 'Adding the new reset date was unsuccessful. Seems the table got dumped so at least there\'s that. Maybe close this dialog and try running the whole thing again?';
    }

  } else {
    $signal = 'nope';
    $msg = 'The deletion of records was unsuccessful. Try closing this dialog and running the whole thing again.';
        
  }









} else {
  $signal = 'nope';
  $msg = 'I\'m not doing that. How did you even get this far? Seriously, there\'s no situation where this message should ever be seen in fact, I don\'t even know why I\'m writing it.';
}

$data = array(
  'signal' => $signal,
  'msg' => $msg
);
echo json_encode($data);
