
	<div class="manage-glance-wrap">
		<div class="manage-glance">
			<div class="glance-mtg glance-mtg-time">
				<p><?= substr(h($row['meet_time']), 0, 2) . ":" . substr(h($row['meet_time']), -2) . " "?><?php if($row['am_pm'] != 0) { ?>PM on <?php } else { ?>AM on <?php } 
				if ($row['sun'] != 0) { echo " Sun "; } 
				if ($row['mon'] != 0) { echo " Mon "; }
				if ($row['tue'] != 0) { echo " Tue "; }
				if ($row['wed'] != 0) { echo " Wed "; }
				if ($row['thu'] != 0) { echo " Thu "; }
				if ($row['fri'] != 0) { echo " Fri "; }
				?></p>
			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?= $row['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">
				<p><?php if ($row['id_user'] == $_SESSION['id']) { ?><a class="manage-edit" href="manage_edit.php?id=<?= h(u($id)); ?>"><i class="far fa-edit"></i></a><?php } ?></p>
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>
