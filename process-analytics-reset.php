<?php

require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

global $db;

if (is_post_request() && isset($_POST['new_DB_start_date'])) {
  $signal = 'ok';
  $msg = 'success';
} else {
  $signal = 'nope';
  $msg = 'something didn\'t work.';
}

$data = array(
  'signal' => $signal,
  'msg' => $msg
);
echo json_encode($data);
