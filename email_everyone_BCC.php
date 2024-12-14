<?php 
require_once 'config/initialize.php';

$layout_context = "alt-manage";

if ($_SESSION['id'] != 1) {
	header('location: https://www.merriam-webster.com/dictionary/go%20away');
	exit();
}

?>
<?php

if ((is_post_request()) && (isset($_POST['email-everyone']))) {

// $email_addresses = $_POST['email_addresses'];
// for testing, comment above and uncomment below
// $email_addresses = 'robertmeans01@gmail.com';
$email_addresses = 'robertmeans01@gmail.com; browsergadget@gmail.com';
// concludes testing
$msgsubject = $_POST['msgsubject'] ?? ''; 
$emaileveryonemsg = $_POST['emaileveryonemsg'] ?? '';  

// if you're happy with the message, send it and head back to manage.php
email_everyone_BCC($msgsubject, $email_addresses, nl2br($emaileveryonemsg));
header('location: manage.php');

	// either revise your message or submit it from here.
	} else if ((is_post_request()) && (isset($_POST['revise']))) { ?>

<?php 

$msgsubject = $_POST['msgsubject'] ?? ''; 
$emaileveryonemsg = $_POST['emaileveryonemsg'] ?? '';

$result = find_all_users();

	$emails = array();
	// get email addresses ready for sending and put them in a hidden field
	while($subject = mysqli_fetch_assoc($result)) {
		$emails[] = $subject['email'] . "; ";
		// $emails[] = "'" . $subject['email'] . "', ";
	}
	// get rid of the last comma
	$email_addresses = substr(implode($emails), 0 , -2);
	// $email_addresses = "this some bullshiz";
	// echo "<br><br><br><div style=\"width:80%;margin:0 auto;padding:1.5em;border:1px solid #fff;background-color:#fefefe;color:#313131;\">" . $email_addresses . "</div>";

?>

<?php require '_includes/head.php'; ?>
<body>	
<?php require '_includes/nav.php'; ?>
<?php require_once '_includes/messages.php'; ?>
<?php $theme = configure_theme(); mobile_bkg_config($theme); ?>
<div id="manage-wrap">

<div class="manage-simple-admin">	
	<h1>Email All Members</h1>
<?php require '_includes/inner_nav.php'; ?>
</div>
<div class="manage-simple-email">
	<form class="admin-email-form" action="email_review_BCC.php" method="post">

		<input type="hidden" name="email_addresses" value="<?= $email_addresses; ?>">
		
		<label>Subject</label>
		<input type="text" name="msgsubject" value="<?= $msgsubject; ?>">

		<textarea name="emaileveryonemsg" id="message-body"><?= $emaileveryonemsg; ?></textarea>

		<div class="update-rt">
			<a class="cancel" href="manage.php">CANCEL</a> <input type="submit" name="admin-email" class="submit" value="REVIEW">
		</div><!-- .update-rt -->
	</div><!-- .btm-notes -->
	</form>
</div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>


<?php mysqli_free_result($result); } else { // if this is your first visit to the page, here's an empty form 


// $msgsubject = $_POST['msgsubject'] ?? ''; 
// $emaileveryonemsg = $_POST['emaileveryonemsg'] ?? '';

$result = find_all_users();

	$emails = array();
	// get email addresses ready for sending and put them in a hidden field
	while($subject = mysqli_fetch_assoc($result)) {
		$emails[] = $subject['email'] . "; ";
		// $emails[] = "'" . $subject['email'] . "', ";
	}
	// get rid of the last comma
	$email_addresses = substr(implode($emails), 0 , -2);
	// $email_addresses = "this some bullshiz";
	// echo "<br><br><br><div style=\"width:80%;margin:0 auto;padding:1.5em;border:1px solid #fff;background-color:#fefefe;color:#313131;\">" . $email_addresses . "</div>";
?>


<?php require '_includes/head.php'; ?>
<body>	
<?php require '_includes/nav.php'; ?>
<?php require_once '_includes/messages.php'; ?>
<?php $theme = configure_theme(); mobile_bkg_config($theme); ?>
<div id="manage-wrap">

<div class="manage-simple intro">	
<p>Email All Members</p>
<?php require '_includes/inner_nav.php'; ?>
</div>

<div class="manage-simple-email">
<?php /*
echo "<div style=\"width:100%;height:8em;margin:0 auto 1em;overflow-y:scroll;padding:.5em;border:1px solid #fff;background-color:#fefefe;color:#313131;\">" . strtolower($email_addresses) . "</div>";
*/ ?>


	<form class="admin-email-form" action="email_review_BCC.php" method="post">

		<div class="bccem">
			<input id="pickitup" type="hidden" value="<?= strtolower($email_addresses); ?>" class="day-values input-copy">
			<a data-role="em" data-id="pickitup"><i class="far fa-copy"></i> All Addresses</a>
		</div>

		<input type="hidden" name="email_addresses" value="<?= $email_addresses ?>">
		
		<label>Subject</label>
		<input type="text" name="msgsubject">

		<textarea name="emaileveryonemsg"></textarea>

		<div class="update-rt">
			<a class="cancel" href="manage.php">CANCEL</a> <input type="submit" name="admin-email" class="submit" value="REVIEW">
		</div><!-- .update-rt -->
	</div><!-- .btm-notes -->
	</form>
</div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>


<?php } ?>