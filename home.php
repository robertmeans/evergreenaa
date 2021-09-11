<?php $layout_context = "home-public";
 
require_once 'config/initialize.php'; 

$user_id = 'ns'; // not set (for footer modal: submitting issues)
?>

<?php require '_includes/head.php'; ?>
<body>
<?php if (WWW_ROOT != 'http://localhost/evergreenaa') { ?>
<div class="preload">
	<p>One day at a time.</p>
</div>
<?php } ?>
<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-why-join.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="wrap">
	
<ul id="weekdays">

	<li class="ctr-day">
		<button id="open-sunday" class="day">Sunday</button>
		<div id="sunday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>

			<?php
				$subject_set = get_all_public_meetings_for_today($sunday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					$i = 1;
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$ic = 'i0_'.$i;
					$pc = 'p0_'.$i;
					$today = 'Sunday';

					require '_includes/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					$i++; }
				} else { ?>
					<p class="no-mtgs">No meetings posted for Sunday.</p>
					
				<?php } mysqli_free_result($subject_set); ?>
		</div><!-- #sunday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-monday" class="day">Monday</button>
		<div id="monday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$subject_set = get_all_public_meetings_for_today($monday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					$i = 1;
					while ($row = mysqli_fetch_assoc($subject_set)) {
					$ic = 'i1_'.$i;
					$pc = 'p1_'.$i;
					$today = 'Monday';

					require '_includes/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					$i++; }
				} else { ?>
					<p class="no-mtgs">No meetings posted for Monday.</p>
					
				<?php } mysqli_free_result($subject_set); ?>
		</div><!-- #monday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-tuesday" class="day">Tuesday</button>
		<div id="tuesday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$subject_set = get_all_public_meetings_for_today($tuesday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					$i = 1;
					while ($row = mysqli_fetch_assoc($subject_set)) {
					$ic = 'i2_'.$i;
					$pc = 'p2_'.$i;  
					$today = 'Tuesday';

					require '_includes/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					$i++; }
				} else { ?>
					<p class="no-mtgs">No meetings posted for Tuesday.</p>
					
				<?php } mysqli_free_result($subject_set); ?>
		</div><!-- #tuesday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-wednesday" class="day">Wednesday</button>
		<div id="wednesday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$subject_set = get_all_public_meetings_for_today($wednesday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					$i = 1;
					while ($row = mysqli_fetch_assoc($subject_set)) {
					$ic = 'i3_'.$i;
					$pc = 'p3_'.$i; 
					$today = 'Wednesday';

					require '_includes/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					$i++; }
				} else { ?>
					<p class="no-mtgs">No meetings posted for Wednesday.</p>
					
				<?php } mysqli_free_result($subject_set); ?>
		</div><!-- #wednesday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-thursday" class="day">Thursday</button>
		<div id="thursday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$subject_set = get_all_public_meetings_for_today($thursday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					$i = 1;
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$ic = 'i4_'.$i;
					$pc = 'p4_'.$i;
					$today = 'Thursday';

					require '_includes/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					$i++; }
				} else { ?>
					<p class="no-mtgs">No meetings posted for Thursday.</p>
					
				<?php } mysqli_free_result($subject_set); ?>
		</div><!-- #thursday-content .day-content -->
	</li>		

	<li class="ctr-day">
		<button id="open-friday" class="day">Friday</button>
		<div id="friday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$subject_set = get_all_public_meetings_for_today($friday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					$i = 1;
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$ic = 'i5_'.$i;
					$pc = 'p5_'.$i;
					$today = 'Friday';

					require '_includes/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					$i++; }
				} else { ?>
					<p class="no-mtgs">No meetings posted for Friday.</p>
					
				<?php } mysqli_free_result($subject_set); ?>
		</div><!-- #friday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-saturday" class="day">Saturday</button>
		<div id="saturday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$subject_set = get_all_public_meetings_for_today($saturday);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					$i = 1;
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$ic = 'i6_'.$i;
					$pc = 'p6_'.$i;
					$today = 'Saturday';

					require '_includes/daily-glance.php'; ?>
					<div class="weekday-wrap">
						<?php require '_includes/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
					$i++; }
				} else { ?>
					<p class="no-mtgs">No meetings posted for Saturday.</p>
					
				<?php } mysqli_free_result($subject_set); ?>
		</div><!-- #saturday-content .day-content -->
	</li>

</ul><!-- #weekdays -->
</div><!-- #wrap -->

<?php require '_includes/footer.php'; ?>