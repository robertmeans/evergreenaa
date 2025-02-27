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

$result = find_all_users();

	while($subject = mysqli_fetch_assoc($result)) {
	$send_to = $subject['email'];
	$greeting = $_POST['greeting'];
	$msgsubject = $_POST['msgsubject']; 
	$user_name = $subject['username'];
	$emaileveryonemsg = ($_POST['greeting'] . ' ' . $user_name . ',<br><br>' . $_POST['emaileveryonemsg']) ?? ''; 

		if ($subject['verified'] != 0) {
		email_everyone_PERSONAL($msgsubject, $send_to, nl2br($emaileveryonemsg));
		// echo $subject['username'] . "<br>";
		}

	}

	mysqli_free_result($result);
	header('location: manage.php');

	// revise your message.
	} else if ((is_post_request()) && (isset($_POST['revise']))) { ?>

<?php 

$msgsubject = $_POST['msgsubject'] ?? ''; 
$greeting = $_POST['greeting'] ?? '';
$emaileveryonemsg = $_POST['emaileveryonemsg'] ?? '';

?>

<?php require '_includes/head.php'; ?>
<body>	
<?php require '_includes/nav.php'; ?>
<?php require_once '_includes/messages.php'; ?>
<?php $theme = configure_theme(); mobile_bkg_config($theme); ?>
<div id="manage-wrap">

<div class="manage-simple-admin">	
	<h1>Email All Members</h1>
	<p class="admin-email">
		<a href="manage.php">Back</a> | <a href="logout.php">Logout</a>
	</p>
</div>
<div class="manage-simple-email">
	<form class="admin-email-form" action="email_review_PERSONAL.php" method="post">
		
		<label>Subject</label>
		<input type="text" name="msgsubject" value="<?= $msgsubject; ?>">

		<div class="greeting-string">
			<label>Greeting</label>
			<input type="text" name="greeting" class="greeting" value="<?= $greeting ?>">
		</div>
		<div class="greeting-string">
			<label>&nbsp;</label>
			<?= "Bah-BAY!," ?>
		</div>

		<textarea name="emaileveryonemsg" id="message-body"><?= $emaileveryonemsg; ?></textarea>

		<div class="update-rt">
			<a class="cancel" href="manage.php">CANCEL</a> <input type="submit" name="admin-email" class="submit" value="REVIEW">
		</div><!-- .update-rt -->
	</div><!-- .btm-notes -->
	</form>
</div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>


<?php } else { // if this is your first visit to the page, here's an empty form ?>

<?php require '_includes/head.php'; ?>
<body>	
<?php require '_includes/nav.php'; ?>
<?php require_once '_includes/messages.php'; ?>
<?php $theme = configure_theme(); mobile_bkg_config($theme); ?>
<div id="manage-wrap">

<div class="manage-simple-admin">	
	<h1>Email All Members</h1>
	<p class="admin-email">
		<a href="manage.php">Back</a> | <a href="logout.php">Logout</a>
	</p>
</div>
<div class="manage-simple-email">
	<form class="admin-email-form" action="email_review_PERSONAL.php" method="post">

		<label>Subject</label>
		<input type="text" name="msgsubject">

		<div class="greeting-string">
			<label>Greeting</label>
			<input type="text" name="greeting" class="greeting">
		</div>
		<div class="greeting-string">
			<label>&nbsp;</label>
			<?= "Bah-BAY!," ?>
		</div>

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