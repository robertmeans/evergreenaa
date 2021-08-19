<?php  
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

$layout_context = "home-private";

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
<?php require '_includes/msg-extras.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="wrap">

<?php if ($user_role != 86 && $user_role != 85) { // if they're not suspended 
	$subject_set = get_all_public_and_private_meetings($user_id);
	$row = mysqli_fetch_assoc($subject_set);
?>
<ul id="weekdays">

	<li class="ctr-day">
		<button id="open-sunday" class="day">Sunday</button>
		<div id="sunday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>

			<?php
				if ($row['sun'] == 1) {
					$i = 1;
					foreach ($row['sun'] as ($row['sun'] = 1)) { 
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
					
				<?php } ?>
		</div><!-- #sunday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-monday" class="day">Monday</button>
		<div id="monday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php

				if ($row['mon'] == 1)) {
					$i = 1;	
					foreach ($row['mon'] as ($row['mon'] = 1)) {
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
					
				<?php } ?>
		</div><!-- #monday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-tuesday" class="day">Tuesday</button>
		<div id="tuesday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php

				if ($row['tue'] == 1) {
					$i = 1;
					foreach ($row['tue'] as ($row['tue'] = 1)) {
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
					
				<?php } ?>
		</div><!-- #tuesday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-wednesday" class="day">Wednesday</button>
		<div id="wednesday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php

				if ($row['wed'] == 1) {
					$i = 1;
					foreach ($row['wed'] as ($row['wed'] = 1)) { 
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
					
				<?php } ?>
		</div><!-- #wednesday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-thursday" class="day">Thursday</button>
		<div id="thursday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php

				if ($row['thu'] == 1) {
					$i = 1;
					foreach ($row['thu'] as ($row['thu'] = 1)) { 
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
					
				<?php } ?>
		</div><!-- #thursday-content .day-content -->
	</li>		

	<li class="ctr-day">
		<button id="open-friday" class="day">Friday</button>
		<div id="friday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php

				if ($row['fri'] == 1) {
					$i = 1;
					foreach ($row['fri'] as ($row['fri'] = 1)) { 
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
					
				<?php } ?>
		</div><!-- #friday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-saturday" class="day">Saturday</button>
		<div id="saturday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php

				if ($row['sat'] == 1) {
					$i = 1;
					foreach ($row['sat'] as ($row['sat'] = 1)) { 
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

<?php } else { // $user_role = 85 || 86 which means they're suspended ?>
<?php 
	$sus_stuff = suspended_msg($user_id);
	$row = mysqli_fetch_assoc($sus_stuff);
?>
	<div id="sus-wrap">
		<p>This account has been put on hold.</p>
		<p class="sus-header">Notes on suspension</p>
		<p class="sus-notes"><?= nl2br($row['sus_notes']); ?></p>
	</div>
<?php } mysqli_free_result($sus_stuff); ?>

</div><!-- #wrap -->

<?php require '_includes/footer.php'; ?>