<?php 
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';
require_once '_includes/set_timezone.php';
// you can only manage users if you're Admin 1 or 3
if ($_SESSION['admin'] != 1 && $_SESSION['admin'] != 3) {
	header('location: ' . WWW_ROOT);
	exit();
}

$layout_context = "alt-manage";

$id = $_GET['user'];
$role = $_SESSION['admin'];

if ($id != 1 && ($id == '' || $id == $_SESSION['id'])) {
	header('location: ' . WWW_ROOT);
	exit();
}

$row = get_user_by_id($id);

require '_includes/head.php'; ?>

<body>
<?php if (WWW_ROOT != 'http://localhost/evergreenaa') { ?>
<div class="preload-manage">
	<p>Loading...</p>
</div>
<?php } ?>	
	
<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-extras.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="host-manage-wrap">
	<div class="manage-simple intro">
	<?php require '_includes/inner_nav.php'; ?>
	</div>

	<?php if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3) { ?>

		<?php if ($id == 1) { ?>
			<h2 id="role-h2" class="demote">Nope</h2>
		<?php } else if ($row['admin'] == 85 || $row['admin'] == 86) { ?>
			<h2 id="role-h2" class="change-role">Reinstate User</h2>
		<?php } else if ($row['admin'] == 0 || $row['admin'] == 2) { ?>
			<h2 id="role-h2" class="change-role">Manage User</h2>
		<?php } else if ($_SESSION['admin'] != 1 && ($row['admin'] == 1 || $row['admin'] == 3)) { ?>
			<h2 id="role-h2" class="demote">Top Tier Admin are off limits</h2>
		<?php } else { ?>
			<h2 id="role-h2" class="demote">Demote Admin</h2>
		<?php } ?>
	<div id="transfer-host">
		<p id="current-role" class="current-role"><?php if ($row['admin'] == 0) { ?>
				Member
			<?php } else if ($row['admin'] == 1) { ?>
				Bob's stuff
			<?php } else if ($row['admin'] == 2) { ?>
				Level II Administrator
			<?php } else if ($row['admin'] == 85) { ?>
				Suspended: Meetings remain active
			<?php } else if ($row['admin'] == 86) { ?>
				Suspended: Meetings set to Draft
			<?php } else { ?>
				Top Tier Administrator
			<?php } ?>
		</p>

		<?php if ($id == 1) { ?>
			<p class="bob-1">Bob</p>
		<?php } else { ?>
			<p class="th-un">Username: <?= $row['username'] ?></p>
			<p class="th-em">Email: <?= $row['email'] ?></p>
		<?php } ?>

<?php if ($_SESSION['admin'] == 1 || ($row['admin'] != 1 && $row['admin'] != 3)) { ?>
		<form id="suspend-form">

			<div class="radio-groupz">
				<?php if ($id == 1) { ?>
					<div class="radio-bob">
						No way, José.
					</div>
				<?php } else if ($id == $_SESSION['id']) { ?>
					<div class="radio-bob">
						Read the text below...
					</div>
				<?php } else { ?>


					<?php if ($_SESSION['admin'] == 1 && ($row['admin'] == 0 || $row['admin'] == 2 || $row['admin'] == 85 || $row['admin'] == 86)) { // just me ?>
						<div class='radioz' value="3">
							Upgrade <?= $row['username'] . ' to ADMIN priviliges: TOP TIER <br> [ Manage Users + Edit + Transfer + Delete : All meetings]' ?>
						</div>					
					<?php } ?>
					<?php if ($_SESSION['admin'] == 1 && $row['admin'] == 3) { // just me ?> 
						<div class='radioz' value="2">
							Downgrade <?= $row['username'] . ' to Level II Admin <br> [ Edit + Transfer : All meetings]' ?>
						</div>
						<div class='radioz' value="0">
							Downgrade <?= $row['username'] . ' to Member' ?>
						</div>
					<?php } ?>
					<?php /* if ($_SESSION['admin'] == 1 && $row['admin'] == 3) { // just me ?>
						<div class='radioz' value="3">
							Upgrade <?= $row['username'] . ' ADMIN priviliges: TOP TIER <br> [ Manage Users + Edit + Transfer + Delete : All meetings]' ?>
						</div>
					<?php } */ ?>


					<?php if (($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3) && $row['admin'] == 2) { ?>
					<?php /* me + Top Tier can downgrade Level II Admin to Member */ ?>
						<div class='radioz' value="0">
							Downgrade <?= $row['username'] . ' to Member' ?>
						</div>
					<?php } ?>	


					<?php if ($row['admin'] != 1 && $row['admin'] != 2 && $row['admin'] != 3) { ?>
					<?php /* user is currently Member or suspended */ ?>
						<?php if ($row['admin'] == 0) { // user is Member ?>
							<div class='radioz' value="2">
								Grant <?= $row['username'] . ' ADMIN priviliges: Level II <br> [ Edit + Transfer : All meetings]' ?>
							</div>

						<?php } else { // user is suspended ?>
						<?php /* 
							<div class='radioz' value="3">
								Reinstate <?= $row['username'] . ' with ADMIN priviliges: TOP TIER <br> [ Manage Users + Edit + Transfer + Delete : All meetings]' ?>
							</div>
						*/ ?>
							<div class='radioz' value="2">
								Reinstate <?= $row['username'] . ' with ADMIN priviliges: Level II <br> [ Edit + Transfer : All meetings]' ?>
							</div>
							<div class='radioz' value="0">
								Reinstate <?= $row['username'] . ' as Member' ?>
							</div>
						<?php } ?>
					<?php } ?>


					<?php if ($row['admin'] != 85 && $row['admin'] != 86) { ?> 
						<div class='radioz' value="85">
							Suspend <?= $row['username'] ?> but KEEP meetings
						</div>
						<div class='radioz' value="86">
							Suspend <?= $row['username'] ?> and REMOVE meetings [Draft]
						</div>
					<?php } ?>

				<?php } ?>

				<?php /* 	grab value and put it into hidden field to submit */ ?>
				<input type="hidden" name="admin">
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
			<?php if ($id == 1) { // me ?>
				<a id="not-yourself" class="not-odin">Bob's stuff is off limits</a>
			<?php } else if ($_SESSION['id'] != 1 && $row['admin'] == 3) { // someone trying to work on Top Tier other than me ?>
				<a id="not-yourself" class="not-odin">Off limits</a>
			<?php } else if ($id == $_SESSION['id']) { // they changed the $_GET in url to their # ?>
				<a id="not-yourself">Don't play with yourself</a>
			<?php } else { ?>

				<div id="gdtrfb">
					<a id="select-role-first">Select a User Role</a>
				</div>

		<?php } ?>
		</div>
	</div>

	<?php } else { echo "<p style=\"margin:1.5em 0 0 1em;\">How'd you get this far?</p>"; } ?>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>