<?php 
$layout_context = 'delete-mtg';

require_once 'config/initialize.php';

if (!isset($_SESSION['id'])) {
	$_SESSION['message'] = "You need to be logged in to access that page.";
	$_SESSION['alert-class'] = "alert-danger";
	header('location: ' . WWW_ROOT . '/login.php');
	exit();
}
if ((isset($_SESSION['id']) && !$_SESSION['verified']) || !isset($_GET['id'])) {
	header('location: ' . WWW_ROOT);
	exit();
}

// if user clicks 'DELETE'
if (is_post_request() && isset($_POST['delete-mtg'])) {

	delete_meeting($id);
	header('location: manage.php');
  exit();

} else {
	$id = $_GET['id'];
}
	
$row = edit_meeting($id); 

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

$role = $_SESSION['admin'];

require '_includes/head.php'; ?>

<body>
<?php preload_config($layout_context); ?>
<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-set-timezone.php'; ?>
<?php require '_includes/msg-extras.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<?php $theme = configure_theme(); mobile_bkg_config($theme); ?>
<div id="manage-wrap">

<?php 
  if  (
      is_owner($row) ||
      is_president() ||
      is_manager() && $row['role'] != 99 && $row['role'] != 80 && $row['role'] != 60 && $row['role'] != 40 
      ) {
?>

<div class="confirm warning">WARNING!</div>
<div class="manage-simple intro">

	<div class="watchout"><i class="fas fa-exclamation-triangle"></i><p><?= $_SESSION['username']; ?>, Keep in mind, you can always put this into draft so it's not visible anywhere. If you want it gone for good, scroll to bottom and "Delete" it into oblivion!</p></div>

<?php require '_includes/inner_nav.php'; ?>

</div>
<div class="manage-simple empty">
	<h1 class="edit-h1">DELETE this Meeting</h1>

		<?php 
    $pc = '1';
    $ic = '1'; 
    $mt = new DateTime($row['meet_time']); 
    require '_includes/daily-glance.php'; ?>
		<div class="weekday-edit-wrap">
			<?php require '_includes/meeting-details.php'; ?>
		</div><!-- .weekday-edit-wrap -->

	<?php } else { ?>

  <div class="manage-simple intro">
  <?php require '_includes/inner_nav.php'; ?>
  </div>

  <div style="margin:0 1em; max-width: 600px;">
    <p>This meegting belongs to another admin and therefore cannot be deleted by anyone but them.<br>
      <br>
    Hey wait a second... the bigger takeaway here is that, unless I missed hiding a delete button somewhere, you're trying to do something sneaky! :/</p>
  </div>


	<?php } ?>

</div><!-- .manage-simple-content -->

</div><!-- #manage-wrap -->
<?php require '_includes/footer.php'; ?>