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
				$get_range = 'sun';
				list($yesterday, $today, $tomorrow) = day_range($get_range);
				$subject_set = get_all_public_and_private_meetings_for_todayza($yesterday, $today, $tomorrow, $get_range, $user_id);

					$i = 1;
					// while ($row = mysqli_fetch_assoc($subject_set)) {
					foreach ($subject_set as $row) {
						$eval_yesterday = $row[$yesterday];
						$eval_today = $row[$today];
						$eval_tomorrow = $row[$tomorrow];
						// echo $eval_yesterday . ' | ' . $eval_today . ' | ' . $eval_tomorrow . "<br />";

						$tz = $row['tz'];
						$mtz = convert_timezone($eval_yesterday, $eval_today, $eval_tomorrow, $get_range, $tz);
						// echo $mtz . "<br />";

						$todayz = 'Sunday';
						$ic = 'i0_'.$i;
						$pc = 'p0_'.$i;

						if (($row['issues'] < 3) && (strpos($mtz, ucfirst($get_range)) !== false)) {
							$mtgs_sun = 1;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_sun)) { ?> <p class="no-mtgs">No meetings posted for <?= $todayz ?>.</p> <?php } ?>
					
				<?php mysqli_free_result($subject_set); ?>

		</div><!-- #sunday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-monday" class="day">Monday</button>
		<div id="monday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$get_range = 'mon';
				list($yesterday, $today, $tomorrow) = day_range($get_range);
				$subject_set = get_all_public_and_private_meetings_for_todayza($yesterday, $today, $tomorrow, $user_id);

					$i = 1;
					// while ($row = mysqli_fetch_assoc($subject_set)) {
					foreach ($subject_set as $row) { 
						$eval_yesterday = $row[$yesterday];
						$eval_today = $row[$today];
						$eval_tomorrow = $row[$tomorrow];

						$tz = $row['tz'];
						$mtz = convert_timezone($eval_yesterday, $eval_today, $eval_tomorrow, $get_range, $tz);

						$todayz = 'Monday';
						$ic = 'i0_'.$i;
						$pc = 'p0_'.$i;

						if (($row['issues'] < 3) && (strpos($mtz, ucfirst($get_range)) !== false)) {
							$mtgs_mon = 1;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_mon)) { ?> <p class="no-mtgs">No meetings posted for <?= $todayz ?>.</p> <?php } ?>
					
				<?php mysqli_free_result($subject_set); ?>
		</div><!-- #monday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-tuesday" class="day">Tuesday</button>
		<div id="tuesday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$get_range = 'tue';
				list($yesterday, $today, $tomorrow) = day_range($get_range);
				$subject_set = get_all_public_and_private_meetings_for_todayza($yesterday, $today, $tomorrow, $user_id);

					$i = 1;
					// while ($row = mysqli_fetch_assoc($subject_set)) {
					foreach ($subject_set as $row) {
						$eval_yesterday = $row[$yesterday];
						$eval_today = $row[$today];
						$eval_tomorrow = $row[$tomorrow];

						$tz = $row['tz'];
						$mtz = convert_timezone($eval_yesterday, $eval_today, $eval_tomorrow, $get_range, $tz);

						$todayz = 'Tuesday';
						$ic = 'i0_'.$i;
						$pc = 'p0_'.$i;

						if (($row['issues'] < 3) && (strpos($mtz, ucfirst($get_range)) !== false)) {
							$mtgs_tue = 1;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_tue)) { ?> <p class="no-mtgs">No meetings posted for <?= $todayz ?>.</p> <?php } ?>
					
				<?php mysqli_free_result($subject_set); ?>
		</div><!-- #tuesday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-wednesday" class="day">Wednesday</button>
		<div id="wednesday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$get_range = 'wed';
				list($yesterday, $today, $tomorrow) = day_range($get_range);
				$subject_set = get_all_public_and_private_meetings_for_todayza($yesterday, $today, $tomorrow, $user_id);

					$i = 1;
					// while ($row = mysqli_fetch_assoc($subject_set)) {
					foreach ($subject_set as $row) {
						$eval_yesterday = $row[$yesterday];
						$eval_today = $row[$today];
						$eval_tomorrow = $row[$tomorrow];

						$tz = $row['tz'];
						$mtz = convert_timezone($eval_yesterday, $eval_today, $eval_tomorrow, $get_range, $tz);

						$todayz = 'Wednesday';
						$ic = 'i0_'.$i;
						$pc = 'p0_'.$i;

						if (($row['issues'] < 3) && (strpos($mtz, ucfirst($get_range)) !== false)) {
							$mtgs_wed = 1;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_wed)) { ?> <p class="no-mtgs">No meetings posted for <?= $todayz ?>.</p> <?php } ?>
					
				<?php mysqli_free_result($subject_set); ?>
		</div><!-- #wednesday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-thursday" class="day">Thursday</button>
		<div id="thursday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$get_range = 'thu';
				list($yesterday, $today, $tomorrow) = day_range($get_range);
				$subject_set = get_all_public_and_private_meetings_for_todayza($yesterday, $today, $tomorrow, $user_id);

					$i = 1;
					// while ($row = mysqli_fetch_assoc($subject_set)) {
					foreach ($subject_set as $row) {
						$eval_yesterday = $row[$yesterday];
						$eval_today = $row[$today];
						$eval_tomorrow = $row[$tomorrow];

						$tz = $row['tz'];
						$mtz = convert_timezone($eval_yesterday, $eval_today, $eval_tomorrow, $get_range, $tz);

						$todayz = 'Thursday';
						$ic = 'i0_'.$i;
						$pc = 'p0_'.$i;

						if (($row['issues'] < 3) && (strpos($mtz, ucfirst($get_range)) !== false)) {
							$mtgs_thu = 1;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_thu)) { ?> <p class="no-mtgs">No meetings posted for <?= $todayz ?>.</p> <?php } ?>
					
				<?php mysqli_free_result($subject_set); ?>
		</div><!-- #thursday-content .day-content -->
	</li>		

	<li class="ctr-day">
		<button id="open-friday" class="day">Friday</button>
		<div id="friday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$get_range = 'fri';
				list($yesterday, $today, $tomorrow) = day_range($get_range);
				$subject_set = get_all_public_and_private_meetings_for_todayza($yesterday, $today, $tomorrow, $user_id);

					$i = 1;
					// while ($row = mysqli_fetch_assoc($subject_set)) {
					foreach ($subject_set as $row) { 
						$eval_yesterday = $row[$yesterday];
						$eval_today = $row[$today];
						$eval_tomorrow = $row[$tomorrow];

						$tz = $row['tz'];
						$mtz = convert_timezone($eval_yesterday, $eval_today, $eval_tomorrow, $get_range, $tz);

						$todayz = 'Friday';
						$ic = 'i0_'.$i;
						$pc = 'p0_'.$i;

						if (($row['issues'] < 3) && (strpos($mtz, ucfirst($get_range)) !== false)) {
							$mtgs_fri = 1;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_fri)) { ?> <p class="no-mtgs">No meetings posted for <?= $todayz ?>.</p> <?php } ?>
					
				<?php mysqli_free_result($subject_set); ?>
		</div><!-- #friday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-saturday" class="day">Saturday</button>
		<div id="saturday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$get_range = 'sat';
				list($yesterday, $today, $tomorrow) = day_range($get_range);
				$subject_set = get_all_public_and_private_meetings_for_todayza($yesterday, $today, $tomorrow, $user_id);

					$i = 1;
					// while ($row = mysqli_fetch_assoc($subject_set)) {
					foreach ($subject_set as $row) {
						$eval_yesterday = $row[$yesterday];
						$eval_today = $row[$today];
						$eval_tomorrow = $row[$tomorrow];

						$tz = $row['tz'];
						$mtz = convert_timezone($eval_yesterday, $eval_today, $eval_tomorrow, $get_range, $tz);

						$todayz = 'Saturday';
						$ic = 'i0_'.$i;
						$pc = 'p0_'.$i;

						if (($row['issues'] < 3) && (strpos($mtz, ucfirst($get_range)) !== false)) {
							$mtgs_sat = 1;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_sat)) { ?> <p class="no-mtgs">No meetings posted for <?= $todayz ?>.</p> <?php } ?>
					
				<?php mysqli_free_result($subject_set); ?>
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