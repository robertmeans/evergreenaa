<?php  
require_once 'config/initialize.php';

$layout_context = "odin-active";

if ($_SESSION['id'] != 1) {
	header('location: https://www.merriam-webster.com/dictionary/go%20away');
	exit();
}

$user_id = $_SESSION['id'];

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
	
<ul id="weekdays">

	<li class="ctr-day">
		<button id="open-sunday" class="day">Sunday</button>
		<div id="sunday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>

			<?php
				$subject_set = get_all_public_and_private_meetings_for_odin($sunday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$today = 'Sunday';

					require '_includes/odin-daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/odin-meeting-details.php'; ?>
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
				$subject_set = get_all_public_and_private_meetings_for_odin($monday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$today = 'Monday';

					require '_includes/odin-daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/odin-meeting-details.php'; ?>
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
				$subject_set = get_all_public_and_private_meetings_for_odin($tuesday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					while ($row = mysqli_fetch_assoc($subject_set)) {
					$today = 'Tuesday';

					require '_includes/odin-daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/odin-meeting-details.php'; ?>
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
				$subject_set = get_all_public_and_private_meetings_for_odin($wednesday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$today = 'Wednesday';

					require '_includes/odin-daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/odin-meeting-details.php'; ?>
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
				$subject_set = get_all_public_and_private_meetings_for_odin($thursday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$today = 'Thursday';

					require '_includes/odin-daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/odin-meeting-details.php'; ?>
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
				$subject_set = get_all_public_and_private_meetings_for_odin($friday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$today = 'Friday';

					require '_includes/odin-daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/odin-meeting-details.php'; ?>
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
				$subject_set = get_all_public_and_private_meetings_for_odin($saturday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$today = 'Saturday';

					require '_includes/odin-daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/odin-meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					}
				}
				mysqli_free_result($subject_set);
			?>
		</div><!-- #saturday-content .day-content -->
	</li>

</ul><!-- #weekdays -->
</div><!-- #wrap -->

<?php require '_includes/footer.php'; ?>