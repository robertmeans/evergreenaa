<?php /*
for reference (set in whatever page requires this one) - 
$user_id = $_SESSION['id'];
$user_role = $_SESSION['admin'];
*/ ?>
<?php if (isset($user_id)) { // They're loggin in as a Member
/* 
			SQL query for this entire page is a JOIN on meetings & users by id_user. argument $today is passed with each day to reitterate query (i.e, $today = sun | $today = mon... etc.) the query reads:
			"WHERE m." . $today . " != 0 AND m.visible != 0 ORDER BY m.meet_time;";
			so for each day we have all today's meetings that are not Drafts, from everybody and we're sorting them by meet_time. this page will look at each one and determine how to display it.

			First case: user is logged in. these are THEIR MEETINGS: Private, Members and Public (visible = 1 || 2 || 3)
*/ ?><?php
	if ((($row['id_user']) == $user_id) && (($row['visible'] == 1) || ($row['visible'] == 2) || ($row['visible'] == 3))) { ?>

	<div class="daily-glance-wrap">
		<div class="daily-glance<?php if ($row['visible'] == 0) { echo ' draft'; } if ($row['visible'] == 1) { echo ' personal'; }  ?>">
			<div class="glance-mtg glance-mtg-time">
				<p><?= date('g:i A', strtotime($row['meet_time'])); ?></p>
			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?= $row['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">
<?php /*
			If they are Admin they don't need to see the Zoom and in-person icons or meeting type (Open, Mens, Women's, etc.) 
*/
if ($_SESSION['admin'] != 1 && $_SESSION['admin'] != 2 && $_SESSION['admin'] != 3) {

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
} 
/*		
			if they are Admin show them Manage User, Edit, Transfer and Delete accordingly. otherwise, they're logged in so show them the edit icon because they're looking at their meetings right now. 
*/
		if ($user_role == 1 || $user_role == 2 || $user_role == 3) { ?>
		<?php /* allow them to edit this meeting... */ ?>
				<a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Edit Meeting</span><i class="far fa-edit"></i></div></a>

		<?php /* ... also allow them to transfer this meeting */ ?>
				<a class="manage-edit" href="transfer-meeting.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Transfer Meeting</span><i class="far fas fa-people-arrows"></i></div></a>
		<?php } ?>

			<?php /* if they're Odin or Admin 3 allow them to delete this meeting (otherwise, even though this is their meeting, they have to go through the extra step of going to the Dashboard. we don't want to show the delete icon as it would be clutter for the regular Member along with all the other icons in this area. */ ?>
			<?php if (($row['id_user'] == $user_id) || ($user_role == 1 || $user_role == 3)) { ?>
				<a class="manage-delete" href="manage_delete.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip right"><span class="tooltiptext">Delete Meeting</span><i class="far fas fa-minus-circle"></i></div></a>
			<?php } ?>



			<a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip right"><span class="tooltiptext">Edit Meeting</span><i class="far fa-edit"></i></div></a>



			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>

<?php /* 
			user is logged in. show them other people's Members and Public meetings (2's and 3's)
			reference: $user_id = $_SESSION['id'] and $user_role = $_SESSION['admin'] 
*/ ?>
<?php } else if (($row['id_user'] != $user_id) && ($row['visible'] == 2 || $row['visible'] == 3)) { ?>

	<div class="daily-glance-wrap">
		<div class="daily-glance<?php if ($row['visible'] == 0) { echo ' draft'; } if ($row['visible'] == 1) { echo ' personal'; }  ?>">
			<div class="glance-mtg glance-mtg-time">
				<p><?= date('g:i A', strtotime($row['meet_time'])); ?></p>
			</div><!-- .glance-time-day -->
			<div class="glance-mtg glance-group-title">
				<p><?= $row['group_name']; ?></p>
			</div><!-- .glance-group -->
			<div class="glance-mtg glance-mtg-type">
<?php /*
			If they are Admin they don't need to see the Zoom and in-person icons or meeting type (Open, Mens, Women's, etc.) 
*/ 
if ($_SESSION['admin'] != 1 && $_SESSION['admin'] != 2 && $_SESSION['admin'] != 3) {

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
} 
/*		
			we're looking at other people's meetings right now so if they're not Odin or Admin they don't get the line up of admin icons (and they got that Zoom and in-person stuff above instead). show them Manage User, Edit, Transfer and Delete accordingly.
*/
		if ($user_role == 1 || $user_role == 2 || $user_role == 3) { ?>
			<?php /* if they are either (Odin) or Admin 3 then show them the Manage User icon */ ?>
			<?php if (($row['id_user'] != $user_id) && ($user_role == 1 || $user_role == 3)) { ?>
				<a class="manage-edit" href="user_role.php?id=<?= h(u($row['id_mtg'])) . '&user=' . h(u($row['id_user'])); ?>"><div class="tooltip"><span class="tooltiptext">Manage User</span><i class="far fas fa-user-cog"></i></div></a>
			<?php } ?>

			<?php /* allow them to edit this meeting ONLY if they're admin */ ?>
			<a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Edit Meeting</span><i class="far fa-edit"></i></div></a>

			<?php /* allow them to transfer this meeting */ ?>
			<a class="manage-edit" href="transfer-meeting.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Transfer Meeting</span><i class="far fas fa-people-arrows"></i></div></a>

			<?php /* allow them to delete this meeting ONLY if it's theirs or they're Odin or Admin 3 */ ?>
			<?php if (($row['id_user'] == $user_id) || ($user_role == 1 || $user_role == 3)) { ?>
			<a class="manage-delete" href="manage_delete.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip right"><span class="tooltiptext">Delete Meeting</span><i class="far fas fa-minus-circle"></i></div></a>
			<?php } ?>

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
		<div class="daily-glance<?php if ($row['visible'] == 0) { echo ' draft'; } if ($row['visible'] == 1) { echo ' personal'; }  ?>">
			<div class="glance-mtg glance-mtg-time">
				<p><?= date('g:i A', strtotime($row['meet_time'])); ?></p>
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
							Women\'s meeting
						</div> 
			<?php } else if ($row['code_m'] != 0) { ?> 
						<div class="ctr-type">
							Men\'s meeting</div> 
			<?php } else { ?>
						<div class="ctr-type">
							Join us</div> 
			<?php } ?>  

			<?php if (isset($user_id)) {
					if (($row['id_user'] == $user_id) || $user_id == "1") { ?>
						<a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip right"><span class="tooltiptext">Edit Meeting</span><i class="far fa-edit"></i></div></a>
					<?php }
					} ?>
					
			</div><!-- .glance-mtg-type -->
		</div><!-- .daily-glance -->
	</div>

<?php } ?>