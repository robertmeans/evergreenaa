<?php  
// echo date('l Hi');






function tz($subject_set, $tz) {

// list($ct, $sun, $mon, $tue, $wed, $thu, $fri, $sat) = figger_it_outz($time);

	foreach($subject_set as $k=>$v) {
		$time = [];
		$time['tz'] = $tz;
		if ($k == 'sun') { $time['sun'] = $v; }
		if ($k == 'mon') { $time['mon'] = $v; }
		if ($k == 'tue') { $time['tue'] = $v; }
		if ($k == 'wed') { $time['wed'] = $v; }
		if ($k == 'thu') { $time['thu'] = $v; }
		if ($k == 'fri') { $time['fri'] = $v; }
		if ($k == 'sat') { $time['sat'] = $v; }
		if ($k == 'meet_time') { $time['meet_time'] = $v;	}
 	}	return $time;

 	list($ct, $sun, $mon, $tue, $wed, $thu, $fri, $sat) = figger_it_outz($time);

}





$user_management_list = find_all_users_to_manage($user_id);
$subject_set = mysqli_fetch_all($user_management_list, MYSQLI_ASSOC);

$sorted = tz($subject_set);

foreach ($sorted as $row) {
	// everything...
	require '_includes/daily-glance.php'; ?>
	<div class="weekday-wrap">
		<?php require '_includes/meeting-details.php'; ?>
	</div><!-- .weekday-wrap -->	
}