<?php 
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';
// you can only manage users if you're Admin 1 or 3
if ($_SESSION['admin'] != 1 && $_SESSION['admin'] != 3) {
	header('location: ' . WWW_ROOT);
	exit();
}

if ($_SESSION['admin'] == 1) {
	$layout_context = "user-role-odin";
} else if ($_SESSION['admin'] == 3) {
	$layout_context = "user-role-thor";
} else {
	$layout_context = "user-role";
}

$id = $_GET['user'];
$role = $_SESSION['admin'];

$row = get_user_by_id($id);
?>

<?php require '_includes/head.php'; ?>
<body>
<?php if (WWW_ROOT != 'http://localhost/evergreenaa') { ?>
<div class="preload-manage">
	<p>Loading...</p>
</div>
<?php } ?>	
	
<?php require '_includes/nav.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="host-manage-wrap">
	<div class="manage-simple intro">
		<p class="logout"><a href="manage.php">My Dashboard</a> | <a href="user_management.php">User Management</a></p>
	</div>

	<?php if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3) { ?>

		<?php if ($id == 1) { ?>
			<h2 id="role-h2" class="demote">Nope</h2>
		<?php } else if ($row['admin'] == 85 || $row['admin'] == 86) { ?>
			<h2 id="role-h2" class="change-role">Reinstate User</h2>
		<?php } else if ($row['admin'] == 0 || $row['admin'] == 2) { ?>
			<h2 id="role-h2" class="change-role">Manage User</h2>
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

					<?php if ($row['admin'] == 3) { ?>
						<div class='radioz' value="2">
							Downgrade <?= $row['username'] . ' to Level II Admin <br> [ Edit + Transfer : All meetings]' ?>
						</div>
					<?php } else if ($row['admin'] == 2) { ?>
						<div class='radioz' value="3">
							Upgrade <?= $row['username'] . ' ADMIN priviliges: TOP TIER <br> [ Manage Users + Edit + Transfer + Delete : All meetings]' ?>
						</div>
						<div class='radioz' value="0">
							Downgrade <?= $row['username'] . ' to Member' ?>
						</div>
					<?php } ?>					

					<?php if ($row['admin'] != 1 && $row['admin'] != 2 && $row['admin'] != 3) { ?>
						<?php if ($row['admin'] == 0) { // user is Member ?>
							<div class='radioz' value="3">
								Grant <?= $row['username'] . ' ADMIN priviliges: TOP TIER <br> [ Manage Users + Edit + Transfer + Delete : All meetings]' ?>
							</div>
							<div class='radioz' value="2">
								Grant <?= $row['username'] . ' ADMIN priviliges: Level II <br> [ Edit + Transfer : All meetings]' ?>
							</div>

						<?php } else { ?>
							<div class='radioz' value="3">
								Reinstate <?= $row['username'] . ' with ADMIN priviliges: TOP TIER <br> [ Manage Users + Edit + Transfer + Delete : All meetings]' ?>
							</div>
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
			 </div>

			<input type="hidden" name="user" value="<?= $row['id_user'] ?>">
			<div id="sus-reason">
				<p>Reason</p><textarea name="reason"></textarea>
			</div>
		</form>
		
		<div id="sus-msg">
			
		</div>

		<div id="th-btn">
			<?php if ($id == 1) { ?>
				<a id="not-yourself" class="not-odin">Bob's stuff is off limits</a>

			<?php } else if ($id == $_SESSION['id']) { ?>
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