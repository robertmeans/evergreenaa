<?php $layout_context = "home-private"; 

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

$user_id = $_SESSION['id'];

?>

<?php require '_includes/head.php'; ?>
<body>
<!-- 	<div class="preload">
		<p>One day at a time.</p>
	</div> -->
<script>
	function initMap() {
		
	}
</script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVGjPB87QSFceli6EMwlRlLxvmewIA1P0&callback=initMap&libraries=&v=weekly"
      async
    ></script>

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
</div><!-- #wrap -->

<?php require '_includes/footer.php'; ?>