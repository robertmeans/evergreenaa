<?php $layout_context = "manage-new";

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

if (is_post_request()) {

$row = [];
$row['id_user'] 		= $_SESSION['id']				 							 ;
$row['sun'] 			= $_POST['sun'] 										?? '';
$row['mon'] 			= $_POST['mon'] 										?? '';
$row['tue'] 			= $_POST['tue'] 										?? '';
$row['wed'] 			= $_POST['wed'] 										?? '';
$row['thu'] 			= $_POST['thu'] 										?? '';
$row['fri'] 			= $_POST['fri'] 										?? '';
$row['sat']				= $_POST['sat'] 										?? '';
$row['meet_time'] 		= $_POST['meet_time'] 									?? '';
$row['group_name'] 		= $_POST['group_name'] 									?? '';
$row['meet_phone'] 		= preg_replace('/[^0-9]/', '', $_POST['meet_phone']) 	?? '';
$row['meet_id']			= $_POST['meet_id'] 									?? '';
$row['meet_pswd'] 		= $_POST['meet_pswd'] 									?? '';
$row['meet_url'] 		= $_POST['meet_url'] 									?? '';
$row['meet_addr'] 		= $_POST['meet_addr'] 									?? '';
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

	$result = create_new_meeting($row);

	if ($result === true) {
		$new_id = mysqli_insert_id($db);
	    header('location: manage_new_review.php?id=' . $new_id);
	} else {
		$errors = $result;
	}
}

?>

<?php require '_includes/head.php'; ?>
<body>
<?php require '_includes/nav.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">
	
<div class="manage-simple intro">
	<?php echo "<p>Hey " . $_SESSION['username'] . ",</p>"; ?>
	<p>Meetings save lives. <i class="fas fa-om"></i></p>
	<p class="logout"><a href="home_private.php">Home</a> | <a href="manage.php">Dashboard</a></p>
</div>
<div class="manage-simple empty">
	<h1 class="edit-h1">Add a New Meeting</h1>
	<?php echo display_errors($errors); ?>

		<div class="weekday-edit-wrap">
			<?php require '_includes/new-details.php'; ?>
		</div><!-- .weekday-wrap -->

</div>
</div><!-- #manage-wrap -->
<?php require '_includes/footer.php'; ?>