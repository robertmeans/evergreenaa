<?php 
$layout_context = 'um-alt';
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

if (!is_executive()) {
	header('location: ' . WWW_ROOT);
	exit();
}

$id = $_GET['user'];
$role = $_SESSION['role'];

$row = get_user_by_id($id);
$users_mtgs = find_meetings_for_manage_page($id);
$mtg_found  = mysqli_num_rows($users_mtgs);

if (!is_president() && $row['role'] > 79) {
  header('location: ' . WWW_ROOT);
  exit();
}

require '_includes/head.php'; ?>

<body>
<?php preload_config($layout_context); ?>	
<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-set-timezone.php'; ?>
<?php require '_includes/msg-extras.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<?php $theme = configure_theme(); mobile_bkg_config($theme); ?>
<div id="host-manage-wrap">
	<div class="manage-simple intro">
	<?php require '_includes/inner_nav.php'; ?>
	</div>

		<?php if ($row['role'] == 99) { ?>
			<h2 id="role-h2" class="demote">Nope</h2>
		<?php } else if ($row['role'] == 0 || $row['role'] == 1) { /* suspended + kept mtgs = 1, suspended + mtgs-to-draft = 0 */ ?>
			<h2 id="role-h2" class="change-role">Reinstate User</h2>

		<?php } else if ($row['role'] == 20 || $row['role'] == 40 || $row['role'] == 60 || $row['role'] == 80) { ?>
			<h2 id="role-h2" class="change-role">Manage User</h2>
		<?php } else if ($role == 80 && $row['role'] == 80) { ?>
			<h2 id="role-h2" class="demote">Other Executives are off limits</h2>
		<?php } else { ?>
			<h2 id="role-h2" class="demote">Demote Admin</h2>
		<?php } ?>
	<div id="transfer-host">
		<p id="current-role" class="current-role"><?php 
            if ($row['role'] == 20) { ?>
				      Member
			<?php } else if ($row['role'] == 99) { ?>
				      You're trying something sneaky.
			<?php } else if ($row['role'] == 80) { ?>
				      Site Executive
      <?php } else if ($row['role'] == 60) { ?>
              Site Administrator
      <?php } else if ($row['role'] == 40) { ?>
              Site Manager
			<?php } else if ($row['role'] == 1) { /* suspended + kept mtgs = 1, suspended + mtgs-to-draft = 0 */ ?>
				      Suspended: Meetings remain active
			<?php } else if ($row['role'] == 2) { ?>
				Suspended: Meetings set to Draft
			<?php } ?>
		</p>

		<?php if ($row['role'] != 99) { ?>
			<p class="th-un">Username: <?= $row['username'] ?></p>
			<p class="th-em">Email: <?= $row['email'] ?></p>
		<?php } else { echo '<p class="th-em">&nbsp;</p>'; } ?>

