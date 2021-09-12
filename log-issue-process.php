<?php
// header('location: https://www.google.com');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
require_once 'config/constants.php';
require_once 'config/database.php';
require_once 'controllers/authController.php';
require_once '_functions/functions.php';
require_once '_functions/query_functions.php';

$db = db_connect();

	$user_id = $_POST['tuid'];
	$mtgid = $_POST['mtgid'];
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$message = trim($_POST['emhmsg']);
	$mtgname = $_POST['mtgname'];
	$subject = $mtgname;
	$num_issue = $_POST['ri'];
	$num_issues = $num_issue + 1;

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
	        $mail->addReplyTo($emhemail, $emhuser);
	        // $mail->addCC('cc@example.com');
	        $mail->addBCC('robertmeans01@gmail.com');

	        // Content
	        $mail->isHTML(true);
	        $mail->Subject = $subject;
	        $mail->Body    =  'The following email is being sent from <a href="https://evergreenaa.com" target="_blank">evergreenaa.com</a> and is regarding the meeting that you (Username: ' . $emhuser . ') have posted there titled, "' . $mtgname . '". <br><br>There has been an issue reported about this meeting. Please log into your Dashboard and click on the edit button for this meeting to address this concern. If 3 issues are reported without your response this meeting will be set to &quot;Draft&quot; and removed from view. It will remain in your account and you will still be able to remedy the issue if you would like to.<br><br>A member reported the following issue(s).<hr><br>' . nl2br($message);

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