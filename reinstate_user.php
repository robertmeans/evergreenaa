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
	$layout_context = "reinstate-user-odin";
} else if ($_SESSION['admin'] == 2) {
	$layout_context = "reinstate-user-thor";
} else {
	$layout_context = "reinstate-user";
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

	<?php if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2) { ?>

	<div id="transfer-host">
		<h2>Reinstate User</h2>
		<?php if ($id == 1) { ?>
			<p style="margin: 0.25 0 0.75em 0;padding:0.25em 0em 0.5em;border-bottom: 1px solid rgba(255,255,255,0.1);">Bob</p>
		<?php } else { ?>
			<p style="margin: 0.25em 0 0;padding-top: 0.25em;">Username: <?= $row['username'] ?></p>
			<p style="margin: 0 0 0.75em 0;padding-bottom: 0.5em;border-bottom: 1px solid rgba(255,255,255,0.1);">Email: <?= $row['email'] ?></p>
		<?php } ?>
		

		<form id="suspend-form">

			<div class="radio-groupz">

				<div class='radioz' value="0">
					Reinstate <?= $row['username'] . ' with USER priviliges' ?>
				</div>
				<div class='radioz' value="2">
					Reinstate <?= $row['username'] . ' with ADMIN priviliges' ?>
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