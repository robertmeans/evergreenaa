
	<div class="manage-glance-wrap">
		<div class="manage-glance<?php if ($row['visible'] == 0) { echo ' draft'; } if ($row['visible'] == 1) { echo ' personal'; }  ?>">
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
				<p><?php if ($row['meet_url'] != null) { echo '<div class="tooltip"><span class="tooltiptext">Zoom Meeting</span><i class="fas fa-video fa-fw"></i></div>'; } if ($row['meet_addr'] != null) { echo '<div class="tooltip"><span class="tooltiptext">In-Person Meeting</span><i class="fas fa-map-marker-alt fa-fw"></i></div>'; }  ?>
				<?php 
				if ($row['visible'] == 0) { echo ' [DRAFT] '; }
				if ($row['visible'] == 1) { echo ' [PRIVATE] '; }  
				if ($row['visible'] == 2) { echo ' [MEMBERS] '; } // Members only
				if ($row['visible'] == 3) { echo ' [PUBLIC] '; }
				?><?= $row['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">
				<p><?php if (($row['id_user'] == $_SESSION['id']) || $_SESSION['admin'] == "1") { ?><a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><i class="far fa-edit"></i></a>

				<?php } ?>
			</p>
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>
