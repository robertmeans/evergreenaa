<?php $layout_context = "manage-edit"; ?>
<?php 
include 'error-reporting.php';

require_once 'config/initialize.php';


$id = $_GET['id'];

// off for local testing
if (!isset($_SESSION['id'])) {
	header('location: home.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: home.php');
	exit();
}

?>


<?php require '_includes/head.php'; ?>
<body>
<?php require '_includes/nav.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">
	
	<div class="manage-simple-intro">
		<?php echo "<p>Hey " . $_SESSION['username'] . ",</p>"; ?>
		<p>You look nice today. <i class="far fa-smile"></i></p>
	</div>
	<div class="manage-simple-content">
		<h1 class="edit-h1">Update this Meeting</h1>
 
			<?php
				$subject_set = edit_meeting($id);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					while ($row = mysqli_fetch_assoc($subject_set)) {  

					// require '_functions/manage-edit-glance.php'; ?>
					<div class="weekday-edit-wrap">
						<?php require '_functions/manage-meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					}
				}
			?>
	</div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>