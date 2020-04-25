<?php $layout_context = "manage"; ?>
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


<?php require '_includes/head.php'; ?>
<body>
<!-- 	<div class="preload">
		<p>Loading...</p>
	</div>	 -->
<?php require '_includes/nav.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">

	
	<div class="manage-simple-intro">
		<?php echo "<p>Hello " . $_SESSION['username'] . ",</p>"; ?>
		<p>Welcome to version 1! For now you can only create meetings and manage them here. All meetings will display on the homepage for everyone to see (regardless of whether they are logged in or not). The long-term plan is to allow those with an account (like you) complete control over their experience on this website. Stay tuned...</p>
		<p class="logout"><a href="logout.php">Logout</a></p>
	</div>
	<a href="new_meeting.php" class="new-mtg-btn">Create a new meeting</a>
	<div class="manage-simple-content">

		<h1>My Meetings</h1>

			<?php
				$subject_set = find_meetings_by_id($user_id);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					while ($row = mysqli_fetch_assoc($subject_set)) { 

					require '_includes/manage-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					}
				} else {
					echo "<p style=\"margin-top:2em;\">You have no public meetings to manage. This area is going to expand to allow you to manage the meetings you follow, eventually. Stay tuned...</p>";
				}
			?>




	</div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>