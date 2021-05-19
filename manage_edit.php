<?php $layout_context = "manage-edit"; 

require_once 'config/initialize.php';

// off for local testing
if (!isset($_SESSION['id'])) {
	header('location: home.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: home.php');
	exit();
}

// grab meeting id in order to edit this meeting
// if it's not there -> go back to index.php
if (!isset($_GET['id'])) {
	header('location: index.php');
}

// $id = $_GET['id'];
$id = $_GET['id'] ?? '1';
	
$row = edit_meeting($id);

?>

<?php require '_includes/head.php'; ?>
<body>
	<div class="preload-manage">
		<p>One meeting at a time.</p>
	</div>
<?php require '_includes/nav.php'; ?>
<?php require '_includes/lat-long-instructions.php'; ?>
<?php require '_includes/descriptive-location-msg.php'; ?>
<?php require '_includes/pdf-upload-txt.php'; ?>
<?php require '_includes/link-label-txt.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">
	
<div class="manage-simple intro">
	<?php echo "<p>Hey " . $_SESSION['username'] . ",</p>"; ?>
	<p>&quot;The faster you go, the shorter you are.&quot; - Albert Einstein</p>
	<p class="logout"><a href="home_private.php">Home</a> | <a href="manage.php">Dashboard</a></p>
</div>
<div class="manage-simple empty">
	<h1 class="edit-h1">Update this Meeting</h1>
	<?php echo display_errors($errors); ?>

	<?php if ($row['id_user'] == $_SESSION['id'] || $_SESSION['admin'] == '1') { ?>

		<div class="weekday-edit-wrap">
			<?php require '_includes/edit-details.php'; ?>
		</div><!-- .weekday-wrap -->

	<?php } else { echo "<p style=\"margin:1.5em 0 0 1em;\">Either the Internet hiccuped and you ended up here or you're trying to be sneaky. Either way, hold your breath and try again.</p>"; } ?>

</div>

</div><!-- #manage-wrap -->
<?php require '_includes/footer.php'; ?>