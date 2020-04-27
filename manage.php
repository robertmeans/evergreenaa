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
<div class="preload-manage">
	<p>Loading...</p>
</div>	
<?php require '_includes/nav.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">
	
	<div class="manage-simple intro">
		<?php echo "<p>Hello " . $_SESSION['username'] . ",</p>"; ?>
		<!-- <p>Welcome to version 1! For now you can only create meetings and manage them here. All meetings will display on the homepage for everyone to see (regardless of whether they are logged in or not). The long-term plan is to allow those with an account (like you) complete control over their experience on this website. Stay tuned...</p> -->
		<p>The goal here is simple. Through harnessing our network of AA communities around the world we can make AA meetings available 24-7-365 in the comfort of your living room.</p>
		<p>Online meetings aren't going anywhere. The convenience and practicality is obvious and serves an even larger audience. Let's connect people and save lives.</p>
		<p class="logout"><a href="logout.php">Logout</a></p>
	</div>
	<a href="manage_new.php" class="new-mtg-btn">Create a new meeting</a>
<div class="manage-simple">	
	<h1>My Meetings</h1>
</div>

<ul class="manage-weekdays">
<?php 
	$any_meetings_for_user = find_meetings_by_id($user_id);
	$result 	= mysqli_num_rows($any_meetings_for_user);
	// find out if user has any meetings they manage
	if ($result > 0) { ?>

<?php // if user has meetings to manage, display on a daily basis
	$users_sunday_meetings = find_meetings_by_id_today($user_id, $sunday);
	$sunday_meetings 	= mysqli_num_rows($users_sunday_meetings);

	if ($sunday_meetings > 0) { ?>
		
		<li class="ctr-day">
			<div class="manage-day-toggle day">Sunday</div>
			<div id="sunday-content" class="day-content">
			<?php include '_includes/collapse-day.php'; ?>

		<?php while ($row = mysqli_fetch_assoc($users_sunday_meetings)) { ?>

			<?php require '_includes/manage-glance.php'; ?>
			<div class="weekday-wrap">
				<?php require '_includes/meeting-details.php'; ?>
			</div><!-- .weekday-wrap -->

		<?php } mysqli_free_result($users_sunday_meetings); ?>

			</div><!-- #sunday-content .day-content -->
		</li>

	<?php } 

	// if user has meetings to manage, display on a daily basis
	$users_monday_meetings = find_meetings_by_id_today($user_id, $monday);
	$monday_meetings 	= mysqli_num_rows($users_monday_meetings);

	if ($monday_meetings > 0) { ?>
		
		<li class="ctr-day">
			<div class="manage-day-toggle day">Monday</div>
			<div id="sunday-content" class="day-content">
			<?php include '_includes/collapse-day.php'; ?>

		<?php while ($row = mysqli_fetch_assoc($users_monday_meetings)) { ?>

			<?php require '_includes/manage-glance.php'; ?>
			<div class="weekday-wrap">
				<?php require '_includes/meeting-details.php'; ?>
			</div><!-- .weekday-wrap -->

		<?php } mysqli_free_result($users_monday_meetings); ?>

			</div><!-- #sunday-content .day-content -->
		</li>

	<?php } 

	// if user has meetings to manage, display on a daily basis
	$users_tuesday_meetings = find_meetings_by_id_today($user_id, $tuesday);
	$tuesday_meetings 	= mysqli_num_rows($users_tuesday_meetings);

	if ($tuesday_meetings > 0) { ?>
		
		<li class="ctr-day">
			<div class="manage-day-toggle day">Tuesday</div>
			<div id="sunday-content" class="day-content">
			<?php include '_includes/collapse-day.php'; ?>

		<?php while ($row = mysqli_fetch_assoc($users_tuesday_meetings)) { ?>

			<?php require '_includes/manage-glance.php'; ?>
			<div class="weekday-wrap">
				<?php require '_includes/meeting-details.php'; ?>
			</div><!-- .weekday-wrap -->

		<?php } mysqli_free_result($users_tuesday_meetings); ?>

			</div><!-- #sunday-content .day-content -->
		</li>

	<?php }

	// if user has meetings to manage, display on a daily basis
	$users_wednesday_meetings = find_meetings_by_id_today($user_id, $wednesday);
	$wednesday_meetings 	= mysqli_num_rows($users_wednesday_meetings);

	if ($wednesday_meetings > 0) { ?>
		
		<li class="ctr-day">
			<div class="manage-day-toggle day">Wednesday</div>
			<div id="sunday-content" class="day-content">
			<?php include '_includes/collapse-day.php'; ?>

		<?php while ($row = mysqli_fetch_assoc($users_wednesday_meetings)) { ?>

			<?php require '_includes/manage-glance.php'; ?>
			<div class="weekday-wrap">
				<?php require '_includes/meeting-details.php'; ?>
			</div><!-- .weekday-wrap -->

		<?php } mysqli_free_result($users_wednesday_meetings); ?>

			</div><!-- #sunday-content .day-content -->
		</li>

	<?php }

	// if user has meetings to manage, display on a daily basis
	$users_thursday_meetings = find_meetings_by_id_today($user_id, $thursday);
	$thursday_meetings 	= mysqli_num_rows($users_thursday_meetings);

	if ($thursday_meetings > 0) { ?>
		
		<li class="ctr-day">
			<div class="manage-day-toggle day">Thursday</div>
			<div id="sunday-content" class="day-content">
			<?php include '_includes/collapse-day.php'; ?>

		<?php while ($row = mysqli_fetch_assoc($users_thursday_meetings)) { ?>

			<?php require '_includes/manage-glance.php'; ?>
			<div class="weekday-wrap">
				<?php require '_includes/meeting-details.php'; ?>
			</div><!-- .weekday-wrap -->

		<?php } mysqli_free_result($users_thursday_meetings); ?>

			</div><!-- #sunday-content .day-content -->
		</li>

	<?php }	

	// if user has meetings to manage, display on a daily basis
	$users_friday_meetings = find_meetings_by_id_today($user_id, $friday);
	$friday_meetings 	= mysqli_num_rows($users_friday_meetings);

	if ($friday_meetings > 0) { ?>
		
		<li class="ctr-day">
			<div class="manage-day-toggle day">Friday</div>
			<div id="sunday-content" class="day-content">
			<?php include '_includes/collapse-day.php'; ?>

		<?php while ($row = mysqli_fetch_assoc($users_friday_meetings)) { ?>

			<?php require '_includes/manage-glance.php'; ?>
			<div class="weekday-wrap">
				<?php require '_includes/meeting-details.php'; ?>
			</div><!-- .weekday-wrap -->

		<?php } mysqli_free_result($users_friday_meetings); ?>

			</div><!-- #sunday-content .day-content -->
		</li>

	<?php }	

	// if user has meetings to manage, display on a daily basis
	$users_saturday_meetings = find_meetings_by_id_today($user_id, $saturday);
	$saturday_meetings 	= mysqli_num_rows($users_saturday_meetings);

	if ($saturday_meetings > 0) { ?>
		
		<li class="ctr-day">
			<div class="manage-day-toggle day">Saturday</div>
			<div id="sunday-content" class="day-content">
			<?php include '_includes/collapse-day.php'; ?>

		<?php while ($row = mysqli_fetch_assoc($users_saturday_meetings)) { ?>

			<?php require '_includes/manage-glance.php'; ?>
			<div class="weekday-wrap">
				<?php require '_includes/meeting-details.php'; ?>
			</div><!-- .weekday-wrap -->

		<?php } mysqli_free_result($users_saturday_meetings); ?>

			</div><!-- #sunday-content .day-content -->
		</li>

	<?php }

	} else { // user has no meetings to manage
		echo "<p style=\"margin-top:0.5em;padding:0px 1em;\">You have no public meetings to manage. When you create a meeting it will display here. This area is going to expand to allow you to follow meetings and manage them here, eventually. Stay tuned...</p>";
	}  mysqli_free_result($any_meetings_for_user); ?>

</ul><!-- .manage-weekdays -->
</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>