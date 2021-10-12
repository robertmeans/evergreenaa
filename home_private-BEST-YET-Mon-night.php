<?php  
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';
require_once '_includes/set_timezone.php';

$layout_context = "home-private";

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
				<p>Let's set your timezone for this website. I will try to remember your setting on this device. You can always change it in the future from the Menu.</p>
				<p class="next-p">Select your timezone:</p>
				<form id="init-set-tz" action="" method="post">
					<select id="init-tz-select" class="pick-tz" name="timezone">
						<option value="empty"><?php echo timezone_select_options(); ?></option>
					</select>
					<input type="hidden" name="set-tz">
					<div id="init-pick-tz"></div>
					<a id="init-tz-submit" class="btn">OK</a>
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
















<?php  
	// this block only needed once for page
	$dt = new DateTime('now'); 
	$user_tz = new DateTimeZone($tz);
	$dt->setTimezone($user_tz);
	$offset = $dt->format('P'); // find offset +, - or = +00:00

	// get raw, UTC, data
	$subject_set = get_it($user_id);

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





function apply_neg_offset_to_meetings($results, $tz) {
  // $utc = 'UTC';

	foreach($results as $k=>$v) {
	  $from_tz_obj = new DateTimeZone('UTC');
	  $to_tz_obj = new DateTimeZone($tz);

    $cfoo = new DateTime($v['meet_time'], $from_tz_obj);
    $cfoo->setTimezone($to_tz_obj);

	  if ($v['sun'] == '1') {

	    $csun = new DateTime('Sunday ' . $v['meet_time'], $from_tz_obj);
	    $csun->setTimezone($to_tz_obj);
	    $nsun = $csun->format('l Hi');

	    if (strpos($nsun, 'Saturday') !== false) { 
	    	$results[$k]['sat'] = '1';
	    } else {
	    	$results[$k]['sat'] = '0';
	    }
	    if (strpos($nsun, 'Sunday') !== false) {  
	    	$results[$k]['sun'] = '1';
	    } else {
	    	$results[$k]['sun'] = '0';
	    }   
	    if (strpos($nsun, 'Monday') !== false) { 
	    	$results[$k]['mon'] = '1';
	    } else {
	    	$results[$k]['mon'] = '0';
	    }
	  }

	  if ($v['mon'] == '1') {
	
	    $cmon = new DateTime('Monday ' . $v['meet_time'], $from_tz_obj);
	    $cmon->setTimezone($to_tz_obj);
	    $nmon = $cmon->format('l Hi');

	    if (strpos($nmon, 'Sunday') !== false) { 
	    	$results[$k]['sun'] = '1';
	    } else {
	    	$results[$k]['sun'] = '0';
	    }
	    if (strpos($nmon, 'Monday') !== false) {  
	    	$results[$k]['mon'] = '1';
	    } else {
	    	$results[$k]['mon'] = '0';
	    }    
	    if (strpos($nmon, 'Tuesday') !== false) { 
	    	$results[$k]['tue'] = '1';
	    } else {
	    	$results[$k]['tue'] = '0';
	    }
	  }

	  if ($v['tue'] == '1') {  	

	    $ctue = new DateTime('Tuesday ' . $v['meet_time'], $from_tz_obj);
	    $ctue->setTimezone($to_tz_obj);
	    $ntue = $ctue->format('l Hi');

	    if (strpos($ntue, 'Monday') !== false) { 
	    	$results[$k]['mon'] = '1';
	    } else {
	    	$results[$k]['mon'] = '0';
	    }
	    if (strpos($ntue, 'Tuesday') !== false) {  
	    	$results[$k]['tue'] = '1';
	    } else {
	    	$results[$k]['tue'] = '0';
	    }    
	    if (strpos($ntue, 'Wednesday') !== false) { 
	    	$results[$k]['wed'] = '1';
	    } else {
	    	$results[$k]['wed'] = '0';
	    }
	  } 

	  if ($v['wed'] == '1') {

	    $cwed = new DateTime('Wednesday ' . $v['meet_time'], $from_tz_obj);
	    $cwed->setTimezone($to_tz_obj);
	    $nwed = $cwed->format('l Hi');

	  	// if ($v['group_name'] == 'Upon Awakening -15 minute Steps 10&11 Workshop') {
	  	// 	echo $nwed;
	  	// }

	    if (strpos($nwed, 'Tuesday') !== false) {  
	    	$results[$k]['tue'] = '1';
	    } else {
	    	$results[$k]['tue'] = '0';
	    }    
	    if (strpos($nwed, 'Wednesday') !== false) { 
	    	$results[$k]['wed'] = '1';
	    } else {
	    	$results[$k]['wed'] = '0';
	    }
	    if (strpos($nwed, 'Thursday') !== false) { 
	    	$results[$k]['thu'] = '1';
	    } else {
	    	$results[$k]['thu'] = '0';
	    }	    
	  }

	  if ($v['thu'] == '1') {

	    $cthu = new DateTime('Thursday ' . $v['meet_time'], $from_tz_obj);
	    $cthu->setTimezone($to_tz_obj);
	    $nthu = $cthu->format('l Hi');
   
	  	// if ($v['group_name'] == 'Upon Awakening -15 minute Steps 10&11 Workshop') {
	  	// 	echo $nthu;
	  	// }

	    if (strpos($nthu, 'Wednesday') !== false) { 
	    	$results[$k]['wed'] = '1';
	    } else {
	    	$results[$k]['wed'] = '0';
	    }
	    if (strpos($nthu, 'Thursday') !== false) { 
	    	$results[$k]['thu'] = '1';
	    } else {
	    	$results[$k]['thu'] = '0';
	    }
	    if (strpos($nthu, 'Friday') !== false) {  
	    	$results[$k]['fri'] = '1';
	    } else {
	    	$results[$k]['fri'] = '0';
	    } 	    	    
	  }	  

	  if ($v['fri'] == '1') {

	    $cfri = new DateTime('Friday ' . $v['meet_time'], $from_tz_obj);
	    $cfri->setTimezone($to_tz_obj);
	    $nfri = $cfri->format('l Hi');

	    if (strpos($nfri, 'Thursday') !== false) { 
	    	$results[$k]['thu'] = '1';
	    } else {
	    	$results[$k]['thu'] = '0';
	    }
	    if (strpos($nfri, 'Friday') !== false) {  
	    	$results[$k]['fri'] = '1';
	    } else {
	    	$results[$k]['fri'] = '0';
	    } 
	    if (strpos($nfri, 'Saturday') !== false) { 
	    	$results[$k]['sat'] = '1';
	    } else {
	    	$results[$k]['sat'] = '0';
	    }	    	    	    
	  }

	  if ($v['sat'] == '1') {

	    $csat = new DateTime('Saturday ' . $v['meet_time'], $from_tz_obj);
	    $csat->setTimezone($to_tz_obj);
	    $nsat = $csat->format('l Hi');
   
	    if (strpos($nsat, 'Friday') !== false) {  
	    	$results[$k]['fri'] = '1';
	    } else {
	    	$results[$k]['fri'] = '0';
	    } 
	    if (strpos($nsat, 'Saturday') !== false) { 
	    	$results[$k]['sat'] = '1';
	    } else {
	    	$results[$k]['sat'] = '0';
	    }	
	    if (strpos($nsat, 'Sunday') !== false) { 
	    	$results[$k]['sun'] = '1';
	    } else {
	    	$results[$k]['sun'] = '0';
	    }	        	    	    
	  }

	  $v['meet_time'] = $cfoo->format('Hi');

		// by here have meet_time and days updated in array
		$b[] = $v['meet_time'] . ' ' . $v['group_name'];

		// testing
		// $b[] = $v['meet_time'] . ' ' . $v['group_name'] . ' ' . $v['sun'] . ' ' . $v['mon'] . ' ' . $v['tue'] . ' ' . $v['wed'] . ' ' . $v['thu'] . ' ' . $v['fri'] . ' ' . $v['sat'];
		// echo "<pre style=\"font-size:1em;color:green;\">" . print_r($b) . "</pre>";
	}
	asort($b);

	foreach ($b as $k=>$v) {
		$c[] = $results[$k];
	}

	// echo '<pre style="font-size:1em;color:green;">' . print_r($c) . '</pre>';
	// echo print_r($c);

	return $c;

}



