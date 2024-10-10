
	<div class="manage-glance-wrap-review">
		<div class="manage-glance-review<?php if ($row['visible'] == 0) { echo ' draft'; }  ?>">
			<div class="glance-mtg glance-mtg-time">
				<p><?php  
					$time = $row['meet_time'];
					$nt = converted_time($time, $tz); 
					echo $nt . ' - '; print_day($row); ?></p>

			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?php if ($row['meet_url'] != null) { echo '<div class="tooltip"><span class="tooltiptext">Zoom Meeting</span><i class="fas fa-video fa-fw"></i></div>'; } if ($row['meet_addr'] != null) { echo '<div class="tooltip"><span class="tooltiptext">In-Person Meeting</span><i class="fas fa-map-marker-alt fa-fw"></i></div>'; }  ?>
				<?php 
				// if ($row['visible'] == 0) { echo ' [DRAFT] '; }
				// if ($row['visible'] == 1) { echo ' [PRIVATE] '; }  
				// if ($row['visible'] == 2) { echo ' [PUBLIC] '; }
				?><?= $row['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">
				<p><?php if ($row['id_user'] == $_SESSION['id']) { ?>
					<a class="manage-edit" href="manage_edit.php?id=<?= h(u($id)); ?>"><i class="far fa-edit"></i></a>
					<a class="manage-delete" href="manage_delete.php?id=<?= h(u($row['id_mtg'])); ?>"><i class="fas fa-minus-circle"></i></a>
				<?php } ?></p>
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>
