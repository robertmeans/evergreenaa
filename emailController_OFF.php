<?php

require_once 'vendor/autoload.php';
require_once 'config/constants.php';

// Create the Transport
// https://swiftmailer.symfony.com/docs/introduction.html
// $transport = (new Swift_SmtpTransport('smtpout.secureserver.net', 80))
// ^^ was working on pop/workspace account
// $transport = (new Swift_SmtpTransport('localhost', 25))
$transport = (new Swift_SmtpTransport('smtp.office365.com', 587))
// ^^ still not workig on exchange account
// $transport = (new Swift_SmtpTransport('relay-hosting.secureserver.net', 25))
// ^^ just trying anything at this point


  ->setUsername(EMAIL)
  ->setPassword(PASSWORD);

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

function sendVerificationEmail($username, $userEmail, $token) 
{
	global $mailer;

	$body = '<!DOCTYPE html>
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
			color: #313131
		}
	</style>		
</head>
<body>
	<div class="wrapper">
		<p>Hello ' . $username . ',
		<p>Thank you for signing up for this neat new project. As I type this it is April 2, 2020 and we are all buckled down for the Coronavirus. This project is in hopes of providing AA members a safer, more convenient way to manage their Zoom meetings (for now) with future features to follow, friend. :)</p>
		<a style="padding:5px 8px;border-radius:3px;background-color:#2c496a;color:#fff;margin:0.5em 0em 0.5em;text-decoration:none;" href="https://www.evergreenaa.com/testing/index.php?token=' . $token . '">Verify your email address</a>
		<p>Sincerely,<br>Evergreen Bob</p>
	</div>
	
</body>
</html>';

	// Create a message
	$message = (new Swift_Message('Verify Your EvergreenAA Registration'))
	  ->setFrom([EMAIL=> 'Evergreen AA Website'])
	  ->setTo($userEmail)
	  ->setBody($body, 'text/html');


	// Send the message
	$result = $mailer->send($message);
}

function sendPasswordResetLink($userEmail, $token) 
{

global $mailer;

	$body = '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reset EvergreenAA.com Password</title>		
</head>
<body>
	<div class="wrapper">
		<p>Hello,</p>
		<p>Please click on the link below to reset your password.</p>
		<a style="padding:5px 8px;border-radius:3px;background-color:#2c496a;color:#fff;margin:0.5em 0em 0.5em;text-decoration:none;" href="https://www.evergreenaa.com/testing/index.php?password-token=' . $token . '">Reset your password</a>
		<p>Sincerely,<br>Evergreen Bob</p>
	</div>
	
</body>
</html>';

	// Create a message
	$message = (new Swift_Message('Reset Your EvergreenAA Password'))
	  ->setFrom([EMAIL=> 'Evergreen AA Website'])
	  ->setTo($userEmail)
	  ->setBody($body, 'text/html');


	// Send the message
	$result = $mailer->send($message);

}


?>