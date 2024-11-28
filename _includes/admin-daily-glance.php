<?php // ODIN'S version ?>
<?php if ($_SESSION['admin'] == 1) { ?>
<div class="daily-glance-wrap">
  <input type="hidden" data-role="mtg-id" value="<?= $row['id_mtg']; ?>">
  <input type="hidden" data-role="hid" value="<?= $row['id_user']; ?>">
  <input type="hidden" data-role="mtgdz" value="<?= $row['sun'].$row['mon'].$row['tue'].$row['wed'].$row['thu'].$row['fri'].$row['sat']; ?>">
  <input type="hidden" data-role="mtg-day" value="<?= $today; ?>">
	<div class="daily-glance<?php if ($row['visible'] == 1 && (($row['admin'] != 1 || $row['admin'] != 2) && $row['id_user'] != $_SESSION['id']) ) { echo ' personal-other'; } if ($row['visible'] == 1 && ($row['admin'] == 1 || $row['admin'] == 2)) { echo ' personal-odin'; } ?>">
		<div class="glance-mtg glance-mtg-time">
			<p><?= $mt->format('g:i') ?> <span data-ampm='<?= $mt->format('A') ?>'><?= $mt->format('A') ?></span></p>
		</div><!-- .glance-time-day -->
		<div class="glance-mtg glance-group-title">
			<p><?= $row['group_name'] ?></p>
		</div><!-- .glance-group -->
		<div class="glance-mtg glance-mtg-type">
			
		<?php if ($row['id_user'] != 1) { ?>
			<a class="manage-edit" href="user_role.php?id=<?= h(u($row['id_mtg'])) . '&user=' . h(u($row['id_user'])); ?>"><div class="tooltip"><span class="tooltiptext">Manage User</span><i class="far fas fa-user-cog"></i></div></a>
		<?php } else { ?>
			<a class="manage-edit my-stuff"><div class="tooltip"><span class="tooltiptext">My Stuff</span><i class="far fas fa-user-cog"></i></div></a>
		<?php } ?>
			<a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Edit Meeting</span><i class="far fa-edit"></i></div></a>

			<a class="manage-edit" href="transfer-meeting.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Transfer Meeting</span><i class="far fas fa-people-arrows"></i></div></a>

			<a class="manage-delete" href="manage_delete.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip right"><span class="tooltiptext">Delete Meeting</span><i class="far fas fa-minus-circle"></i></div></a>
	

		</div><!-- .glance-mtg-type -->
	</div><!-- .daily-glance -->
</div>

<?php } else { ?>

<?php // show THEIR MEETINGS
	if ($row['id_user'] == $_SESSION['id']) { ?>

	<div class="daily-glance-wrap">
    <input type="hidden" data-role="mtg-id" value="<?= $row['id_mtg']; ?>">
    <input type="hidden" data-role="hid" value="<?= $row['id_user']; ?>">
    <input type="hidden" data-role="mtgdz" value="<?= $row['sun'].$row['mon'].$row['tue'].$row['wed'].$row['thu'].$row['fri'].$row['sat']; ?>">
    <input type="hidden" data-role="mtg-day" value="<?= $today; ?>">
		<div class="daily-glance<?php if ($row['visible'] == 0) { echo ' draft'; } if ($row['visible'] == 1) { echo ' personal'; }  ?>">
			<div class="glance-mtg glance-mtg-time">
				<p><?= $mt->format('g:i') ?>&nbsp;<span data-ampm='<?= $mt->format('A') ?>'><?= $mt->format('A') ?></span></p>
			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?= $row['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">

				<a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Edit my meeting</span><i class="far fa-edit"></i></div></a>

				<a class="manage-edit" href="transfer-meeting.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Transfer my meeting</span><i class="far fas fa-people-arrows"></i></div></a>

				<a class="manage-delete" href="manage_delete.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip right"><span class="tooltiptext">Delete my meeting</span><i class="far fas fa-minus-circle"></i></div></a>
	
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>

<?php // show OTHER PEOPLE'S MEETINGS ?>
<?php } else if (($row['id_user'] != $_SESSION['id']) && ($row['visible'] == 2 || $row['visible'] == 3)) { ?>

	<div class="daily-glance-wrap">
    <input type="hidden" data-role="mtg-id" value="<?= $row['id_mtg']; ?>">
    <input type="hidden" data-role="hid" value="<?= $row['id_user']; ?>">
    <input type="hidden" data-role="mtgdz" value="<?= $row['sun'].$row['mon'].$row['tue'].$row['wed'].$row['thu'].$row['fri'].$row['sat']; ?>">
    <input type="hidden" data-role="mtg-day" value="<?= $today; ?>">
		<div class="daily-glance<?php if ($row['visible'] == 0) { echo ' draft'; } if ($row['visible'] == 1) { echo ' personal'; }  ?>">
			<div class="glance-mtg glance-mtg-time">
				<p><?= $mt->format('g:i') ?> <span data-ampm='<?= $mt->format('A') ?>'><?= $mt->format('A') ?></span></p>
			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?= $row['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type"> 

			<?php if ($row['admin'] != 1 && $_SESSION['admin'] == 3) { ?>
				<a class="manage-edit" href="user_role.php?id=<?= h(u($row['id_mtg'])) . '&user=' . h(u($row['id_user'])); ?>"><div class="tooltip"><span class="tooltiptext">Manage User</span><i class="far fas fa-user-cog"></i></div></a>
			<?php } ?>

			<?php if ($row['admin'] != 1 && ($_SESSION['admin'] == 2 || $_SESSION['admin'] == 3)) { ?>
				<a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Edit this User's meeting</span><i class="far fa-edit"></i></div></a>
			<?php } else { ?>
				<a class="manage-edit off-limits"><div class="tooltip"><span class="tooltiptext">Insufficient permissions</span><i class="far fa-edit"></i></div></a>
			<?php } ?>

			<?php if ($row['admin'] != 1 && ($_SESSION['admin'] == 2 || $_SESSION['admin'] == 3)) { ?>
				<a class="manage-edit" href="transfer-meeting.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Transfer this User's meeting</span><i class="far fas fa-people-arrows"></i></div></a>
			<?php } else { ?>
				<a class="manage-edit off-limits"><div class="tooltip right"><span class="tooltiptext">Insufficient permissions</span><i class="far fas fa-people-arrows"></i></div></a>
			<?php } ?>

			<?php if ($row['admin'] != 1 && $_SESSION['admin'] == 3) { ?>
				<a class="manage-delete" href="manage_delete.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip right"><span class="tooltiptext">Delete this User's meeting</span><i class="far fas fa-minus-circle"></i></div></a>
			<?php } ?>

					
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>
	<?php } ?>
<?php } ?>			
