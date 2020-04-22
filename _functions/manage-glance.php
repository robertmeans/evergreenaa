<?php

	$meeting_id = $row['id_mtg'];
	$user_id	= $row['id_user'];

	$sun		= $row['sun'];	
	$mon		= $row['mon'];
	$tue		= $row['tue'];
	$wed		= $row['wed'];
	$thu		= $row['thu'];
	$fri		= $row['fri'];
	$sat		= $row['sat'];


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

	<div class="manage-glance-wrap">
		<div class="manage-glance">
			<div class="glance-mtg glance-mtg-time">
				<p><?= $meetHour . ":" . $meetMin . " "?><?php if($amPM != 0) { ?>PM on <?php } else { ?>AM on <?php } 
				if ($row['sun'] != 0) { echo "Sun"; } 
				if (($row['sun'] != 0) && $row['mon'] != 0) { echo ", Mon"; } else if ($row['mon'] != 0) { echo "Mon"; }
				if (($row['mon'] != 0) && $row['tue'] != 0) { echo ", Tue"; } else if ($row['tue'] != 0) { echo "Tue"; }
				if (($row['tue'] != 0) && $row['wed'] != 0) { echo ", Wed"; } else if ($row['wed'] != 0) { echo "Wed"; }
				if (($row['wed'] != 0) && $row['thu'] != 0) { echo ", Thu"; } else if ($row['thu'] != 0) { echo "Thu"; }
				if (($row['thu'] != 0) && $row['fri'] != 0) { echo ", Fri"; } else if ($row['fri'] != 0) { echo "Fri"; }
				if (($row['fri'] != 0) && $row['sat'] != 0) { echo ", Sat"; } else if ($row['sat'] != 0) { echo "Sat"; }
				?></p>
			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?= $row['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">
				<p><?php if ($row['id_user'] == $_SESSION['id']) { echo "<i class=\"far fa-edit\"></i>"; } ?></p>
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>
