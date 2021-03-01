<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
require_once 'config/constants.php';

function sendVerificationEmail($username, $userEmail, $token) {
	$mail = new PHPMailer(true);

  try {
      $mail->Host       = 'localhost';
      $mail->SMTPAuth   = false;
      $mail->Username   = EMAIL;
      $mail->Password   = PASSWORD; 

      //Recipients
      $mail->setFrom(EMAIL, 'Evergreen AA Website');
      $mail->addAddress($userEmail, $username);     // Add a recipient
      $mail->addReplyTo($userEmail);
      // $mail->addCC('cc@example.com');
      $mail->addBCC('info@evergreenaa.com');

      // Content
      $mail->isHTML(true);
      $mail->Subject = 'Verify Your EvergreenAA Registration';
      $mail->Body    =    '<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Verify EvergreenAA.com Registration</title>
		<style>
			.wrapper {
			  padding: 20px;
			  color: #444;
			  font-size: 1.3em;
			}
			a {
			  background-color: #2c496a;
			  text-decoration: none;
			  padding: 8px 15px;
			  border-radius: 5px;
			  color: #fff;
			}
			a:hover {
				background-color: #9bafc6;
				color: #313131;
			}
		</style>		
	</head>
	<body>
		<div class="wrapper">
			<p>Hello ' . $username . ',
			<p>Thank you for joining this neat project. As I type this we are all buckled down for the Coronavirus which has introduced a new opportunity for AA members to meet. This website is being developed in hopes of providing everyone a safer, more convenient way to manage their Zoom meetings while keeping private information private.</p>
			<p><a style="padding:5px 8px;border-radius:3px;background-color:#2c496a;color:#fff;margin:0.5em 0em 0.5em;text-decoration:none;" href="https://www.evergreenaa.com/index.php?token=' . $token . '">Click here</a> to verify your email address.</p>
			<p>Sincerely,<br>Evergreen Bob</p>
		</div>
		
	</body>
	</html>';
      $mail->AltBody = 'Hello ' . $username . ', Please copy and paste this verification link into your browser address bar to validate your EvergreenAA.com registration: https://www.evergreenaa.com/index.php?token=' . $token;

      $mail->send();

  } catch (Exception $e) {
      echo "Email verification ran into a server error. This is no bueno and brings shame to my family. If you are so inclined, please copy and paste this message into an email to: info@evergreenaa.com -- Mailer Error: {$mail->ErrorInfo}";
  }
}

function sendPasswordResetLink($userEmail, $token) {

	$mail = new PHPMailer(true);

  try {
      $mail->Host       = 'localhost';
      $mail->SMTPAuth   = false;
      $mail->Username   = EMAIL;
      $mail->Password   = PASSWORD; 

      //Recipients
      $mail->setFrom(EMAIL, 'Evergreen AA Website');
      $mail->addAddress($userEmail);     // Add a recipient
      $mail->addReplyTo($userEmail);
      // $mail->addCC('cc@example.com');
      $mail->addBCC('info@evergreenaa.com');

      // Content
      $mail->isHTML(true);
      $mail->Subject = 'Reset Your EvergreenAA Password';
      $mail->Body    =    '<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Reset EvergreenAA.com Password</title>
		<style>
			.wrapper {
			  padding: 20px;
			  color: #444;
			  font-size: 1.3em;
			}
			a {
			  background-color: #2c496a;
			  text-decoration: none;
			  padding: 8px 15px;
			  border-radius: 5px;
			  color: #fff;
			}
			a:hover {
				background-color: #9bafc6;
				color: #313131;
			}
		</style>			
	</head>
	<body>
		<div class="wrapper">
			<p>Hello,</p>
			<p>A request has been made to change the password on your account at EvergreenAA.com. If you did not request this change you can ignore this message.</p>
			<p>Please click on the link below to reset your password.</p>
			<p><a style="padding:5px 8px;border-radius:3px;background-color:#2c496a;color:#fff;margin:0.5em 0em 0.5em;text-decoration:none;" href="https://www.evergreenaa.com/index.php?password-token=' . $token . '">Click here</a> to reset your password.</p>
			<p>Sincerely,<br>Evergreen Bob</p>
		</div>
		
	</body>
	</html>';
      $mail->AltBody = 'Hello, A request has been made to change the password on your account at EvergreenAA.com. If you did not request this change you can ignore this message. If you did make this request, please copy and paste this link into your browser address bar to reset your password: https://www.evergreenaa.com/index.php?password-token=' . $token;

      $mail->send();

  } catch (Exception $e) {
      echo "Password reset reqest ran into a server error. This is no bueno and brings shame to my family. If you are so inclined, please copy and paste this message into an email to: info@evergreenaa.com -- Mailer Error: {$mail->ErrorInfo}";
  }
}

function email_everyone_BCC($msgsubject, $email_addresses, $message) {
	$mail = new PHPMailer(true);

  try {
      $mail->Host       = 'localhost';
      $mail->SMTPAuth   = false;
      $mail->Username   = EMAIL;
      $mail->Password   = PASSWORD; 

      //Recipients
      $mail->setFrom(EMAIL, 'EvergreenAA Website');
      $mail->addBCC($email_addresses);
      // $mail->addBCC('robertmeans01@gmail.com');

      // Content
      $mail->isHTML(true);
      $mail->Subject = $msgsubject;
      $mail->Body    = $message;

      $mail->send();

  } catch (Exception $e) {
      echo "You hit a snag. Messages did not send. -- Mailer Error: {$mail->ErrorInfo}";
  }
}

function email_everyone_PERSONAL($msgsubject, $send_to, $message) {
	$mail = new PHPMailer(true);

  try {
      $mail->Host       = 'localhost';
      $mail->SMTPAuth   = false;
      $mail->Username   = EMAIL;
      $mail->Password   = PASSWORD; 

      //Recipients
      $mail->setFrom(EMAIL, 'EvergreenAA Website');
      $mail->addAddress($send_to);     // Add a recipient
      $mail->addReplyTo($send_to);
      // $mail->addAddress('robertmeans01@gmail.com');
      // $mail->addReplyTo('robertmeans01@gmail.com');

      // Content
      $mail->isHTML(true);
      $mail->Subject = $msgsubject;
      $mail->Body    = $message;

      $mail->send();

  } catch (Exception $e) {
      echo "You hit a snag. Messages did not send. -- Mailer Error: {$mail->ErrorInfo}";
  }
}


?>