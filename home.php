<?php $layout_context = "home-public"; ?>
<?php 
include 'error-reporting.php';
require_once 'controllers/authController.php'; 

?>


<?php require '_includes/head.php'; ?>
<body>
	<div class="preload">
		<p>One day at a time.</p>
	</div>
<?php require '_includes/nav.php'; ?>
<?php require '_includes/public-msg-one.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="wrap">
	
<ul id="weekdays">

	<li class="ctr-day">
		<button id="open-sunday" class="day">Sunday</button>
		<div id="sunday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>

			<?php
				$sql 			= "SELECT * FROM meetings WHERE sun != 0 ORDER BY meet_time;";
				$allData 		= mysqli_query($conn, $sql);
				$resultCheck 	= mysqli_num_rows($allData);

				if ($resultCheck > 0) {
					while ($row = mysqli_fetch_assoc($allData)) { 
					$today = 'Sunday';

					require '_functions/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_functions/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					}
				}
			?>
		</div><!-- #sunday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-monday" class="day">Monday</button>
		<div id="monday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$sql 			= "SELECT * FROM meetings WHERE mon != 0 ORDER BY meet_time;";
				$allData 		= mysqli_query($conn, $sql);
				$resultCheck 	= mysqli_num_rows($allData);

				if ($resultCheck > 0) {
					while ($row = mysqli_fetch_assoc($allData)) { 
					$today = 'Monday';

					require '_functions/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_functions/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					}
				}
			?>
		</div><!-- #monday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-tuesday" class="day">Tuesday</button>
		<div id="tuesday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$sql 			= "SELECT * FROM meetings WHERE tue != 0 ORDER BY meet_time;";
				$allData 		= mysqli_query($conn, $sql);
				$resultCheck 	= mysqli_num_rows($allData);

				if ($resultCheck > 0) {
					while ($row = mysqli_fetch_assoc($allData)) { 
					$today = 'Tuesday';

					require '_functions/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_functions/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					}
				}
			?>
		</div><!-- #tuesday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-wednesday" class="day">Wednesday</button>
		<div id="wednesday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$sql 			= "SELECT * FROM meetings WHERE wed != 0 ORDER BY meet_time;";
				$allData 		= mysqli_query($conn, $sql);
				$resultCheck 	= mysqli_num_rows($allData);

				if ($resultCheck > 0) {
					while ($row = mysqli_fetch_assoc($allData)) { 
					$today = 'Wednesday';

					require '_functions/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_functions/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					}
				}
			?>
		</div><!-- #wednesday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-thursday" class="day">Thursday</button>
		<div id="thursday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$sql 			= "SELECT * FROM meetings WHERE thu != 0 ORDER BY meet_time;";
				$allData 		= mysqli_query($conn, $sql);
				$resultCheck 	= mysqli_num_rows($allData);

				if ($resultCheck > 0) {
					while ($row = mysqli_fetch_assoc($allData)) { 
					$today = 'Thursday';

					require '_functions/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_functions/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					}
				}
			?>
		</div><!-- #thursday-content .day-content -->
	</li>		

	<li class="ctr-day">
		<button id="open-friday" class="day">Friday</button>
		<div id="friday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$sql 			= "SELECT * FROM meetings WHERE fri != 0 ORDER BY meet_time;";
				$allData 		= mysqli_query($conn, $sql);
				$resultCheck 	= mysqli_num_rows($allData);

				if ($resultCheck > 0) {
					while ($row = mysqli_fetch_assoc($allData)) { 
					$today = 'Friday';

					require '_functions/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_functions/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					}
				}
			?>
		</div><!-- #friday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-saturday" class="day">Saturday</button>
		<div id="saturday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$sql 			= "SELECT * FROM meetings WHERE sat != 0 ORDER BY meet_time;";
				$allData 		= mysqli_query($conn, $sql);
				$resultCheck 	= mysqli_num_rows($allData);

				if ($resultCheck > 0) {
					while ($row = mysqli_fetch_assoc($allData)) { 
					$today = 'Saturday';

					require '_functions/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_functions/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					}
				}
			?>
		</div><!-- #saturday-content .day-content -->
	</li>

</ul><!-- #weekdays -->
</div><!-- #wrap -->

<?php require '_includes/footer.php'; ?>