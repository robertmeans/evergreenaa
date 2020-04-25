<?php $layout_context = "manage-delete"; ?>
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

// grab meeting id in order to edit this meeting
// if it's not there -> go back to index.php
if (!isset($_GET['id'])) {
	header('location: index.php');
}

// if user clicks UPDATE MEETING
if (is_post_request()) {

	delete_meeting($id);
	header('location: manage.php');

} else {
	$id = $_GET['id'];
}
	
	$row = edit_meeting($id);
?>

<?php require '_includes/head.php'; ?>
<body>
<?php require '_includes/nav.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">
	
<div class="manage-simple-intro">
	<?php echo "<p>Hey " . $_SESSION['username'] . ",</p>"; ?>
	<p><i class="fas fa-exclamation-triangle"></i> Are you sure you really want to go through with this?</p>
	<p class="logout"><a href="manage.php">Go back</a></p>
</div>
<div class="manage-simple-content">
	<h1 class="edit-h1">DELETE this Meeting</h1>

		<?php require '_includes/delete-glance.php'; ?>
		<div class="weekday-edit-wrap">
			<?php require '_includes/delete-meeting.php'; ?>
		</div><!-- .weekday-edit-wrap -->
</div>

</div><!-- #manage-wrap -->
<?php require '_includes/footer.php'; ?>