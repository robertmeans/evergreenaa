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
			<div class="weekday-wrap">

			<?php
				$sql 			= "SELECT * FROM meetings WHERE sun != 0 ORDER BY meet_time;";
				$allData 		= mysqli_query($conn, $sql);
				$resultCheck 	= mysqli_num_rows($allData);

				if ($resultCheck > 0) {
					while ($row = mysqli_fetch_assoc($allData)) { 
					$today = 'Sunday';
					require '_functions/variables.php';
					}
				}
			?>
			</div><!-- .weekday-wrap -->
		</div><!-- #sunday-content -->
	</li>

	<li class="ctr-day">
		<button id="open-monday" class="day">Monday</button>
		<div id="monday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
			<div class="weekday-wrap">

			<?php
				$sql 			= "SELECT * FROM meetings WHERE mon != 0 ORDER BY meet_time;";
				$allData 		= mysqli_query($conn, $sql);
				$resultCheck 	= mysqli_num_rows($allData);

				if ($resultCheck > 0) {
					while ($row = mysqli_fetch_assoc($allData)) { 
					$today = 'Monday';
					require '_functions/variables.php';
					}
				} else { ?> <p class="no-meet">No Meetings Scheduled for Today</p> <?php }
			?>
			</div><!-- .weekday-wrap -->
		</div><!-- #monday-content -->
	</li>

	<li class="ctr-day">
		<button id="open-tuesday" class="day">Tuesday</button>
		<div id="tuesday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
			<div class="weekday-wrap">

			<?php
				$sql 			= "SELECT * FROM meetings WHERE tue != 0 ORDER BY meet_time;";
				$allData 		= mysqli_query($conn, $sql);
				$resultCheck 	= mysqli_num_rows($allData);

				if ($resultCheck > 0) {
					while ($row = mysqli_fetch_assoc($allData)) { 
					$today = 'Tuesday';
					require '_functions/variables.php';
					}
				} else { ?> <p class="no-meet">No Meetings Scheduled for Today</p> <?php }
			?>
			</div><!-- .weekday-wrap -->
		</div><!-- #tuesday-content -->
	</li>

	<li class="ctr-day">
		<button id="open-wednesday" class="day">Wednesday</button>
		<div id="wednesday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
			<div class="weekday-wrap">

			<?php
				$sql 			= "SELECT * FROM meetings WHERE wed != 0 ORDER BY meet_time;";
				$allData 		= mysqli_query($conn, $sql);
				$resultCheck 	= mysqli_num_rows($allData);

				if ($resultCheck > 0) {
					while ($row = mysqli_fetch_assoc($allData)) { 
					$today = 'Wednesday';
					require '_functions/variables.php';
					}
				} else { ?> <p class="no-meet">No Meetings Scheduled for Today</p> <?php }
			?>
			</div><!-- .weekday-wrap -->
		</div><!-- #wednesday-content -->
	</li>

	<li class="ctr-day">
		<button id="open-thursday" class="day">Thursday</button>
		<div id="thursday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
			<div class="weekday-wrap">

			<?php
				$sql 			= "SELECT * FROM meetings WHERE thu != 0 ORDER BY meet_time;";
				$allData 		= mysqli_query($conn, $sql);
				$resultCheck 	= mysqli_num_rows($allData);

				if ($resultCheck > 0) {
					while ($row = mysqli_fetch_assoc($allData)) { 
					$today = 'Thursday';
					require '_functions/variables.php';
					}
				} else { ?> <p class="no-meet">No Meetings Scheduled for Today</p> <?php }
			?>
			</div><!-- .weekday-wrap -->
		</div><!-- #thursday-content -->
	</li>		

	<li class="ctr-day">
		<button id="open-friday" class="day">Friday</button>
		<div id="friday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
			<div class="weekday-wrap">

			<?php
				$sql 			= "SELECT * FROM meetings WHERE fri != 0 ORDER BY meet_time;";
				$allData 		= mysqli_query($conn, $sql);
				$resultCheck 	= mysqli_num_rows($allData);

				if ($resultCheck > 0) {
					while ($row = mysqli_fetch_assoc($allData)) { 
					$today = 'Friday';
					require '_functions/variables.php';
					}
				} else { ?> <p class="no-meet">No Meetings Scheduled for Today</p> <?php }
			?>
			</div><!-- .friday-wrap -->
		</div><!-- #wednesday-content -->
	</li>

	<li class="ctr-day">
		<button id="open-saturday" class="day">Saturday</button>
		<div id="saturday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
			<div class="weekday-wrap">

			<?php
				$sql 			= "SELECT * FROM meetings WHERE sat != 0 ORDER BY meet_time;";
				$allData 		= mysqli_query($conn, $sql);
				$resultCheck 	= mysqli_num_rows($allData);

				if ($resultCheck > 0) {
					while ($row = mysqli_fetch_assoc($allData)) { 
					$today = 'Saturday';
					require '_functions/variables.php';
					}
				} else { ?> <p class="no-meet">No Meetings Scheduled for Today</p> <?php }
			?>
			</div><!-- .weekday-wrap -->
		</div><!-- #saturday-content -->
	</li>

</ul><!-- #weekdays -->
</div><!-- #wrap -->

<?php require '_includes/footer.php'; ?>