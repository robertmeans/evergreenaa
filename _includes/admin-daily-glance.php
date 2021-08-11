<?php if (isset($_SESSION['id'])) { ?>

<?php // user is logged in, show them their Private (1's) and Members (2's) and Public (3's) meetings
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
				<?php 

			if (($row['id_user'] == $_SESSION['id']) || ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2)) { ?>

				<?php if ($row['id_user'] != $user_id) { ?>
					<a class="manage-edit" href="user_role.php?id=<?= h(u($row['id_mtg'])) . '&user=' . h(u($row['id_user'])); ?>"><div class="tooltip"><span class="tooltiptext">Manage User</span><i class="far fas fa-user-cog"></i></div></a>
				<?php } ?>

				<a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Edit Meeting</span><i class="far fa-edit"></i></div></a>

				<a class="manage-edit" href="host-management.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Transfer Meeting</span><i class="far fas fa-people-arrows"></i></div></a>

				<a class="manage-delete" href="manage_delete.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip right"><span class="tooltiptext">Delete Meeting</span><i class="far fas fa-minus-circle"></i></div></a>

			<?php } ?>
					
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>

<?php // user is logged in. show them other people's Members (2's) and Public (3's) meetings ?>
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
				<?php 

			if (($row['id_user'] == $_SESSION['id']) || ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2)) { ?>

				<a class="manage-edit" href="user_role.php?id=<?= h(u($row['id_mtg'])) . '&user=' . h(u($row['id_user'])); ?>"><div class="tooltip"><span class="tooltiptext">Manage User</span><i class="far fas fa-user-cog"></i></div></a>

				<a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Edit Meeting</span><i class="far fa-edit"></i></div></a>

				<a class="manage-edit" href="host-management.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Transfer Meeting</span><i class="far fas fa-people-arrows"></i></div></a>

				<?php /*
				<a class="manage-delete" href="manage_delete.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip right"><span class="tooltiptext">Delete Meeting</span><i class="far fas fa-minus-circle"></i></div></a>
				*/ ?>

			<?php } ?>
					
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>
<?php } ?>

<?php /* no session id set - general public - only show public (3's) meetings */ ?>
<?php } ?>
					
