<?php if (isset($_SESSION['id'])) { ?>
<?php /* 
			user is logged in, show them their Private, their Members and their Public meetings (1's, 2's and 3's)
*/ ?><?php
	if ((($row['id_user']) == $_SESSION['id']) && (($row['visible'] == 1) || ($row['visible'] == 2) || ($row['visible'] == 3))) { ?>

	<div class="daily-glance-wrap">
    <input type="hidden" data-role="mtg-id" value="<?= $row['id_mtg']; ?>">
    <input type="hidden" data-role="usr-id" value="<?= $row['id_user']; ?>">
		<div class="daily-glance<?php if ($row['visible'] == 0) { echo ' draft'; } if ($row['visible'] == 1) { echo ' personal'; }  ?>">
			<div class="glance-mtg glance-mtg-time">

				<p><?= $mt->format('g:i') ?> <span data-ampm='<?= $mt->format('A') ?>'><?= $mt->format('A') ?></span></p>

			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?= $row['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">

				<?php 
				if ($row['meet_url'] != null) { ?>
					<div class="tooltip">
						<span class="tooltiptext type">Zoom Meeting</span><i class="fas far fa-video fa-fw"></i>
					</div> 
		<?php } 
				if ($row['meet_addr'] != null) { ?>
					<div class="tooltip">
						<span class="tooltiptext type">In-Person Meeting</span><i class="fas far fa-map-marker-alt fa-fw"></i>
					</div>
		<?php }  

					if ($row['code_o'] != 0) { ?>
						<div class="ctr-type">
							Open meeting
						</div>
		<?php } else if ($row['code_w'] != 0) { ?>
							<div class="ctr-type">
								Women's meeting
							</div> 
		<?php } else if ($row['code_m'] != 0) { ?>
							<div class="ctr-type">
								Men's meeting
							</div> 
		<?php } else { ?>
							<div class="ctr-type">
								Join us
							</div>
		<?php } 

			if ($row['id_user'] == $_SESSION['id']) { 

				?><a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip right"><span class="tooltiptext">Edit Meeting</span><i class="far fa-edit"></i></div></a>

			<?php } ?>
					
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>

<?php /* 
			user is logged in. show them other people's Members (2's) and Public (3's) meetings 
*/ ?>
<?php } else if ((($row['id_user']) != $_SESSION['id']) && ((($row['visible'] == 2) || ($row['visible'] == 3)))) { ?>

	<div class="daily-glance-wrap">
    <input type="hidden" data-role="mtg-id" value="<?= $row['id_mtg']; ?>">
    <input type="hidden" data-role="usr-id" value="<?= $row['id_user']; ?>">
		<div class="daily-glance<?php if ($row['visible'] == 0) { echo ' draft'; } if ($row['visible'] == 1) { echo ' personal'; }  ?>">
			<div class="glance-mtg glance-mtg-time">

				<p><?= $mt->format('g:i') ?> <span data-ampm='<?= $mt->format('A') ?>'><?= $mt->format('A') ?></span></p>
				
			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?= $row['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">

<?php 
				if ($row['meet_url'] != null) { ?>
					<div class="tooltip">
						<span class="tooltiptext type">Zoom Meeting</span><i class="fas far fa-video fa-fw"></i>
					</div> 
		<?php } 
				if ($row['meet_addr'] != null) { ?>
					<div class="tooltip">
						<span class="tooltiptext type">In-Person Meeting</span><i class="fas far fa-map-marker-alt fa-fw"></i>
					</div>
		<?php }  

					if ($row['code_o'] != 0) { ?>
						<div class="ctr-type">
							Open meeting
						</div>
		<?php } else if ($row['code_w'] != 0) { ?>
							<div class="ctr-type">
								Women's meeting
							</div> 
		<?php } else if ($row['code_m'] != 0) { ?>
							<div class="ctr-type">
								Men's meeting
							</div> 
		<?php } else { ?>
							<div class="ctr-type">
								Join us
							</div>
		<?php } 

			if ($row['id_user'] == $_SESSION['id']) { 

				?><a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip right"><span class="tooltiptext">Edit Meeting</span><i class="far fa-edit"></i></div></a>

			<?php } ?>
	
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>
<?php } ?>

<?php /* 
			no session id set - general public - only show public (3's) meetings
*/ ?>
<?php } else if  ($row['visible'] != 0 && $row['visible'] != 1 && $row['visible'] != 2) { ?>	

	<div class="daily-glance-wrap">
    <input type="hidden" data-role="mtg-id" value="<?= $row['id_mtg']; ?>">
    <input type="hidden" data-role="usr-id" value="<?= $row['id_user']; ?>">
		<div class="daily-glance<?php if ($row['visible'] == 0) { echo ' draft'; } if ($row['visible'] == 1) { echo ' personal'; }  ?>">
			<div class="glance-mtg glance-mtg-time">
				<p><?= $mt->format('g:i') ?> <span data-ampm='<?= $mt->format('A') ?>'><?= $mt->format('A') ?></span></p>
			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?= $row['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">
<?php 
				if ($row['meet_url'] != null) { ?>
					<div class="tooltip">
						<span class="tooltiptext type">Zoom Meeting</span><i class="fas far fa-video fa-fw"></i>
					</div> 
		<?php } 
				if ($row['meet_addr'] != null) { ?>
					<div class="tooltip">
						<span class="tooltiptext type">In-Person Meeting</span><i class="fas far fa-map-marker-alt fa-fw"></i>
					</div>
		<?php }  

					if ($row['code_o'] != 0) { ?>
						<div class="ctr-type">
							Open meeting
						</div>
		<?php } else if ($row['code_w'] != 0) { ?>
							<div class="ctr-type">
								Women's meeting
							</div> 
		<?php } else if ($row['code_m'] != 0) { ?>
							<div class="ctr-type">
								Men's meeting
							</div> 
		<?php } else { ?>
							<div class="ctr-type">
								Join us
							</div>
		<?php } ?>
					
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>

<?php } ?>