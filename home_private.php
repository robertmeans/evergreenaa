<?php  
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

$layout_context = "home-private";

if (isset($_SESSION['id'])) {
	$user_id = $_SESSION['id'];
	$user_role = $_SESSION['admin'];
} else {
	$user_id = 'ns';
	$user_role = '0';
}
require '_includes/head.php'; ?>

<body>
<?php if (WWW_ROOT != 'http://localhost/evergreenaa') { ?>
<div class="preload">
	<p>One day at a time.</p>
</div>
<?php } ?>	

<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-extras.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="wrap">

<?php if ($user_role != 86 && $user_role != 85) { ?>
<ul id="weekdays">

	<li class="ctr-day">
		<button id="open-sunday" class="day">Sunday</button>
		<div id="sunday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>

			<?php
				$subject_set = get_all_public_and_private_meetings_for_today($sunday, $user_id);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					$i = 1;
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					// $str_length = 4;
					// $i = substr("000{$i}", -$str_length);
					$ic = 'i0_'.$i;
					$pc = 'p0_'.$i;
					$today = 'Sunday';

					if ($row['issues'] < 3) {
						require '_includes/daily-glance.php'; ?>
						<div class="weekday-wrap">
							<?php require '_includes/meeting-details.php'; ?>
						</div><!-- .weekday-wrap -->
					<?php }
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
				$subject_set = get_all_public_and_private_meetings_for_today($monday, $user_id);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					$i = 1;	
					while ($row = mysqli_fetch_assoc($subject_set)) {

					$ic = 'i1_'.$i;
					$pc = 'p1_'.$i;
					$today = 'Monday';

					if ($row['issues'] < 3) {
						require '_includes/daily-glance.php'; ?>
						<div class="weekday-wrap">
							<?php require '_includes/meeting-details.php'; ?>
						</div><!-- .weekday-wrap -->
					<?php }
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
				$subject_set = get_all_public_and_private_meetings_for_today($tuesday, $user_id);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					$i = 1;
					while ($row = mysqli_fetch_assoc($subject_set)) {
					$ic = 'i2_'.$i;
					$pc = 'p2_'.$i;
					$today = 'Tuesday';

					if ($row['issues'] < 3) {
						require '_includes/daily-glance.php'; ?>
						<div class="weekday-wrap">
							<?php require '_includes/meeting-details.php'; ?>
						</div><!-- .weekday-wrap -->
					<?php }
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
				$subject_set = get_all_public_and_private_meetings_for_today($wednesday, $user_id);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					$i = 1;
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$ic = 'i3_'.$i;
					$pc = 'p3_'.$i;
					$today = 'Wednesday';

					if ($row['issues'] < 3) {
						require '_includes/daily-glance.php'; ?>
						<div class="weekday-wrap">
							<?php require '_includes/meeting-details.php'; ?>
						</div><!-- .weekday-wrap -->
					<?php }
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
				$subject_set = get_all_public_and_private_meetings_for_today($thursday, $user_id);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					$i = 1;
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$ic = 'i4_'.$i;
					$pc = 'p4_'.$i;
					$today = 'Thursday';

					if ($row['issues'] < 3) {
						require '_includes/daily-glance.php'; ?>
						<div class="weekday-wrap">
							<?php require '_includes/meeting-details.php'; ?>
						</div><!-- .weekday-wrap -->
					<?php }
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
				$subject_set = get_all_public_and_private_meetings_for_today($friday, $user_id);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					$i = 1;
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$ic = 'i5_'.$i;
					$pc = 'p5_'.$i;
					$today = 'Friday';

					if ($row['issues'] < 3) {
						require '_includes/daily-glance.php'; ?>
						<div class="weekday-wrap">
							<?php require '_includes/meeting-details.php'; ?>
						</div><!-- .weekday-wrap -->
					<?php }
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
				$subject_set = get_all_public_and_private_meetings_for_today($saturday, $user_id);
				$result 	= mysqli_num_rows($subject_set);

				if ($result > 0) {
					$i = 1;
					while ($row = mysqli_fetch_assoc($subject_set)) { 
					$ic = 'i6_'.$i;
					$pc = 'p6_'.$i;
					$today = 'Saturday';

					if ($row['issues'] < 3) {
						require '_includes/daily-glance.php'; ?>
						<div class="weekday-wrap">
							<?php require '_includes/meeting-details.php'; ?>
						</div><!-- .weekday-wrap -->
					<?php }
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
		<p class="sus-header">Additional details</p>
		<div class="sus-notes"><?= $row['sus_notes']; ?></div>
	</div>
<?php } ?>

</div><!-- #wrap -->

<?php require '_includes/footer.php'; ?>