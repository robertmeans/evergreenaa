<?php
include_once 'error-reporting.php';

// header('location: https://www.google.com');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// require_once '_functions/functions.php';
require_once 'vendor/autoload.php';
require_once 'config/constants.php';
require_once 'config/database.php';
require_once '_functions/functions.php';
require_once 'controllers/authController.php';
require_once '_functions/query_functions.php';

$db = db_connect();

	$mtgid = $_POST['mtgid'];
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$message = trim($_POST['emhmsg']);

	$vdt = $_POST['vdt']; // visitor's day + time (really time + day (e.g. '1:15 PM, Sun'))
	$vtz = $_POST['vtz']; // visitor's tz

	$meetname = $_POST['mtgname']; // all that's here is meeting name (no day or time)

if (is_post_request()) { 

	if($name && $email && $message) {

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

		$emh = get_host_address($mtgid);
		$rowq = mysqli_fetch_assoc($emh);

		$emhemail = $rowq['email'];
		$emhuser = $rowq['username'];
		$emhtz = $rowq['tz'];

		function visitor_to_host($vdt, $vtz, $emhtz) {
		  $from_tz_obj = new DateTimeZone($vtz);
		  $to_tz_obj = new DateTimeZone($emhtz);

		  $ct = new DateTime($vdt, $from_tz_obj);
		  $ct->setTimezone($to_tz_obj);
		  $nct = $ct->format('g:i A, D');

		  return $nct;
		}

		$mtgdt = visitor_to_host($vdt, $vtz, $emhtz);

		$mtgname = $mtgdt . ' - ' . $meetname;

    $mail = new PHPMailer(true);

    try { 

        $mail->Host       = 'localhost';
        $mail->SMTPAuth   = false;
        $mail->Username   = EMAIL;
        $mail->Password   = PASSWORD; 
				// email routing set to Remote

        //Recipients
        $mail->setFrom(EMAIL, 'EvergreenAA Website');
        $mail->addAddress($emhemail, $emhuser);     // Add a recipient
        $mail->addReplyTo($email, $name);
        // $mail->addCC('cc@example.com');
        $mail->addBCC('robertmeans01@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $mtgname;
        $mail->Body    =  'Name: ' . $name . '<br>Email: ' . $email . '<br><br>Note: The following email is being sent from <a href="https://evergreenaa.com" target="_blank">evergreenaa.com</a> and is regarding the meeting that you (Username: ' . $emhuser . ') have posted there titled, "' . $mtgname . '". A visitor has sent you the following question/comment. When you reply to this message you will be communicating directly with them.<hr><br>' . nl2br($message);

        $mail->send();
		    // echo 'Message has been sent';
		    $signal = 'ok';
		    $msg =  'Message sent successfully';
	    } catch (Exception $e) {
	        $signal = 'bad';
	        $msg = 'Mail Error: ' {$mail->ErrorInfo};
	    }

		} else {
		  $signal = 'bad';
		  $msg = 'Invalid email address. Please fix.';
		}

	} else {
		$signal = 'bad';
		$msg = 'Please fill in all the fields.';
	}

}
	$data = array(
		'signal' => $signal,
		'msg' => $msg
	);
	echo json_encode($data);

// stop

?>
