<?php $layout_context = "email-everyone"; ?>
<?php 
include 'error-reporting.php';

require_once 'config/initialize.php';
// require_once '_includes/session.php';

// off for local testing

if (!isset($_SESSION['id'])) {
	header('location: home.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: home.php');
	exit();
}

$user_id = $_SESSION['id'];

// echo delete_success_message();
?>
<?php

if (is_post_request()) {

$row = []; 
$subject = $_POST['subject'] ?? ''; 
$message = $_POST['message'] ?? '';  

	$result = email_everyone($subject, $message);

	if ($result === true) {
		header('location: manage.php');
	} else {
		$errors = $result;
		//var_dump($errors);
		// $subject_set = edit_meeting($id);
	}

	} else { ?>







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
		
		<label>Subject</label>
		<input type="text" name="subject">

		<textarea name="message-body" id="messaga-body"></textarea>

		<div class="update-rt">
			<a class="cancel" href="manage.php">CANCEL</a> <input type="submit" name="admin-email" class="submit" value="SEND">
		</div><!-- .update-rt -->
	</div><!-- .btm-notes -->
	</form>
</div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>

<?php } ?>