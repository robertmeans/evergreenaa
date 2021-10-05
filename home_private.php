<?php  
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

$layout_context = "home-private";

if (!isset($_SESSION['tz']) || !isset($_COOKIE['timezone'])) {
	setCookie('timezone', 'not-set', time() + (3650 * 24 * 60 * 60), '/'); // 10 years
	$cookie = 'not-set';
	$tz = 'America/Denver';
} elseif ($_COOKIE['timezone'] == 'not-set') {
	$cookie = 'not-set';
	$tz = 'America/Denver';
} elseif (isset($_SESSION['tz'])) {
	$tz = $_SESSION['tz'];	
	$cookie = $tz;
} 

if (isset($_SESSION['id'])) {
	$user_id = $_SESSION['id'];
	$user_role = $_SESSION['admin'];
} else {
	$user_id = 'ns';
	$user_role = '0';
}


if (is_post_request()) {
	if (isset($_POST['set-tz'])) {
		$timezone = $_POST['timezone'];

		$result = set_timezone($timezone, $user_id);

		if ($result === true) {
			setCookie('timezone', $timezone, time() + (3650 * 24 * 60 * 60), '/'); // 10 years
			$_SESSION['tz'] = $timezone;
		  header('location:' . WWW_ROOT);
		} else {
			$errors = $result;
		}
	}
}

require '_includes/head.php'; ?>

<body>
<?php 
if (WWW_ROOT != 'http://localhost/evergreenaa') { ?>
	<div class="preload"><p>One day at a time.</p></div>
<?php } ?>	
<?php 
if ($cookie == "not-set") { ?>
	<div class="set-tz">
		<div class="tz-box">
			<h3>Set Timezone</h3>
			<div class="tz-content">
				<p>Let's set the timezone for this website. I will try to remember your setting on this device. You can always change it in the future from the Menu.</p>
				<p class="next-p">Select your timezone:</p>
				<form action="" method="post">
					<select class="pick-tz" name="timezone">
						<option value="empty"><?php echo timezone_select_options(); ?></option>
					</select>
					<input type="submit" name="set-tz" value="OK">
				</form>
			</div>
		</div>
	</div>
<?php } ?>

