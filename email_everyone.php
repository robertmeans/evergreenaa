<?php $layout_context = "email-everyone"; ?>
<?php 
include 'error-reporting.php';

require_once 'config/initialize.php';
// require_once '_includes/session.php';


// For my eyes only!
if ($_SESSION['id'] != 1) {
	header('location: https://www.merriam-webster.com/dictionary/go%20away');
	exit();
}



$user_id = $_SESSION['id'];

// echo delete_success_message();
?>
<?php

if (is_post_request()) {

$email_addresses = $_POST['email_addresses'];
$subject = $_POST['subject'] ?? ''; 
$message = $_POST['message'] ?? '';  

// until you're ready to use...
// email_everyone($subject, $email_addresses, nl2br($message));

header('location: manage.php');


	} else { ?>

<?php 

$result = find_all_users_email();

	$emails = array();

	while($subject = mysqli_fetch_assoc($result)) {
		$emails[] = "'" . $subject["email"] . "', ";
	}

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
	<form class="admin-email-form" action="" method="post">

		<input type="hidden" name="email_addresses" value="<?= $email_addresses ?>">
		
		<label>Subject</label>
		<input type="text" name="subject">

		<textarea name="message" id="message-body"></textarea>

		<div class="update-rt">
			<a class="cancel" href="manage.php">CANCEL</a> <input type="submit" name="admin-email" class="submit" value="SEND">
		</div><!-- .update-rt -->
	</div><!-- .btm-notes -->
	</form>
</div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>

<?php mysqli_free_result($result); } ?>