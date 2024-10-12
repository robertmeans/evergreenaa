
	<div class="manage-glance-wrap">
		<div class="manage-glance<?php if ($row['visible'] == 0) { echo ' draft'; } if ($row['visible'] == 1) { echo ' personal'; } if ($row['issues'] > 0) { echo ' got-issues'; } ?>">
			<div class="glance-mtg glance-mtg-time">
				<p><?php  
					$nt = format_time($row['meet_time']);  
					echo $nt . ' - '; print_day($row); echo '&nbsp; <span class="gtz">['; pretty_tz($row['mtg_tz']); echo ']</span>'; 
        ?></p>
			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?php if ($row['meet_url'] != null) { echo '<div class="tooltip"><span class="tooltiptext">Zoom Meeting</span><i class="fas fa-video fa-fw"></i></div>'; } if ($row['meet_addr'] != null) { echo '<div class="tooltip"><span class="tooltiptext">In-Person Meeting</span><i class="fas fa-map-marker-alt fa-fw"></i></div>'; }  ?>
				<?php 
				if ($row['visible'] == 0) { echo ' [DRAFT] '; }
				if ($row['visible'] == 1) { echo ' [PRIVATE] '; }  
				if ($row['visible'] == 2) { echo ' [MEMBERS] '; } // Members only
				if ($row['visible'] == 3) { echo ' [PUBLIC] '; }
				?><?= $row['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">
				<?php if (($row['id_user'] == $_SESSION['id']) || $_SESSION['admin'] == "1") { ?>

				<a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Edit Meeting</span><i class="far fa-edit"></i></div></a>

				<a class="manage-edit" href="transfer-meeting.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Transfer Meeting</span><i class="fas fa-people-arrows"></i></div></a>

				<a class="manage-delete" href="manage_delete.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip right"><span class="tooltiptext">Delete Meeting</span><i class="fas fa-minus-circle"></i></div></a>

			<?php } ?>
			
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>
