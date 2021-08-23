<?php $layout_context = "email-everyone";

require_once 'config/initialize.php';

// For my eyes only!
if ($_SESSION['id'] != 1) {
	header('location: https://www.merriam-webster.com/dictionary/go%20away');
	exit();
}

?>
<?php

if (is_post_request()) {

// $email_addresses = $_POST['email_addresses'];
$msgsubject = $_POST['msgsubject'] ?? ''; 
$greeting = $_POST['greeting'] ?? ''; 
$emaileveryonemsg = $_POST['emaileveryonemsg'] ?? '';  


 ?>

<?php 

$result = find_all_users();

	$emails = array();

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
<?php require '_includes/msg-extras.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">

<div class="manage-simple-admin">	
	<h1>Email All Members - Review Message</h1>
	<p class="admin-email">
		<a href="manage.php">Back</a> | <a href="logout.php">Logout</a>
	</p>
</div>
<div class="manage-simple-email">

	<div class="email-everyone-review">
		<h3>Subject</h3>
			<p><?php echo $msgsubject; ?></p>
		<h3 class="next">Message</h3>
		<p><?php echo $greeting . ' Bob,<br><br>' . nl2br($emaileveryonemsg); ?></p>
	</div>

	<form class="admin-email-form" action="email_everyone_PERSONAL.php" method="post">

		<input type="hidden" name="msgsubject" value="<?= $msgsubject; ?>">
		
		<input type="hidden" name="greeting" value="<?= $greeting; ?>">

		<textarea name="emaileveryonemsg" style="display:none;"><?= $emaileveryonemsg; ?></textarea>

		<div class="update-rt">
			<a class="cancel" href="manage.php">CANCEL</a> 
			<input type="submit" name="revise" class="revise-email" value="REVISE"> 
			<input type="submit" name="email-everyone" class="submit-email" value="SEND">
		</div><!-- .update-rt -->
	</div><!-- .btm-notes -->
	</form>
</div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>

<?php  } //?>