<?php $layout_context = "manage"; ?>
<?php 
include 'error-reporting.php';

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

?>


<?php require '_includes/head.php'; ?>
<body>
<?php require '_includes/nav.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">

	
	<div class="manage-simple-intro">
		<?php echo "<p>Hello " . $_SESSION['username'] . ",</p>"; ?>
		<p>Welcome to version 1! For now you can only create meetings and manage them here. All meetings will display on the homepage for everyone to see (regardless of whether they are logged in or not). The long-term plan is to allow those with an account (like you) complete control over their experience on this website. Stay tuned...</p>
	</div>
	<div class="manage-simple-content">
		<h1>My Meetings</h1>

			<?php
				$sql 			= "SELECT * FROM meetings WHERE id_user='" . $_SESSION['id'] . "' ORDER BY meet_time;";
				$allData 		= mysqli_query($db, $sql);
				$resultCheck 	= mysqli_num_rows($allData);

				if ($resultCheck > 0) {
					while ($row = mysqli_fetch_assoc($allData)) { 

					require '_functions/manage-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_functions/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					}
				}
			?>




	</div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>