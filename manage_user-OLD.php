<?php 
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';
if ($_SESSION['admin'] == 85 || $_SESSION['admin'] == 86) {
	header('location: ' . WWW_ROOT);
	exit();
}

if ($_SESSION['admin'] != 1 && $_SESSION['admin'] != 2) {
	header('location: https://www.merriam-webster.com/dictionary/go%20away');
	exit();
}

if ($_SESSION['admin'] == 1) {
	$layout_context = "suspend-user-odin";
} else if ($_SESSION['admin'] == 2) {
	$layout_context = "suspend-user-thor";
} else {
	$layout_context = "suspend-user";
}

$id = $_GET['id'];
$suspend_user = $_GET['user'];
$role = $_SESSION['admin'];

$row = suspend_user_info($id);
$users_role = $row['admin'];
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

	<?php if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2) { ?>

	<div id="transfer-host">
		<h2>Manage User</h2>
		<?php if ($suspend_user == 1) { ?>
			<p class="bob-1">Bob</p>
		<?php } else { ?>
			<p class="th-un">Username: <?= $row['username'] ?></p>
			<p class="th-em">Email: <?= $row['email'] ?></p>
		<?php } ?>
		<p><?= date('g:i A', strtotime($row['meet_time'])) . ' - '; ?>
				<?php 
				if ($row['sun'] == 0) {  } 
				else if (($row['sun'] !=0) && (($row['mon'] != 0) || ($row['tue'] != 0) || ($row['wed'] != 0) || ($row['thu'] != 0) || ($row['fri'] != 0) || ($row['sat'] != 0))) {
					echo "Sun, "; 
				} else { echo "Sun"; }

				if ($row['mon'] == 0) {  }
				else if (($row['mon'] !=0) && (($row['tue'] != 0) || ($row['wed'] != 0) || ($row['thu'] != 0) || ($row['fri'] != 0) || ($row['sat'] != 0))) { 
					echo "Mon, "; 
				} else { echo "Mon"; }

				if ($row['tue'] == 0) {  }
				else if (($row['tue'] !=0) && (($row['wed'] != 0) || ($row['thu'] != 0) || ($row['fri'] != 0) || ($row['sat'] != 0))) { 
					echo "Tue, "; 
				} else { echo "Tue"; }

				if ($row['wed'] == 0) {  }
				else if (($row['wed'] !=0) && (($row['thu'] != 0) || ($row['fri'] != 0) || ($row['sat'] != 0))) { 
					echo "Wed, "; 
				} else { echo "Wed"; }

				if ($row['thu'] == 0) {  }
				else if (($row['thu'] !=0) && (($row['fri'] != 0) || ($row['sat'] != 0))) { 
					echo "Thu, "; 
				} else { echo "Thu"; }

				if ($row['fri'] == 0) {  }
				else if (($row['fri'] !=0) && ($row['sat'] != 0)) { 
					echo "Fri, "; 
				} else { echo "Fri"; }

				if ($row['sat'] == 0) {  }
				else { echo "Sat "; }
				?>
				<?= ' - ' . $row['group_name'] ?></p>

<?php if (($suspend_user != $_SESSION['id']) && $suspend_user != 1) { ?>
		<form id="suspend-form">

			<div class="radio-groupz">

				<?php if ($role == 1 && $users_role != 2) { ?>
					<div class='radioz' value="2">
						Make <?= $row['username'] . ' an Administrator ' ?>
					</div>
				<?php } ?>
				<?php if ($role == 1 && $users_role == 2) { ?>
					<div class='radioz' value="0">
						Demote <?= $row['username'] . ' from Admin to User' ?>
					</div>
				<?php } ?>

				<div class='radioz' value="85">
					Suspend <?= $row['username'] ?> + KEEP meetings
				</div>
				<div class='radioz' value="86">
					Suspend <?= $row['username'] ?> + REMOVE meetings [Draft]
				</div>

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
<?php } ?>


		<div id="th-btn">
			<?php if ($suspend_user == 1 && $role != 1) { ?>
				<a id="not-yourself" class="not-odin">Bob's stuff is off limits</a>

			<?php } else if ($suspend_user == $_SESSION['id']) { ?>
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