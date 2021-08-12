<?php if ($user_id == 1) { ?>

	<?php /* used for all other pages */ ?>
	<div class="daily-glance-wrap">
		<div class="daily-glance<?php if ($row['visible'] == 1 && (($row['admin'] != 1 || $row['admin'] != 2) && $row['id_user'] != $_SESSION['id']) ) { echo ' personal-other'; } if ($row['visible'] == 1 && ($row['admin'] == 1 || $row['admin'] == 2)) { echo ' personal-odin'; } ?>">
			<div class="glance-mtg glance-mtg-time">
				<p><?= date('g:i A', strtotime($row['meet_time'])); ?></p>
			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?= $row['group_name'] ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">
				<?php 


					if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2) { ?>
						
						<a class="manage-edit" href="user_role.php?id=<?= h(u($row['id_mtg'])) . '&user=' . h(u($row['id_user'])); ?>"><div class="tooltip"><span class="tooltiptext">Manage User</span><i class="far fas fa-user-cog"></i></div></a>

						<a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Edit Meeting</span><i class="far fa-edit"></i></div></a>

						<a class="manage-edit" href="transfer-meeting.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Transfer Meeting</span><i class="far fas fa-people-arrows"></i></div></a>

						<a class="manage-delete" href="manage_delete.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip right"><span class="tooltiptext">Delete Meeting</span><i class="far fas fa-minus-circle"></i></div></a>

					<?php } ?>
					
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>
	<?php } ?>

