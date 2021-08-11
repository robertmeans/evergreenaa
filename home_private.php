<?php 
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

if ($_SESSION['admin'] == 1) {
	$layout_context = "odin-go";
} else if ($_SESSION['admin'] == 2 || $_SESSION['admin'] == 3) {
	$layout_context = "thor-go";
} else if ($_SESSION['admin'] == 85 || $_SESSION['admin'] == 86) {
	$layout_context = "suspended";
} else {
	$layout_context = "home-private";
}

if (!isset($_SESSION['id'])) {
	header('location: home.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: home.php');
	exit();
}

$user_id = $_SESSION['id'];
$user_role = $_SESSION['admin'];

?>

<?php require '_includes/head.php'; ?>
<body>
<?php if (WWW_ROOT != 'http://localhost/evergreenaa') { ?>
<div class="preload">
	<p>One day at a time.</p>
</div>
<?php } ?>	

<?php require '_includes/nav.php'; ?>
<?php require '_includes/private-msg-one.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="wrap">

<?php if ($user_role != 86 && $user_role != 85) { ?>
	
<ul id="weekdays">

	<li class="ctr-day">
		<button id="open-sunday" class="day">Sunday</button>
		<div id="sunday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>

			<?php
				$subject_set = get_all_public_and_private_meetings_for_today($sunday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$today = 'Sunday';

					require '_includes/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					}
				}
				mysqli_free_result($subject_set);
			?>
		</div><!-- #sunday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-monday" class="day">Monday</button>
		<div id="monday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$subject_set = get_all_public_and_private_meetings_for_today($monday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$today = 'Monday';

					require '_includes/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					}
				}
				mysqli_free_result($subject_set);
			?>
		</div><!-- #monday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-tuesday" class="day">Tuesday</button>
		<div id="tuesday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$subject_set = get_all_public_and_private_meetings_for_today($tuesday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					while ($row = mysqli_fetch_assoc($subject_set)) {
					$today = 'Tuesday';

					require '_includes/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					}
				}
				mysqli_free_result($subject_set);
			?>
		</div><!-- #tuesday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-wednesday" class="day">Wednesday</button>
		<div id="wednesday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$subject_set = get_all_public_and_private_meetings_for_today($wednesday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$today = 'Wednesday';

					require '_includes/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					}
				}
				mysqli_free_result($subject_set);
			?>
		</div><!-- #wednesday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-thursday" class="day">Thursday</button>
		<div id="thursday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$subject_set = get_all_public_and_private_meetings_for_today($thursday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$today = 'Thursday';

					require '_includes/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					}
				}
				mysqli_free_result($subject_set);
			?>
		</div><!-- #thursday-content .day-content -->
	</li>		

	<li class="ctr-day">
		<button id="open-friday" class="day">Friday</button>
		<div id="friday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$subject_set = get_all_public_and_private_meetings_for_today($friday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$today = 'Friday';

					require '_includes/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					}
				}
				mysqli_free_result($subject_set);
			?>
		</div><!-- #friday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-saturday" class="day">Saturday</button>
		<div id="saturday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$subject_set = get_all_public_and_private_meetings_for_today($saturday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$today = 'Saturday';

					require '_includes/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					}
				}
				mysqli_free_result($subject_set);
			?>
		</div><!-- #saturday-content .day-content -->
	</li>

</ul><!-- #weekdays -->

<?php } else { // $user_role = 85 || 86 which means they're suspended ?>

<?php 
	$sus_stuff = suspended_msg($user_id);
	$row = mysqli_fetch_assoc($sus_stuff);
?>
	<div id="sus-wrap">
		<p>This account has been put on hold.</p>
		<p class="sus-header">Details</p>
		<p class="sus-notes"><?= nl2br($row['sus_notes']) ?></p>
	</div>

<?php } ?>

</div><!-- #wrap -->

<?php require '_includes/footer.php'; ?>