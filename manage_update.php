<?php $layout_context = "manage-update";

require_once 'config/initialize.php';

// off for local testing
if (!isset($_SESSION['id'])) {
	header('location: home.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: home.php');
	exit();
}

$id = $_GET['id'];

if (is_post_request()) {

$row = [];
$row['visible'] 		= $_POST['visible'] 									?? '';
$row['sun'] 			= $_POST['sun'] 										?? '';
$row['mon'] 			= $_POST['mon'] 										?? '';
$row['tue'] 			= $_POST['tue'] 										?? '';
$row['wed'] 			= $_POST['wed'] 										?? '';
$row['thu'] 			= $_POST['thu'] 										?? '';
$row['fri'] 			= $_POST['fri'] 										?? '';
$row['sat']				= $_POST['sat'] 										?? '';
$row['meet_time']		= $_POST['meet_time']									?? '';
$row['group_name'] 		= $_POST['group_name'] 									?? '';
$row['meet_phone'] 		= preg_replace('/[^0-9]/', '', $_POST['meet_phone']) 	?? '';
$row['meet_id']			= $_POST['meet_id'] 									?? '';
$row['meet_pswd'] 		= $_POST['meet_pswd'] 									?? '';
$row['meet_url'] 		= $_POST['meet_url'] 									?? '';
$row['meet_addr'] 		= $_POST['meet_addr'] 									?? '';
$row['meet_desc'] 		= $_POST['meet_desc'] 									?? '';
$row['dedicated_om'] 	= $_POST['dedicated_om'] 								?? '';
$row['code_b'] 			= $_POST['code_b'] 										?? '';
$row['code_d'] 			= $_POST['code_d'] 										?? '';
$row['code_o'] 			= $_POST['code_o'] 										?? '';
$row['code_w'] 			= $_POST['code_w'] 										?? '';
$row['code_beg'] 		= $_POST['code_beg'] 									?? '';
$row['code_h'] 			= $_POST['code_h'] 										?? '';
$row['code_sp'] 		= $_POST['code_sp'] 									?? '';
$row['code_c'] 			= $_POST['code_c'] 										?? '';
$row['code_m'] 			= $_POST['code_m'] 										?? '';
$row['code_ss'] 		= $_POST['code_ss'] 									?? '';
$row['month_speaker'] 	= $_POST['month_speaker'] 								?? '';
$row['potluck'] 		= $_POST['potluck']										?? '';
$row['add_note'] 		= $_POST['add_note'] 									?? '';

	$result = update_meeting($id, $row);

	if ($result === true) {
	    header('location: manage_edit_review.php?id=' . $id);
	} else {
		$errors = $result;
	}
}

$row = edit_meeting($id);

?>

<?php require '_includes/head.php'; ?>
<body>
<?php require '_includes/nav.php'; ?>
<?php require '_includes/lat-long-instructions.php'; ?>
<?php require '_includes/descriptive-location-msg.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">
	
<div class="manage-simple intro">
	<?php echo "<p>Hey " . $_SESSION['username'] . ",</p>"; ?>
	<p>Looks like you've got some corrections to make.</p>
</div>
<div class="manage-simple empty">
	<h1 class="edit-h1">House Keeping</h1>
	<?php echo display_errors($errors); ?>

	<?php if ($row['id_user'] == $_SESSION['id']) { ?>

		<div class="weekday-edit-wrap">
			<?php require '_includes/update-details.php'; ?>
		</div><!-- .weekday-wrap -->

	<?php } else { echo "<p style=\"margin:1.5em 0 0 1em;\">Either the Internet hiccuped and you ended up here or you're trying to be sneaky. Either way, hold your breath and try again.</p>"; } ?>		

</div>
</div><!-- #manage-wrap -->
<?php require '_includes/footer.php'; ?>