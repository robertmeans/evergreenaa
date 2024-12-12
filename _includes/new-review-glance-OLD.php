
	<div class="manage-glance-wrap-review">
		<div class="manage-glance-review<?php if ($row['visible'] == 0) { echo ' draft'; }  ?>">
			<div class="glance-mtg glance-mtg-time">
				<p><?php  
					$nt = format_time($row['meet_time']);  
          echo $nt . ' - '; print_day($row); echo '&nbsp; <span class="gtz">['; pretty_tz($row['mtg_tz']); echo ']</span>';  
        ?></p>

			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?php if ($row['meet_url'] != null) { echo '<div class="tooltip"><span class="tooltiptext">Zoom Meeting</span><i class="fas fa-video fa-fw"></i></div>'; } if ($row['meet_addr'] != null) { echo '<div class="tooltip"><span class="tooltiptext">In-Person Meeting</span><i class="fas fa-map-marker-alt fa-fw"></i></div>'; }  ?>
				<?= $row['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">
				<p><?php if ($row['id_user'] == $_SESSION['id']) { ?>
					<a class="manage-edit" href="manage_edit.php?id=<?= h(u($id)); ?>"><i class="far fa-edit"></i></a>
					<a class="manage-delete" href="manage_delete.php?id=<?= h(u($row['id_mtg'])); ?>"><i class="fas fa-minus-circle"></i></a>
				<?php } ?></p>
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>
