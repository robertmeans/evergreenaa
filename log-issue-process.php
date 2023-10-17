<?php
include_once 'error-reporting.php';

// header('location: https://www.google.com');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
require_once 'config/constants.php';
require_once 'config/database.php';
require_once '_functions/functions.php';
require_once '_functions/query_functions.php';

$db = db_connect();

	$user_id = $_POST['tuid'];
	$mtgid = $_POST['mtgid'];
	$message = trim($_POST['emhmsg']);

	$vdt = $_POST['vdt'];
	$vtz = $_POST['vtz'];

	$meetname = $_POST['mtgname']; // all that's here is meeting name (no day or time)
	// $subject = $mtgname;
	$num_issues = $_POST['ri'] + 1;


if (is_post_request()) {

	$check_for_repeats = verify_first_issue($mtgid, $user_id);
	$repeat = mysqli_num_rows($check_for_repeats);

	if ($repeat == 0) {

		if(strlen($message) < 250 && $message != '') {

				// first update the issues number in meetings table
				$update_issues = update_issues_number($mtgid, $num_issues);

				// next, log id_user + id_mtg + the_issue into issues table
				$log_issue = log_into_issues_table($user_id, $mtgid, $message);


				$emh = get_host_address($mtgid);
				$rowq = mysqli_fetch_assoc($emh);

				$emhemail = $rowq['email'];
				$emhuser = $rowq['username'];
				$emhtz = $rowq['tz'];


			// this is to prevent the mail function from trying to run within an ajax call on localhost which seems to have prevented me from running tests locally. now this will only run on the server.
			if (WWW_ROOT != 'http://localhost/evergreenaa') {

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

	        mail_config();

	        //Recipients
	        $mail->setFrom('donotreply@evergreenaa.com', 'EvergreenAA Website');
	        $mail->addAddress($emhemail, $emhuser);     // Add a recipient
	        $mail->addReplyTo('donotreply@evergreenaa.com', 'Anonymous Member');
	        // $mail->addCC('cc@example.com');
	        $mail->addBCC('robert@evergreenwebdesign.com');

	        // Content
	        $mail->isHTML(true);
	        $mail->Subject = $mtgname;
	        $mail->Body    =  'The following email is being sent from <a href="https://evergreenaa.com" target="_blank">evergreenaa.com</a> and is regarding the meeting that you (Username: ' . $emhuser . ') have posted there titled, "' . $mtgname . '". <br><br><span style="font-weight:bold;color:red;">There has been an issue reported about this meeting.</span> Please log into your Dashboard and click on the edit button for this meeting to address this concern. If 3 issues are reported without your response this meeting will be set to &quot;Draft&quot; and removed from view. It will remain in your account and you will still be able to remedy the issue if you would like to.<br><br>A member reported the following issue(s).<hr><br>' . nl2br($message);

	        $mail->send();
			    // echo 'Message has been sent';
			    $signal = 'ok';
			    $msg =  'Message sent successfully';
		    } catch (Exception $e) {
		        $signal = 'bad';
		        $msg = 'Mail Error: '  {$mail->ErrorInfo};
		    }

			} 
			// still need the 'ok' signal to be returned locally though...
			if (WWW_ROOT == 'http://localhost/evergreenaa') {
			  $signal = 'ok';
			  $msg =  'Message sent successfully';	
			}

		} else {
			$signal = 'bad';
			$msg = 'Please provide a brief explanation of the issue (max 250 characters).';
		}

	} else {
		$signal = 'bad';
		$msg = 'You have already filed an issue on this meeting. You can only file 1 issue per meeting.';
	}

}
	$data = array(
		'signal' => $signal,
		'msg' => $msg
	);
	echo json_encode($data);

// stop

?>
