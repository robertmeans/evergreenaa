<?php 
require_once 'config/initialize.php'; 

$layout_context = "home-public";

require '_includes/head.php'; ?>

<body>
<?php 
if (WWW_ROOT != 'http://localhost/evergreenaaa') { ?>
	<div class="preload"><p>One day at a time.</p></div>
<?php } ?>	

<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-set-timezone.php'; ?>
<?php require '_includes/msg-why-join.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="wrap">
	
<ul id="weekdays">

<?php  
	// this block only needed once for page
	$dt = new DateTime('now'); 
	$user_tz = new DateTimeZone($tz);
	$dt->setTimezone($user_tz);
	$offset = $dt->format('P'); // find offset +, - or = +00:00

	// get raw, UTC, data
	$subject_set = get_all_public_meetings();

	if ($offset == '+00:00') { 
		$time_offset = '00';
		$sorted = mysqli_fetch_all($subject_set, MYSQLI_ASSOC);
		} else if (strpos($offset, '+') !== false) { 
			$time_offset = 'pos';
			$results = mysqli_fetch_all($subject_set, MYSQLI_ASSOC);
		} else if (strpos($offset, '-') !== false) { 
			$time_offset = 'neg';
			$results = mysqli_fetch_all($subject_set, MYSQLI_ASSOC);
	}

if ($time_offset != '00') {
	$sorted = apply_offset_to_meetings($results, $tz, $time_offset);
}

