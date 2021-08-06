<?php if (isset($_SESSION['id'])) { ?>

<?php
	if ((($row['id_user']) == $_SESSION['id']) && (($row['visible'] == 1) || ($row['visible'] == 2) || ($row['visible'] == 3))) { ?>

	<div class="daily-glance-wrap">
		<div class="daily-glance<?php if ($row['visible'] == 0) { echo ' draft'; } if ($row['visible'] == 1) { echo ' personal'; }  ?>">
			<div class="glance-mtg glance-mtg-time">
				<p><?= date('g:i A', strtotime($row['meet_time'])); ?></p>
			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?= $row['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">
				<p><?php 

				if (isset($_SESSION['id'])) {
					if (($row['id_user'] == $_SESSION['id']) || $_SESSION['id'] == "1") { 

						?>
						<a class="manage-edit" href="suspend_user.php?id=<?= h(u($row['id_mtg'])) . '&user=' . h(u($row['id_user'])); ?>"><i class="far fas fa-user-times"></i></a>

						<a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><i class="far fa-edit"></i></a>

						<a class="manage-edit" href="host-management.php?id=<?= h(u($row['id_mtg'])); ?>"><i class="fas fa-user-friends"></i></a>

						<a class="manage-delete" href="manage_delete.php?id=<?= h(u($row['id_mtg'])); ?>"><i class="fas fa-minus-circle"></i></a>

					<?php }
					} ?>
					
				</p>
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>

<?php } else if ((($row['id_user']) != $_SESSION['id']) && ((($row['visible'] == 2) || ($row['visible'] == 3)))) { ?>

	<div class="daily-glance-wrap">
		<div class="daily-glance<?php if ($row['visible'] == 0) { echo ' draft'; } if ($row['visible'] == 1) { echo ' personal'; }  ?>">
			<div class="glance-mtg glance-mtg-time">
				<p><?= date('g:i A', strtotime($row['meet_time'])); ?></p>
			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?= $row['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">
				<p><?php 

				if (isset($_SESSION['id'])) {
					if (($row['id_user'] == $_SESSION['id']) || $_SESSION['id'] == "1") { 

						?>
						<a class="manage-edit" href="suspend_user.php?id=<?= h(u($row['id_mtg'])) . '&user=' . h(u($row['id_user'])); ?>"><i class="far fas fa-user-times"></i></a>

						<a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><i class="far fa-edit"></i></a>

						<a class="manage-edit" href="host-management.php?id=<?= h(u($row['id_mtg'])); ?>"><i class="fas fa-user-friends"></i></a>

						<a class="manage-delete" href="manage_delete.php?id=<?= h(u($row['id_mtg'])); ?>"><i class="fas fa-minus-circle"></i></a>

					<?php }
					} ?>
					
				</p>
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>
<?php } ?>

<?php /* no session id set - general public */ ?>
<?php } else if  (($row['visible'] != 0) && ($row['visible'] != 1) && ($row['visible'] != 2)) { ?>	

	<div class="daily-glance-wrap">
		<div class="daily-glance<?php if ($row['visible'] == 0) { echo ' draft'; } if ($row['visible'] == 1) { echo ' personal'; }  ?>">
			<div class="glance-mtg glance-mtg-time">
				<p><?= date('g:i A', strtotime($row['meet_time'])); ?></p>
			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?= $row['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">
				<p><?php /* if ($row['meet_url'] != null) { echo '<div class="tooltip"><span class="tooltiptext">Zoom Meeting</span><i class="fas fa-video fa-fw"></i></div>'; } if ($row['meet_addr'] != null) { echo '<div class="tooltip"><span class="tooltiptext">In-Person Meeting</span><i class="fas fa-map-marker-alt fa-fw"></i></div>'; }  ?><?php if ($row['code_o'] != 0) { echo 'Open meeting'; } else if ($row['code_w'] != 0) { echo 'Women\'s meeting'; } else if ($row['code_m'] != 0) { echo 'Men\'s meeting'; } else { echo 'Join us'; } */ ?> <?php 

				if (isset($_SESSION['id'])) {
					if (($row['id_user'] == $_SESSION['id']) || $_SESSION['id'] == "1") { 

						?>
						<a class="manage-edit" href="suspend_user.php?id=<?= h(u($row['id_mtg'])) . '&user=' . h(u($row['id_user'])); ?>"><i class="far fas fa-user-times"></i></a>

						<a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><i class="far fa-edit"></i></a>

						<a class="manage-edit" href="host-management.php?id=<?= h(u($row['id_mtg'])); ?>"><i class="fas fa-user-friends"></i></a>

						<a class="manage-delete" href="manage_delete.php?id=<?= h(u($row['id_mtg'])); ?>"><i class="fas fa-minus-circle"></i></a>

					<?php }
					} ?>
					
				</p>
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>

<?php } ?>