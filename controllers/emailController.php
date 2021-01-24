<?php

require_once 'vendor/autoload.php';
require_once 'config/constants.php';

// Create the Transport > composer require "swiftmailer/swiftmailer:^6.0"
// https://swiftmailer.symfony.com/docs/introduction.html
$transport = (new Swift_SmtpTransport('smtpout.secureserver.net', 80))
// ^^ works with exchange account with Email Routing set to Remote Mail Exchanger

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

	// Create a message
	$message = (new Swift_Message('Verify Your EvergreenAA Registration'))
	  ->setFrom([EMAIL=> 'Evergreen AA Website'])
	  ->setBcc('info@evergreenaa.com')
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
			<p>Please click on the link below to reset your password.</p>
			<p><a style="padding:5px 8px;border-radius:3px;background-color:#2c496a;color:#fff;margin:0.5em 0em 0.5em;text-decoration:none;" href="https://www.evergreenaa.com/index.php?password-token=' . $token . '">Click here</a> to reset your password.</p>
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

function email_everyone($subject, $email_addresses, $message) 
	{
	global $mailer;

	// Create a message
	$message = (new Swift_Message($subject))
	  ->setFrom([EMAIL=> 'Evergreen AA Website'])
	  ->setBcc([$email_addresses])
	  // ->setTo('bob@bobmeans.com')
	  ->setBody($message, 'text/html');

	// Send the message
	$result = $mailer->send($message);
}


?>