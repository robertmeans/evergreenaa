<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
require_once 'config/constants.php';

function sendVerificationEmail($username, $email, $token) {
  $mail = new PHPMailer(true);

  try {

      mail_config();  

      $mail->setFrom('donotreply@evergreenaa.com', 'Evergreen AA Website');
      $mail->addAddress($email, $username);     // Add a recipient
      $mail->addReplyTo($email);
      // $mail->addCC('cc@example.com');
      $mail->addBCC('robert@evergreenwebdesign.com');

      // Content
      $mail->isHTML(true);
      $mail->Subject = 'Verify Your EvergreenAA Registration';
      $mail->Body    =    '<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Verify EvergreenAA.com Registration</title>
    <style>
      body {
        font-size: 16px;
        color: #313131;
        font-family: Verdana, Tahoma, Calbri, Arial, sans-serif;
      }
      .wrapper {
        padding: 1.5em;
        font-size: 1em;
      }
    </style>    
  </head>
  <body>
    <div class="wrapper">
      <p>Hello ' . $username . ',</p>

      <p>Welcome to this neat project!</p>

      <p>EvergreenAA.com provides a convenient outlet to consolidate, organize, publish and edit your meeting information. Whether you maintain this information for your own private use or make it available to everyone is up to you.</p>

      <p><a style="color:#0000ff;text-decoration:underline;" href="https://evergreenaa.com/index.php?token=' . $token . '">Click here</a> to verify your email address (or use copy &amp; paste option below).</p>

      <p>If you encounter issues with the site or have feature requests please email me anytime. There is a contact form at the bottom of every page labeled, "comments | questions | suggestions".</p>

      <p>Sincerely,<br>
      Evergreen Bob<br>
      info@evergreenaa.com</p>

      <p><u>Copy &amp; paste verification URL</u>:<br>
      https://evergreenaa.com/index.php?token=' . $token . '
    </div>
    
  </body>
  </html>';
      $mail->AltBody = 'Hello ' . $username . ', Please copy and paste this verification link into your browser address bar to validate your EvergreenAA.com registration: https://evergreenaa.com/index.php?token=' . $token;

      $mail->send();

  } catch (Exception $e) {
      echo "Email verification ran into a server error. This is no bueno and brings shame to my family. If you are so inclined, please copy and paste this message into an email to: myevergreenaa@gmail.com -- Mailer Error: {$mail->ErrorInfo}";
  }
}

function sendPasswordResetLink($username, $email, $token) {

  $mail = new PHPMailer(true);

  try {

      mail_config();

      $mail->setFrom('donotreply@evergreenaa.com', 'Evergreen AA Website');
      $mail->addAddress($email, $username);     // Add a recipient
      $mail->addReplyTo($email);
      // $mail->addCC('cc@example.com');
      $mail->addBCC('robert@evergreenwebdesign.com');

      // Content
      $mail->isHTML(true);
      $mail->Subject = 'Reset Your EvergreenAA Password';
      $mail->Body    =    '<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Reset EvergreenAA.com Password</title>
    <style>
      body {
        font-size: 16px;
        color: #313131;
        font-family: Verdana, Tahoma, Calbri, Arial, sans-serif;
      }
      .wrapper {
        padding: 1.5em;
        font-size: 1em;
      }
    </style>      
  </head>
  <body>
    <div class="wrapper">
      <p>Hello ' . $username . ',</p>

      <p>A request has been made to change the password on your account at EvergreenAA.com. If you did not request this change you can ignore this message.</p>

      <p><a style="color:#0000ff;text-decoration:underline;" href="https://evergreenaa.com/index.php?password-token=' . $token . '">Click here</a> to change your password (or use copy &amp; paste option below).</p>

      <p>If you encounter issues with the site or have feature requests please email me anytime. There is a contact form at the bottom of every page labeled, "comments | questions | suggestions".</p>

      <p>Sincerely,<br>
      Evergreen Bob<br>
      info@evergreenaa.com</p>

      <p><u>Copy &amp; paste URL</u>:<br>
      https://evergreenaa.com/index.php?password-token=' . $token . '
    </div>
    
  </body>
  </html>';
      $mail->AltBody = 'Hello ' . $username . ', A request has been made to change the password on your account at EvergreenAA.com. If you did not request this change you can ignore this message. If you did make this request, please copy and paste this link into your browser address bar to reset your password: https://evergreenaa.com/index.php?password-token=' . $token;

      $mail->send();

  } catch (Exception $e) {
      echo "Password reset request ran into a server error. This is no bueno and brings shame to my family. If you are so inclined, please copy and paste this message into an email to: myevergreenaa@gmail.com -- Mailer Error: {$mail->ErrorInfo}";
  }
}


function footer_contact($name, $email, $message) {

  $mail = new PHPMailer(true);

  try {

    mail_config();

    $mail->Subject = "Evergreen AA: comments | questions | suggestions";
    $mail->setFrom('donotreply@evergreenaa.com', 'Evergreen AA Website'); // DO NOT CHANGE!
    $mail->isHTML(true);
    // $mail->addAttachment('_folder/attachment.png');
    $mail->Body    =  'Name: ' . $name . '<br>Email: ' . $email . '<br><hr><br>' . nl2br($message);
    $mail->AltBody = 'Name: ' . $name . '<br>Email: ' . $email . '<br><hr><br>' . nl2br($message);
    $mail->addAddress('robert@evergreenwebdesign.com', 'Evergreen Bob'); // email recipient
    $mail->addReplyTo($email, $name);

    $mail->send();

  } catch (Exception $e) {
    echo  "Mailer Error: {$mail->ErrorInfo}";
  }
}




function email_everyone_BCC($msgsubject, $email_addresses, $message) {
  $mail = new PHPMailer(true);

  try {
      // $mail->Host       = 'smtp.gmail.com';
      // $mail->SMTPAuth   = true;
      // $mail->Username   = EMAIL;
      // $mail->Password   = PASSWORD; 
      // $mail->SMTPSecure = 'ssl';
      // $mail->Port       = 465;

      $mail->Host       = 'localhost';
      $mail->SMTPAuth   = false;
      $mail->Username   = EMAIL;
      $mail->Password   = PASSWORD; 

      //Recipients
      // $mail->setFrom($email, 'Evergreen AA Website');
      $mail->setFrom('donotreply@evergreenaa.com', 'Evergreen AA Website');
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
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = EMAIL;
      $mail->Password   = PASSWORD; 
      $mail->SMTPSecure = 'ssl';
      $mail->Port       = 465;

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