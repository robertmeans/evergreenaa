<?php 
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';
if ($_SESSION['admin'] == 85 || $_SESSION['admin'] == 86) {
	header('location: ' . WWW_ROOT);
	exit();
}

if ($_SESSION['admin'] == 1) {
	$layout_context = "manage-edit-rev-odin";
} else if ($_SESSION['admin'] == 2) {
	$layout_context = "manage-edit-rev-thor";
} else if ($_SESSION['admin'] == 86) {
	header('location: ' . WWW_ROOT);
} else {
	$layout_context = "manage-edit-rev";
}

if (!isset($_SESSION['id'])) {
	header('location: home.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: home.php');
	exit();
}

if (!isset($_GET['id'])) {
	header('location: index.php');
}

$id = $_GET['id'];
$role = $_SESSION['admin'];

$row = edit_meeting($id);
?>

<?php require '_includes/head.php'; ?>
<body>
<?php require '_includes/nav.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">
	
<div class="confirm">TEST & CONFIRM!</div>	
<div class="manage-simple intro">

	<?php if ($role != 1 && $role != 2) { ?>
	<p>Take a look. Is everything the way you want it? If not, click the <a class="manage-edit inline" href="manage_edit.php?id=<?= h(u($id)); ?>"><i class="far fa-edit"></i> edit button</a> and polish this sucker up! Or save it for later.</p>
<?php } else if ($role == 1) { ?>
	<p>Hey Me,</p>
	<p>Quit talking to yourself.</p>
<?php } else { ?>
	<p>Hey<?= ' ' . $_SESSION['username'] . ',' ?></p>
	<p>Make sure everything's just right.</p>
<?php } ?>
	<p class="logout">
		
	<?php
		if ($role == 1) { // my eyes only ?>
		<a href="<?= WWW_ROOT . '/odin.php' ?>">Home</a> | <a href="<?= 'manage.php' ?>">Dashboard</a> | <a href="logout.php">Logout</a> 
	<?php } else if ($role == 2) { ?>
		<a href="<?= WWW_ROOT . '/admin.php' ?>">Home</a> | <a href="<?= 'manage.php' ?>">Dashboard</a> | <a href="logout.php">Logout</a>
	<?php } else { ?>
		<a href="<?= WWW_ROOT ?>">Home</a> | <a href="<?= 'manage.php' ?>">Dashboard</a> | <a href="logout.php">Logout</a>
	<?php } ?>

	</p>

</div>
<div class="manage-simple review">
	<h1>Quick view</h1>
		
		<?php if ($row['id_user'] == $_SESSION['id'] || $_SESSION['admin'] == 1 || $_SESSION['admin'] == 2) { ?>

			<?php require '_includes/review-glance.php'; ?>
			<div class="weekday-edit-wrap">
				<?php require '_includes/review-details.php'; ?>

			</div><!-- .weekday-wrap -->
			<a class="done" href="manage.php">DONE</a>
			
		<?php } else { echo "<p style=\"margin-top:1.5em;\">Quit trying to be sneaky.</p>"; } ?>
</div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>