<?php

require_once 'config/initialize.php';
require_once 'controllers/emailController.php';


if (is_post_request() && isset($_POST['footercontact'])) {
  $signal = '';
  $msg = '';
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $message = trim($_POST['comments'] ?? '');
  // $message = trim(htmlspecialchars($_POST['comments'], ENT_QUOTES, 'UTF-8')); /* doesn't fix things by itself */

  // if (WWW_ROOT == 'http://localhost/evergreenaa') { sleep(2); }

  // validation
  if (empty($name) || empty($email) || empty($message)) {
    $signal = 'bad';
    $msg .= '<li>Please fill in all the fields.</li>';
  }

  if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $signal = 'bad';
    $msg .= '<li>Email is invalid.</li>';
  }

  if (empty($msg) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // if (WWW_ROOT == 'http://localhost/evergreenaa') { sleep(100); }
    if (WWW_ROOT != 'http://localhost/evergreenaa') {
      footer_contact($name, $email, $message);
      $signal = 'ok';
      $msg = '<li>Message sent successfully.</li>';
    } else {
      $signal = 'bad';
      $msg .= '<li>Transmission failed. Please use email and report this error so I can fix it along with your message to: myevergreenaa@gmail.com</li>';
    }
    
  } 

}
$data = array(
	'signal' => $signal,
	'msg' => $msg
);
echo json_encode($data);
