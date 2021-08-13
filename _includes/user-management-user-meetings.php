
	<div class="manage-glance-wrap">
		<div class="manage-glance user-glance">
			<div class="glance-mtg glance-mtg-time">
				<p><?= date('g:i A', strtotime($rowz['meet_time'])); ?>

				<?php 
				if ($rowz['sun'] == 0) {  } 
				else if (($rowz['sun'] !=0) && (($rowz['mon'] != 0) || ($rowz['tue'] != 0) || ($rowz['wed'] != 0) || ($rowz['thu'] != 0) || ($rowz['fri'] != 0) || ($rowz['sat'] != 0))) {
					echo "Sun, "; 
				} else { echo "Sun"; }

				if ($rowz['mon'] == 0) {  }
				else if (($rowz['mon'] !=0) && (($rowz['tue'] != 0) || ($rowz['wed'] != 0) || ($rowz['thu'] != 0) || ($rowz['fri'] != 0) || ($rowz['sat'] != 0))) { 
					echo "Mon, "; 
				} else { echo "Mon"; }

				if ($rowz['tue'] == 0) {  }
				else if (($rowz['tue'] !=0) && (($rowz['wed'] != 0) || ($rowz['thu'] != 0) || ($rowz['fri'] != 0) || ($rowz['sat'] != 0))) { 
					echo "Tue, "; 
				} else { echo "Tue"; }

				if ($rowz['wed'] == 0) {  }
				else if (($rowz['wed'] !=0) && (($rowz['thu'] != 0) || ($rowz['fri'] != 0) || ($rowz['sat'] != 0))) { 
					echo "Wed, "; 
				} else { echo "Wed"; }

				if ($rowz['thu'] == 0) {  }
				else if (($rowz['thu'] !=0) && (($rowz['fri'] != 0) || ($rowz['sat'] != 0))) { 
					echo "Thu, "; 
				} else { echo "Thu"; }

				if ($rowz['fri'] == 0) {  }
				else if (($rowz['fri'] !=0) && ($rowz['sat'] != 0)) { 
					echo "Fri, "; 
				} else { echo "Fri"; }

				if ($rowz['sat'] == 0) {  }
				else { echo "Sat "; }

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
				<?php if (($rowz['id_user'] == $_SESSION['id']) || ($_SESSION['admin'] == 1 || ($_SESSION['admin'] == 3 && ($rowz['admin'] != 1 && $rowz['admin'] != 2 && $rowz['admin'] != 3)))) { ?>

				<a class="manage-edit" href="manage_edit.php?id=<?= h(u($rowz['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Edit Meeting</span><i class="far fa-edit"></i></div></a>

				<a class="manage-edit" href="transfer-meeting.php?id=<?= h(u($rowz['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Transfer Meeting</span><i class="fas fa-people-arrows"></i></div></a>

				<?php if ($_SESSION['admin'] == 1) { ?>
					<a class="manage-delete" href="manage_delete.php?id=<?= h(u($rowz['id_mtg'])); ?>"><div class="tooltip right"><span class="tooltiptext">Delete Meeting</span><i class="fas fa-minus-circle"></i></div></a>
				<?php } ?>

			<?php } ?>
			
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>
