<?php

	$meeting_id = $row['id_user'];
	$mon		= $row['mon'];
	$tue		= $row['tue'];
	$wed		= $row['wed'];
	$thu		= $row['thu'];
	$fri		= $row['fri'];
	$sat		= $row['sat'];
	$sun		= $row['sun'];
	$meetTime	= $row['meet_time'];
	$meetHour	= $row['meet_hour'];
	$meetMin	= $row['meet_min'];
	$amPM		= $row['am_pm'];
	$groupName	= $row['group_name'];
	$open		= $row['code_o'];
	$womens		= $row['code_w'];
	$closed		= $row['code_c'];
	$mens		= $row['code_m'];

?>

	<div class="daily-glance-wrap">
		<div class="daily-glance">
			<div class="glance-mtg glance-mtg-time">
				<p><?= $meetHour . ":" . $meetMin . " "?><?php if($amPM != 0) { ?>PM <?php } else { ?>AM <?php } ?><?= $today ?></p>
			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?= $groupName; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">
				<p><?php if ($open != 0) { echo 'Open meeting'; } else if ($womens != 0) { echo 'Women\'s meeting'; } else if ($mens != 0) { echo 'Men\'s meeting'; } else { echo 'Join us'; } ?></p>
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>


	


	<?php //if ($womens != 0) { echo 'Women\'s meeting'; break; } ?>
	<?php //if ($mens != 0) { echo 'Men\'s meeting'; break; } ?> 