<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-set-timezone.php'; ?>
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
				$today = 'Sunday';
				list($yesterday, $tomorrow) = day_range($today);
				$subject_set = get_all_public_and_private_meetings_for_today($user_id);

					$i = 1;
					foreach ($subject_set as $row) {
						$ey = $row[substr(lcfirst($yesterday), 0,3)];
						$et = $row[substr(lcfirst($today), 0,3)];
						$etm = $row[substr(lcfirst($tomorrow), 0,3)];
						$meet_time = $row['meet_time'];

						// $tz = $row['tz'];
						$mtz = convert_timezone($ey, $et, $etm, $meet_time, $yesterday, $today, $tomorrow, $tz);

						$ic = 'i0_'.$i;
						$pc = 'p0_'.$i;

						if (($row['issues'] < 3) && (strpos($mtz, substr(ucfirst($today), 0,3)) !== false)) {
							$mtgs_exist = $today;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_exist) || $mtgs_exist != $today) { ?> <p class="no-mtgs">No meetings posted for <?= $today ?>.</p> <?php } ?>
					
				<?php mysqli_free_result($subject_set); ?>

		</div><!-- #sunday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-monday" class="day">Monday</button>
		<div id="monday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$today = 'Monday';
				list($yesterday, $tomorrow) = day_range($today);
				$subject_set = get_all_public_and_private_meetings_for_today($user_id);

					$i = 1;
					foreach ($subject_set as $row) {
						$ey = $row[substr(lcfirst($yesterday), 0,3)];
						$et = $row[substr(lcfirst($today), 0,3)];
						$etm = $row[substr(lcfirst($tomorrow), 0,3)];
						$meet_time = $row['meet_time'];

						// $tz = $row['tz'];
						$mtz = convert_timezone($ey, $et, $etm, $meet_time, $yesterday, $today, $tomorrow, $tz);

						$ic = 'i1_'.$i;
						$pc = 'p1_'.$i;

						if (($row['issues'] < 3) && (strpos($mtz, substr(ucfirst($today), 0,3)) !== false)) {
							$mtgs_exist = $today;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_exist) || $mtgs_exist != $today) { ?> <p class="no-mtgs">No meetings posted for <?= $today ?>.</p> <?php } ?>
					
				<?php mysqli_free_result($subject_set); ?>
		</div><!-- #monday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-tuesday" class="day">Tuesday</button>
		<div id="tuesday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$today = 'Tuesday';
				list($yesterday, $tomorrow) = day_range($today);
				$subject_set = get_all_public_and_private_meetings_for_today($user_id);

					$i = 1;
					foreach ($subject_set as $row) {
						$ey = $row[substr(lcfirst($yesterday), 0,3)];
						$et = $row[substr(lcfirst($today), 0,3)];
						$etm = $row[substr(lcfirst($tomorrow), 0,3)];
						$meet_time = $row['meet_time'];

						// $tz = $row['tz'];
						$mtz = convert_timezone($ey, $et, $etm, $meet_time, $yesterday, $today, $tomorrow, $tz);

						$ic = 'i2_'.$i;
						$pc = 'p2_'.$i;

						if (($row['issues'] < 3) && (strpos($mtz, substr(ucfirst($today), 0,3)) !== false)) {
							$mtgs_exist = $today;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_exist) || $mtgs_exist != $today) { ?> <p class="no-mtgs">No meetings posted for <?= $today ?>.</p> <?php } ?>
					
				<?php mysqli_free_result($subject_set); ?>
		</div><!-- #tuesday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-wednesday" class="day">Wednesday</button>
		<div id="wednesday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$today = 'Wednesday';
				list($yesterday, $tomorrow) = day_range($today);
				$subject_set = get_all_public_and_private_meetings_for_today($user_id);

					$i = 1;
					foreach ($subject_set as $row) {
						$ey = $row[substr(lcfirst($yesterday), 0,3)];
						$et = $row[substr(lcfirst($today), 0,3)];
						$etm = $row[substr(lcfirst($tomorrow), 0,3)];
						$meet_time = $row['meet_time'];

						// $tz = $row['tz'];
						$mtz = convert_timezone($ey, $et, $etm, $meet_time, $yesterday, $today, $tomorrow, $tz);

						$ic = 'i3_'.$i;
						$pc = 'p3_'.$i;

						if (($row['issues'] < 3) && (strpos($mtz, substr(ucfirst($today), 0,3)) !== false)) {
							$mtgs_exist = $today;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_exist) || $mtgs_exist != $today) { ?> <p class="no-mtgs">No meetings posted for <?= $today ?>.</p> <?php } ?>
					
				<?php mysqli_free_result($subject_set); ?>
		</div><!-- #wednesday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-thursday" class="day">Thursday</button>
		<div id="thursday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$today = 'Thursday';
				list($yesterday, $tomorrow) = day_range($today);
				$subject_set = get_all_public_and_private_meetings_for_today($user_id);

					$i = 1;
					foreach ($subject_set as $row) {
						$ey = $row[substr(lcfirst($yesterday), 0,3)];
						$et = $row[substr(lcfirst($today), 0,3)];
						$etm = $row[substr(lcfirst($tomorrow), 0,3)];
						$meet_time = $row['meet_time'];

						// $tz = $row['tz'];
						$mtz = convert_timezone($ey, $et, $etm, $meet_time, $yesterday, $today, $tomorrow, $tz);

						$ic = 'i4_'.$i;
						$pc = 'p4_'.$i;

						if (($row['issues'] < 3) && (strpos($mtz, substr(ucfirst($today), 0,3)) !== false)) {
							$mtgs_exist = $today;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_exist) || $mtgs_exist != $today) { ?> <p class="no-mtgs">No meetings posted for <?= $today ?>.</p> <?php } ?>
					
				<?php mysqli_free_result($subject_set); ?>
		</div><!-- #thursday-content .day-content -->
	</li>		

	<li class="ctr-day">
		<button id="open-friday" class="day">Friday</button>
		<div id="friday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$today = 'Friday';
				list($yesterday, $tomorrow) = day_range($today);
				$subject_set = get_all_public_and_private_meetings_for_today($user_id);

					$i = 1;
					foreach ($subject_set as $row) {
						$ey = $row[substr(lcfirst($yesterday), 0,3)];
						$et = $row[substr(lcfirst($today), 0,3)];
						$etm = $row[substr(lcfirst($tomorrow), 0,3)];
						$meet_time = $row['meet_time'];

						// $tz = $row['tz'];
						$mtz = convert_timezone($ey, $et, $etm, $meet_time, $yesterday, $today, $tomorrow, $tz);

						$ic = 'i5_'.$i;
						$pc = 'p5_'.$i;

						if (($row['issues'] < 3) && (strpos($mtz, substr(ucfirst($today), 0,3)) !== false)) {
							$mtgs_exist = $today;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_exist) || $mtgs_exist != $today) { ?> <p class="no-mtgs">No meetings posted for <?= $today ?>.</p> <?php } ?>
					
				<?php mysqli_free_result($subject_set); ?>
		</div><!-- #friday-content .day-content -->
	</li>

	<li class="ctr-day">
		<button id="open-saturday" class="day">Saturday</button>
		<div id="saturday-content" class="day-content">
		<?php include '_includes/collapse-day.php'; ?>
		
			<?php
				$today = 'Saturday';
				list($yesterday, $tomorrow) = day_range($today);
				$subject_set = get_all_public_and_private_meetings_for_today($user_id);

					$i = 1;
					foreach ($subject_set as $row) {
						$ey = $row[substr(lcfirst($yesterday), 0,3)];
						$et = $row[substr(lcfirst($today), 0,3)];
						$etm = $row[substr(lcfirst($tomorrow), 0,3)];
						$meet_time = $row['meet_time'];

						// $tz = $row['tz'];
						$mtz = convert_timezone($ey, $et, $etm, $meet_time, $yesterday, $today, $tomorrow, $tz);

						$ic = 'i6_'.$i;
						$pc = 'p6_'.$i;

						if (($row['issues'] < 3) && (strpos($mtz, substr(ucfirst($today), 0,3)) !== false)) {
							$mtgs_exist = $today;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
								<?php require '_includes/meeting-details.php'; ?>
							</div><!-- .weekday-wrap -->
						<?php } 

					$i++; } if (!isset($mtgs_exist) || $mtgs_exist != $today) { ?> <p class="no-mtgs">No meetings posted for <?= $today ?>.</p> <?php } ?>
					
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