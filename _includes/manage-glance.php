
	<div class="manage-glance-wrap">
		<div class="manage-glance">
			<div class="glance-mtg glance-mtg-time">
				<p><?= date('g:i A', strtotime($row['meet_time'])); ?>
				<?php
				if ($row['sun'] != 0) { echo " Sun "; } 
				if ($row['mon'] != 0) { echo " Mon "; }
				if ($row['tue'] != 0) { echo " Tue "; }
				if ($row['wed'] != 0) { echo " Wed "; }
				if ($row['thu'] != 0) { echo " Thu "; }
				if ($row['fri'] != 0) { echo " Fri "; }
				if ($row['sat'] != 0) { echo " Sat "; }
				?></p>
			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?= $row['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">
				<p><?php if ($row['id_user'] == $_SESSION['id']) { ?><a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><i class="far fa-edit"></i></a>

				<a class="manage-delete" href="manage_delete.php?id=<?= h(u($row['id_mtg'])); ?>"><i class="fas fa-minus-circle"></i></a><?php } ?>
			</p>
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>
