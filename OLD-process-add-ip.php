<?php
require_once 'config/initialize.php';

if (isset($_SESSION['id'])) {
  $user_id = $_SESSION['id'];
} else {
  $user_id = 'ns';
}

/* BEGIN: Theme related */
if (is_post_request() && isset($_POST['my-new-ip'])) {

  $passed_list = $_POST['current-list'];
  $current_list = $passed_list;
  $my_current_ip = $_POST['my-new-ip'];
  $new_ip_list = $current_list . ',' . $my_current_ip;

  $url = $_POST['this-here-url'];

  $result = add_ip($new_ip_list);

  if ($result === true) {
    header('location:' . $url);
  } else {
    $errors = $result;
  }

} 
  