if ($time_offset != '00') {
	$sorted = apply_neg_offset_to_meetings($results, $tz);
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
				    $mt = new DateTime($today . ' ' . $row['meet_time']);
				    $mt->setTimezone($user_tz);
				    $mtz = $mt->format('D g:i A');

						$ic = 'i0_'.$i;
						$pc = 'p0_'.$i;

						if (($row['issues'] < 3) && ($row[$d] == '1')) {
							$mtgs_exist = $today;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
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
				    $mt = new DateTime($today . ' ' . $row['meet_time']);
				    $mt->setTimezone($user_tz);
				    $mtz = $mt->format('D g:i A');

						$ic = 'i1_'.$i;
						$pc = 'p1_'.$i;

						if (($row['issues'] < 3) && ($row[$d] == '1')) {
							$mtgs_exist = $today;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
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
				    $mt = new DateTime($today . ' ' . $row['meet_time']);
				    $mt->setTimezone($user_tz);
				    $mtz = $mt->format('D g:i A');

						$ic = 'i2_'.$i;
						$pc = 'p2_'.$i;

						if (($row['issues'] < 3) && ($row[$d] == '1')) {
							$mtgs_exist = $today;
							// echo $today . ' ' . $mtz;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
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
				    $mt = new DateTime($today . ' ' . $row['meet_time']);
				    $mt->setTimezone($user_tz);
				    $mtz = $mt->format('D g:i A');

						$ic = 'i3_'.$i;
						$pc = 'p3_'.$i;

						if (($row['issues'] < 3) && ($row[$d] == '1')) {
							$mtgs_exist = $today;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
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
				    $mt = new DateTime($today . ' ' . $row['meet_time']);
				    $mt->setTimezone($user_tz);
				    $mtz = $mt->format('D g:i A');

						$ic = 'i4_'.$i;
						$pc = 'p4_'.$i;

						if (($row['issues'] < 3) && ($row[$d] == '1')) {
							$mtgs_exist = $today;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
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
				    $mt = new DateTime($today . ' ' . $row['meet_time']);
				    $mt->setTimezone($user_tz);
				    $mtz = $mt->format('D g:i A');

						$ic = 'i5_'.$i;
						$pc = 'p5_'.$i;

						if (($row['issues'] < 3) && ($row[$d] == '1')) {
							$mtgs_exist = $today;
							require '_includes/daily-glance.php'; ?>
							<div class="weekday-wrap">
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
				    $mt = new DateTime($today . ' ' . $row['meet_time']);
				    $mt->setTimezone($user_tz);
				    $mtz = $mt->format('D g:i A');

						$ic = 'i6_'.$i;
						$pc = 'p6_'.$i;

						if (($row['issues'] < 3) && ($row[$d] == '1')) {
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