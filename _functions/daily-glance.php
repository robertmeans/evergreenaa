
	<div class="daily-glance-wrap">
		<div class="daily-glance">
			<div class="glance-mtg glance-mtg-time">
				<p><?= substr(h($row['meet_time']), 0, 2) . ":" . substr(h($row['meet_time']), -2) . " "?><?php if($row['am_pm'] != 0) { ?>PM<?php } else { ?>AM<?php } ?></p>
			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?= $row['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">
				<p><?php if ($row['code_o'] != 0) { echo 'Open meeting'; } else if ($row['code_w'] != 0) { echo 'Women\'s meeting'; } else if ($row['code_m'] != 0) { echo 'Men\'s meeting'; } else { echo 'Join us'; } ?> <?php 

				if (isset($_SESSION['id'])) {
					if ($row['id_user'] == $_SESSION['id']) { 

						?><a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><i class="far fa-edit"></i></a>

					<?php }
					} ?>
					
				</p>
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>
