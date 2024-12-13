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
<?php require '_includes/messages.php'; ?>
<?php $theme = configure_theme(); mobile_bkg_config($theme); ?>
<div id="manage-wrap">
	
<div class="confirm">LAST PASS</div>	
<div class="manage-simple intro">

  <p>At this point you're done, unless you'd like to change the audience or put this into Draft. You know the drill - scroll to the bottom or click the <a class="manage-edit inline" href="manage_edit.php?id=<?= h(u($id)); ?>"><i class="far fa-edit"></i> edit button</a> to make any additional changes.</p>

<?php require '_includes/inner_nav.php'; ?>

</div>
<div class="manage-simple review">
	<h1>Quick view</h1>
		
		<?php 

  if  (
      is_owner($row) ||
      is_president() ||
      is_manager() && $row['role'] != 99 && $row['role'] != 80 && $row['role'] != 60 && $row['role'] != 40 
      ) {

      $pc = '1';
      $ic = '1'; 
      $mt = new DateTime($row['meet_time']);
      require '_includes/daily-glance.php'; ?>
			<div class="weekday-edit-wrap">
				<?php require '_includes/meeting-details.php'; ?>

			</div><!-- .weekday-wrap -->
			<a class="done" href="manage.php">DONE</a>
			
		<?php } else { echo "<p style=\"margin-top:1.5em;\">Quit trying to be sneaky.</p>"; } ?>
</div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>