<?php if (is_president() || $row['role'] != 80) { ?>
		<form id="suspend-form">

			<div class="radio-groupz">
				<?php if ($row['role'] == 99) { ?>
					<div class="radio-bob">
						No way, José.
					</div>
				<?php } else { ?>

					<?php if (is_president() && ($row['role'] == 0 || $row['role'] == 1 || $row['role'] == 20 || $row['role'] == 40 || $row['role'] == 60)) { // just me ?>
						<div class='radioz' value="80">
							Upgrade <?= $row['username'] . ' to Executive | Top Level <br> [ Manage Users + Edit + Transfer + Delete : All meetings ]' ?>
						</div>					
					<?php } ?>
          
					<?php if (is_president() && $row['role'] == 80) { // just me ?> 
						<div class='radioz' value="60">
							Downgrade <?= $row['username'] . ' to Administrator <br> [ Edit + Transfer + Delete : All meetings ]' ?>
						</div>
            <div class='radioz' value="40">
              Downgrade <?= $row['username'] . ' to Manager <br> [ Edit : All meetings ]' ?>
            </div>
						<div class='radioz' value="20">
							Downgrade <?= $row['username'] . ' to Member' ?>
						</div>
					<?php } ?>

          <?php if (is_president() && $row['role'] == 60) { // just me ?> 
            <div class='radioz' value="40">
              Downgrade <?= $row['username'] . ' to Manager <br> [ Edit : All meetings ]' ?>
            </div>
            <div class='radioz' value="20">
              Downgrade <?= $row['username'] . ' to Member' ?>
            </div>
          <?php } ?>

          <?php if (is_president() && $row['role'] == 40) { // just me ?> 
            <div class='radioz' value="60">
              Upgrade <?= $row['username'] . ' to Administrator <br> [ Edit + Transfer + Delete : All meetings ]' ?>
            </div>
            <div class='radioz' value="20">
              Downgrade <?= $row['username'] . ' to Member' ?>
            </div>
          <?php } ?>

          <?php if (is_president() && $row['role'] == 20) { // just me ?> 
            <div class='radioz' value="60">
              Upgrade <?= $row['username'] . ' to Administrator <br> [ Edit + Transfer + Delete : All meetings ]' ?>
            </div>
            <div class='radioz' value="40">
              Downgrade <?= $row['username'] . ' to Manager <br> [ Edit : All meetings ]' ?>
            </div>
          <?php } ?>

          <?php if (declare_executive() && $row['role'] == 60) { ?>
            <div class='radioz' value="40">
              Downgrade <?= $row['username'] . ' to Manager <br> [ Edit : All meetings ]' ?>
            </div>
            <div class='radioz' value="20">
              Downgrade <?= $row['username'] . ' to Member' ?>
            </div>
          <?php } ?>
					<?php if (declare_executive() && $row['role'] == 40) { ?>
						<div class='radioz' value="60">
							Upgrade <?= $row['username'] . ' to Administrator <br> [ Edit + Transfer + Delete : All meetings ]' ?>
						</div>
            <div class='radioz' value="20">
              Downgrade <?= $row['username'] . ' to Member' ?>
            </div>
					<?php } ?>	
          <?php if (declare_executive() && $row['role'] == 20) { ?>
            <div class='radioz' value="60">
              Upgrade <?= $row['username'] . ' to Administrator <br> [ Edit + Transfer + Delete : All meetings ]' ?>
            </div>
            <div class='radioz' value="40">
              Upgrade <?= $row['username'] . ' to Manager <br> [ Edit : All meetings ]' ?>
            </div>
          <?php } ?>

					<?php if ($row['role'] == 0 && $row['role'] == 1) { ?>

            <div class='radioz' value="60">
              Reinstate <?= $row['username'] . ' with Administrator permissions <br> [ Edit + Transfer + Delete : All meetings ]' ?>
            </div>
						<div class='radioz' value="40">
							Reinstate <?= $row['username'] . ' with Manager permissions <br> [ Edit : All meetings ]' ?>
						</div>
						<div class='radioz' value="20">
							Reinstate <?= $row['username'] . ' as Member' ?>
						</div>
					<?php } ?>

          <?php if ($row['role'] != 0 && $row['role'] != 1 && $mtg_found === 0) { ?> 
            <div class='radioz tuhnm' value="1">
              Suspend <?= $row['username'] ?><br>This user has no meetings
            </div>
          <?php } ?>

					<?php if ($row['role'] != 0 && $row['role'] != 1 && $mtg_found > 0) { ?> 
						<div class='radioz' value="1">
							Suspend <?= $row['username'] ?> but KEEP meetings
						</div>
						<div class='radioz' value="0">
							Suspend <?= $row['username'] ?> and REMOVE meetings [Draft]
						</div>
					<?php } ?>

				<?php } ?>

				<?php /* 	grab value and put it into hidden field to submit */ ?>
				<input type="hidden" name="role">
				<input type="hidden" name="mode" value="<?= $row['mode'] ?>">
			 </div>

			<input type="hidden" name="user" value="<?= $row['id_user'] ?>">
			<div id="sus-reason">
				<p>Reason</p><textarea id="sus-note" name="reason" maxlength="250"><?php if ($row['sus_notes'] != '') { echo $row['sus_notes']; } ?></textarea>
			</div>
		</form>
<?php } ?>		

		<div id="sus-msg"></div>
		<div id="whoops"></div>

		<div id="th-btn">
			<?php if ($row['role'] == 99) { // me ?>
				<a id="not-yourself" class="not-odin">The President's stuff is off limits</a>
			
			<?php } else if ($id == $_SESSION['id']) { // they changed the $_GET in url to their # ?>
				<a id="not-yourself">You can't change your own role.</a>
      <?php } else if (!is_president() && $row['role'] == 80) { // someone trying to work on Top Tier other than me ?>
        <a id="not-yourself" class="not-odin">Other Executives are off limits</a>
			<?php } else { ?>

				<div id="gdtrfb">
					<a id="select-role-first">Select a User Role</a>
				</div>

		<?php } ?>
		</div>
	</div>

<?php if ($row['role'] != 99) { ?>
<h1 class="usr-role-mtg"><?= $row['username'] . '\'s ' ?>Meetings</h1>

<ul class="manage-weekdays">
<?php if ($mtg_found > 0) { ?>

<?php $ic = 0; $pc = 0; // if user has meetings to manage, display them in order: Day > time, starting with Sun ?>

		<?php while ($row = mysqli_fetch_assoc($users_mtgs)) { ?>

			<?php
			$time = [];
			$time['tz'] = $tz;
			$time['ut'] = $row['meet_time'];

			$time['sun'] = $row['sun'];
			$time['mon'] = $row['mon'];
			$time['tue'] = $row['tue'];
			$time['wed'] = $row['wed'];
			$time['thu'] = $row['thu'];
			$time['fri'] = $row['fri'];
			$time['sat'] = $row['sat'];

			list($ct, $sun, $mon, $tue, $wed, $thu, $fri, $sat) = apply_offset_to_edit($time);

			$row['sun'] = $sun;
			$row['mon'] = $mon;
			$row['tue'] = $tue;
			$row['wed'] = $wed;
			$row['thu'] = $thu;
			$row['fri'] = $fri;
			$row['sat'] = $sat;


    $pc = '1';
    $ic = '1'; 
    $mt = new DateTime($row['meet_time']); 
    require '_includes/daily-glance.php'; ?>
			<div class="weekday-wrap<?php if ('visible' == 0) { echo ' draft-bkg'; }  ?>">
				<?php require '_includes/meeting-details.php'; ?>
			</div><!-- .weekday-wrap -->

		<?php $ic++; $pc++; } ?>

	<?php  
	} else { // user has no meetings to manage
		echo '<p style="margin-top:0.5em;padding:0px 1em;">'. $row['username'] .' does not have any meetings.</p>';
	} mysqli_free_result($users_mtgs); ?>

</ul><!-- .manage-weekdays -->
<?php } ?>

</div><!-- #host-manage-wrap -->

<?php require '_includes/footer.php'; ?>