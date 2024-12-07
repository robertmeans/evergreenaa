<?php 
$layout_context = 'alt-manage';
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

if ($_SESSION['admin'] == 85 || $_SESSION['admin'] == 86) {
	header('location: ' . WWW_ROOT);
	exit();
}

if (!isset($_SESSION['id'])) {
	$_SESSION['message'] = "You need to be logged in to access that page.";
	$_SESSION['alert-class'] = "alert-danger";
	header('location: ' . WWW_ROOT . '/login.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: ' . WWW_ROOT);
	exit();
}

if (!isset($_GET['id'])) {
	header('location: ' . WWW_ROOT);
}

$id = $_GET['id'];
$id_user = $_SESSION['id'];
$role = $_SESSION['admin'];

$row = edit_meeting($id);

// get days sorted based on TZ
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

require '_includes/head.php'; ?>

<body>
<?php preload_config($layout_context); ?>
<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-set-timezone.php'; ?>
<?php require '_includes/msg-extras.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<?php $theme = configure_theme(); mobile_bkg_config($theme); ?>
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
<?php require '_includes/inner_nav.php'; ?>

</div>
<div class="manage-simple review">
	<h1>Quick view</h1>
		
		<?php if ($row['id_user'] == $_SESSION['id'] || $_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3) { ?>
      <?php $pc = '001'; ?>
			<?php require '_includes/review-glance.php'; ?>
			<div class="weekday-edit-wrap">
				<?php require '_includes/meeting-details.php'; ?>

			</div><!-- .weekday-wrap -->
			<a class="done" href="manage.php">DONE</a>
			
		<?php } else { echo "<p style=\"margin-top:1.5em;\">Quit trying to be sneaky.</p>"; } ?>
</div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>