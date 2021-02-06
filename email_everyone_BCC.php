<?php $layout_context = "email-everyone";

require_once 'config/initialize.php';

// For my eyes only!
if ($_SESSION['id'] != 1) {
	header('location: https://www.merriam-webster.com/dictionary/go%20away');
	exit();
}

?>
<?php

if ((is_post_request()) && (isset($_POST['email-everyone']))) {

$email_addresses = $_POST['email_addresses'];
// for testing, comment above and uncomment below
// $email_addresses = 'robert@robertmeans.com';
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
		$emails[] = "'" . $subject["email"] . "', ";
	}
	// get rid of the last comma
	$email_addresses = substr(implode($emails), 0 , -2);
	// echo "<br><br><br><div style=\"width:80%;margin:0 auto;padding:1.5em;border:1px solid #fff;background-color:#fefefe;color:#313131;\">" . $email_addresses . "</div>";

?>

<?php require '_includes/head.php'; ?>
<body>	
<?php require '_includes/nav.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">

<div class="manage-simple-admin">	
	<h1>Email All Members</h1>
	<p class="admin-email">
		<a href="manage.php">Back</a> | <a href="logout.php">Logout</a>
	</p>
</div>
<div class="manage-simple-email">
	<form class="admin-email-form" action="email_review_BCC.php" method="post">

		<input type="hidden" name="email_addresses" value="<?= $email_addresses ?>">
		
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


<?php mysqli_free_result($result); } else { // if this is your first visit to the page, here's an empty form ?>

<?php require '_includes/head.php'; ?>
<body>	
<?php require '_includes/nav.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">

<div class="manage-simple-admin">	
	<h1>Email All Members</h1>
	<p class="admin-email">
		<a href="manage.php">Back</a> | <a href="logout.php">Logout</a>
	</p>
</div>
<div class="manage-simple-email">
	<form class="admin-email-form" action="email_review_BCC.php" method="post">

		<!-- <input type="text" name="email_addresses" value="<?= $email_addresses ?>"> -->
		
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