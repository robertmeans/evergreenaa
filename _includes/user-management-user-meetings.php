
	<div class="manage-glance-wrap um">
		<div class="manage-glance user-glance">
			<div class="glance-mtg glance-mtg-time"> 
				<p>

				<?php
          $nt = format_time($rowz['meet_time']);  
          echo $nt . ' - '; print_day($rowz); echo '&nbsp; <span class="gtz">['; pretty_tz($rowz['mtg_tz']); echo ']</span>'; 
        ?></p>

			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?php if ($rowz['meet_url'] != null) { echo '<div class="tooltip"><span class="tooltiptext">Zoom Meeting</span><i class="fas fa-video fa-fw"></i></div>'; } if ($rowz['meet_addr'] != null) { echo '<div class="tooltip"><span class="tooltiptext">In-Person Meeting</span><i class="fas fa-map-marker-alt fa-fw"></i></div>'; }  ?>
				<?php 
				if ($rowz['visible'] == 0) { echo ' [DRAFT] '; }
				if ($rowz['visible'] == 1) { echo ' [PRIVATE] '; }  
				if ($rowz['visible'] == 2) { echo ' [MEMBERS] '; } // Members only
				if ($rowz['visible'] == 3) { echo ' [PUBLIC] '; }
				?><?= $rowz['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">
				<?php if ($rowz['id_user'] == $_SESSION['id'] || is_president() && ($rowz['id_user'] != $_SESSION['id'])) { ?>

				<a class="manage-edit" href="manage_edit.php?id=<?= h(u($rowz['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Edit Meeting</span><i class="far fa-edit"></i></div></a>

				<a class="manage-edit" href="transfer-meeting.php?id=<?= h(u($rowz['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Transfer Meeting</span><i class="fas fa-people-arrows"></i></div></a>

				<a class="manage-delete" href="manage_delete.php?id=<?= h(u($rowz['id_mtg'])); ?>"><div class="tooltip right"><span class="tooltiptext">Delete Meeting</span><i class="fas fa-minus-circle"></i></div></a>


			<?php } ?>
			
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>
