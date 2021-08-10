<?php 

require_once 'config/initialize.php';

if ($_SESSION['admin'] == 1) {
	$layout_context = "manage-delete-odin";
} else if ($_SESSION['admin'] == 2) {
	$layout_context = "manage-delete-thor";
} else if ($_SESSION['admin'] == 86) {
	header('location: ' . WWW_ROOT);
} else {
	$layout_context = "manage-delete";
}

if (!isset($_SESSION['id'])) {
	header('location: home.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: home.php');
	exit();
}

// grab meeting id in order to edit this meeting
// if it's not there -> go back to index.php
if (!isset($_GET['id'])) {
	header('location: index.php');
}

// if user clicks UPDATE MEETING
if (is_post_request()) {

	delete_meeting($id);
	header('location: manage.php');

} else {
	$id = $_GET['id'];
}
	
$row = edit_meeting($id); 
$role = $_SESSION['admin'];
?>

<?php require '_includes/head.php'; ?>
<body>
<?php require '_includes/nav.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">

<div class="confirm warning">WARNING!</div>
<div class="manage-simple intro">

	<?php if ($role != 1 && $role != 2) { ?>
	<p><i class="fas fa-exclamation-triangle"></i><?php echo " " . $_SESSION['username'] . ", "; ?> Are you sure you really want to go through with this?</p>
<?php } else if ($role == 1) { ?>
	<p>Hey Me,</p>
	<p>Quit talking to yourself.</p>
<?php } else { ?>
	<p><i class="fas fa-exclamation-triangle"></i><?php echo " " . $_SESSION['username'] . ", "; ?> Are you sure you really want to go through with this?</p>
<?php } ?>
	<p class="logout">
		
	<?php
		if ($role == 1) { // my eyes only ?>
		<a href="<?= WWW_ROOT . '/odin.php' ?>">Home</a> | <a href="<?= 'manage.php' ?>">Dashboard</a> | <a href="logout.php">Logout</a> 
	<?php } else if ($role == 2) { ?>
		<a href="<?= WWW_ROOT . '/thor.php' ?>">Home</a> | <a href="<?= 'manage.php' ?>">Dashboard</a> | <a href="logout.php">Logout</a>
	<?php } else { ?>
		<a href="<?= WWW_ROOT ?>">Home</a> | <a href="<?= 'manage.php' ?>">Dashboard</a> | <a href="logout.php">Logout</a>
	<?php } ?>

	</p>

</div>
<div class="manage-simple empty">
	<h1 class="edit-h1">DELETE this Meeting</h1>

	<?php if ($row['id_user'] == $_SESSION['id'] || $_SESSION['admin'] == 1) { ?>

		<?php require '_includes/delete-glance.php'; ?>
		<div class="weekday-edit-wrap">
			<?php require '_includes/delete-details.php'; ?>
		</div><!-- .weekday-edit-wrap -->

	<?php } else if ($row['id_user'] == $_SESSION['id'] || $_SESSION['admin'] == 2) { ?>
			<p style="margin:1.5em 0 0 1em;">As an Admin you can do a lot of things but deleting other people's meetings is not one. You can &quot;downgrade&quot; this meeting to Draft or Private by using <a class="manage-edit spec" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><i class="far fa-edit"></i> Edit Meeting</a> instead.</p>
	<?php } else { ?>
		<p style="margin:1.5em 0 0 1em;">Either the Internet hiccuped and you ended up here or you're trying to be sneaky. Either way, hold your breath and try again.</p>
	<?php } ?>

</div><!-- .manage-simple-content -->

</div><!-- #manage-wrap -->
<?php require '_includes/footer.php'; ?>