?>

	<li class="ctr-day">
		<button id="open-sunday" class="day">Sunday</button>
		<div id="sunday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		<p class="inline-tz"><a class="inline-show-tz"><?php pretty_tz($tz); ?></span></a></p>

			<?php
				$today = 'Sunday';
				list($yesterday, $tomorrow, $y, $d, $t) = day_range($today);

			  $user_tz  = new DateTimeZone($tz); // -7/dst: -6
			  // $lc = substr($t, 0,3);

					$i = 1;
					foreach ($sorted as $row) {
				    $mt = new DateTime($row['meet_time']);
				    $mt->setTimezone($user_tz);

						$ic = 'i0_'.$i;
						$pc = 'p0_'.$i;

						if (($row['issues'] < 3) && ($row[$d] == '1')) {
							$mtgs_exist = $today;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap <?php if (!empty($row['add_note'])) { echo 'note-here'; } ?>">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_exist) || $mtgs_exist != $today) { ?> <p class="no-mtgs">No meetings posted for <?= $today . ' ' . $offset ?>.</p> <?php } ?>

		</div><!-- #sunday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-monday" class="day">Monday</button>
		<div id="monday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		<p class="inline-tz"><a class="inline-show-tz"><?php pretty_tz($tz); ?></span></a></p>
		
			<?php
				$today = 'Monday';
				list($yesterday, $tomorrow, $y, $d, $t) = day_range($today);

					$i = 1;
					foreach ($sorted as $row) {
				    $mt = new DateTime($row['meet_time']);
				    $mt->setTimezone($user_tz);

						$ic = 'i1_'.$i;
						$pc = 'p1_'.$i;

						if (($row['issues'] < 3) && ($row[$d] == '1')) {
							$mtgs_exist = $today;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap <?php if (!empty($row['add_note'])) { echo 'note-here'; } ?>">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_exist) || $mtgs_exist != $today) { ?> <p class="no-mtgs">No meetings posted for <?= $today ?>.</p> <?php } ?>

		</div><!-- #monday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-tuesday" class="day">Tuesday</button>
		<div id="tuesday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		<p class="inline-tz"><a class="inline-show-tz"><?php pretty_tz($tz); ?></span></a></p>
		
			<?php
				$today = 'Tuesday';
				list($yesterday, $tomorrow, $y, $d, $t) = day_range($today);

					$i = 1;
					foreach ($sorted as $row) { // AM meetings
				    $mt = new DateTime($row['meet_time']);
				    $mt->setTimezone($user_tz);

						$ic = 'i2_'.$i;
						$pc = 'p2_'.$i;

						if (($row['issues'] < 3) && ($row[$d] == '1')) {
							$mtgs_exist = $today;
							// echo $today . ' ' . $mtz;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap <?php if (!empty($row['add_note'])) { echo 'note-here'; } ?>">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_exist) || $mtgs_exist != $today) { ?> <p class="no-mtgs">No meetings posted for <?= $today ?>.</p> <?php } ?>

		</div><!-- #tuesday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-wednesday" class="day">Wednesday</button>
		<div id="wednesday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		<p class="inline-tz"><a class="inline-show-tz"><?php pretty_tz($tz); ?></span></a></p>
		
			<?php
				$today = 'Wednesday';
				list($yesterday, $tomorrow, $y, $d, $t) = day_range($today);

					$i = 1;
					foreach ($sorted as $row) {
				    $mt = new DateTime($row['meet_time']);
				    $mt->setTimezone($user_tz);

						$ic = 'i3_'.$i;
						$pc = 'p3_'.$i;

						if (($row['issues'] < 3) && ($row[$d] == '1')) {
							$mtgs_exist = $today;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap <?php if (!empty($row['add_note'])) { echo 'note-here'; } ?>">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_exist) || $mtgs_exist != $today) { ?> <p class="no-mtgs">No meetings posted for <?= $today ?>.</p> <?php } ?>

		</div><!-- #wednesday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-thursday" class="day">Thursday</button>
		<div id="thursday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		<p class="inline-tz"><a class="inline-show-tz"><?php pretty_tz($tz); ?></span></a></p>
		
			<?php
				$today = 'Thursday';
				list($yesterday, $tomorrow, $y, $d, $t) = day_range($today);

					$i = 1;
					foreach ($sorted as $row) {
				    $mt = new DateTime($row['meet_time']);
				    $mt->setTimezone($user_tz);

						$ic = 'i4_'.$i;
						$pc = 'p4_'.$i;

						if (($row['issues'] < 3) && ($row[$d] == '1')) {
							$mtgs_exist = $today;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap <?php if (!empty($row['add_note'])) { echo 'note-here'; } ?>">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_exist) || $mtgs_exist != $today) { ?> <p class="no-mtgs">No meetings posted for <?= $today ?>.</p> <?php } ?>

		</div><!-- #thursday-content .day-content -->
	</li>		

	<li class="ctr-day">
		<button id="open-friday" class="day">Friday</button>
		<div id="friday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		<p class="inline-tz"><a class="inline-show-tz"><?php pretty_tz($tz); ?></span></a></p>
		
			<?php
				$today = 'Friday';
				list($yesterday, $tomorrow, $y, $d, $t) = day_range($today);

					$i = 1;
					foreach ($sorted as $row) {
				    $mt = new DateTime($row['meet_time']);
				    $mt->setTimezone($user_tz);

						$ic = 'i5_'.$i;
						$pc = 'p5_'.$i;

						if (($row['issues'] < 3) && ($row[$d] == '1')) {
							$mtgs_exist = $today;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap <?php if (!empty($row['add_note'])) { echo 'note-here'; } ?>">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_exist) || $mtgs_exist != $today) { ?> <p class="no-mtgs">No meetings posted for <?= $today ?>.</p> <?php } ?>

		</div><!-- #friday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-saturday" class="day">Saturday</button>
		<div id="saturday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		<p class="inline-tz"><a class="inline-show-tz"><?php pretty_tz($tz); ?></span></a></p>
		
			<?php
				$today = 'Saturday';
				list($yesterday, $tomorrow, $y, $d, $t) = day_range($today);

					$i = 1;
					foreach ($sorted as $row) {
				    $mt = new DateTime($row['meet_time']);
				    $mt->setTimezone($user_tz);

						$ic = 'i6_'.$i;
						$pc = 'p6_'.$i;

						if (($row['issues'] < 3) && ($row[$d] == '1')) {
							$mtgs_exist = $today;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap <?php if (!empty($row['add_note'])) { echo 'note-here'; } ?>">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_exist) || $mtgs_exist != $today) { ?> <p class="no-mtgs">No meetings posted for <?= $today ?>.</p> <?php } ?>

				<?php mysqli_free_result($subject_set); ?>

		</div><!-- #saturday-content .day-content -->
	</li>

</ul><!-- #weekdays -->
</div><!-- #wrap -->

<?php require '_includes/footer.php'; ?>