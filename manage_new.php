<?php 
$layout_context = 'alt-manage';
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

if ($_SESSION['admin'] == 85 || $_SESSION['admin'] == 86) {
	header('location: ' . WWW_ROOT);
	exit();
}

if (!isset($_SESSION['id'])) {
	$_SESSION['message'] = "You need to be logged in to create a meeting.";
	$_SESSION['alert-class'] = "alert-danger";
	header('location: ' . WWW_ROOT . '/login.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: ' . WWW_ROOT);
	exit();
}

$role = $_SESSION['admin'];

if (is_post_request() && isset($_POST['review-mtg'])) {

$rando_num = rand(100,999);

$row = [];

	if (!empty($_FILES['file1']['name'])) {
		$uploaded_file1 = $_FILES['file1']['name'];
		$uploaded_size1 = $_FILES['file1']['size'];
		$ext1 = strtolower(pathinfo($uploaded_file1, PATHINFO_EXTENSION));
		$rename1 = $_SESSION['id'] . '_' . date('mdYHi') . '_01_' . $rando_num;

		$nf1 = $rename1 . '.' . $ext1;
		$fn1 = $_FILES['file1']['tmp_name'];
	} else {
		$nf1 = ''; // new_file
		$fn1 = ''; // file_name
	}

	if (!empty($_FILES['file2']['name'])) {
		$uploaded_file2 = $_FILES['file2']['name'];
		$uploaded_size2 = $_FILES['file2']['size'];
		$ext2 = strtolower(pathinfo($uploaded_file2, PATHINFO_EXTENSION));
		$rename2 = $_SESSION['id'] . '_' . date('mdYHi') . '_02_' . $rando_num;

		$nf2 = $rename2 . '.' . $ext2;
		$fn2 = $_FILES['file2']['tmp_name'];
	} else {
		$nf2 = ''; // new_file
		$fn2 = ''; // file_name
	}

	if (!empty($_FILES['file3']['name'])) {
		$uploaded_file3 = $_FILES['file3']['name'];
		$uploaded_size3 = $_FILES['file3']['size'];
		$ext3 = strtolower(pathinfo($uploaded_file3, PATHINFO_EXTENSION));
		$rename3 = $_SESSION['id'] . '_' . date('mdYHi') . '_03_' . $rando_num;

		$nf3 = $rename3 . '.' . $ext3;
		$fn3 = $_FILES['file3']['tmp_name'];
	} else {
		$nf3 = ''; // new_file
		$fn3 = ''; // file_name
	}	

	if (!empty($_FILES['file4']['name'])) {
		$uploaded_file4 = $_FILES['file4']['name'];
		$uploaded_size4 = $_FILES['file4']['size'];
		$ext4 = strtolower(pathinfo($uploaded_file4, PATHINFO_EXTENSION));
		$rename4 = $_SESSION['id'] . '_' . date('mdYHi') . '_04_' . $rando_num;

		$nf4 = $rename4 . '.' . $ext4;
		$fn4 = $_FILES['file4']['tmp_name'];
	} else {
		$nf4 = ''; // new_file
		$fn4 = ''; // file_name
	}		

$row['id_user'] = $_SESSION['id'];

$row['mtg_tz'] = $_POST['mtg-tz'];






if (strtotime($_POST['meet_time'])) {
  $meettime = $_POST['meet_time'];
  $fmt = new DateTime($meettime);
  $row['db_time'] = $fmt->format('Hi');
} else {
  $_POST['meet_time'] = '';
}







$row['db_sun'] = $_POST['sun'] ?? '';
$row['db_mon'] = $_POST['mon'] ?? '';
$row['db_tue'] = $_POST['tue'] ?? '';
$row['db_wed'] = $_POST['wed'] ?? '';
$row['db_thu'] = $_POST['thu'] ?? '';
$row['db_fri'] = $_POST['fri'] ?? '';
$row['db_sat'] = $_POST['sat'] ?? '';

// use this to populate field if there are errors on pg ->
// comment when testing
$row['meet_time'] = $_POST['meet_time'];
$row['sun'] = $_POST['sun'] ?? '';
$row['mon'] = $_POST['mon'] ?? '';
$row['tue'] = $_POST['tue'] ?? '';
$row['wed'] = $_POST['wed'] ?? '';
$row['thu'] = $_POST['thu'] ?? '';
$row['fri'] = $_POST['fri'] ?? '';
$row['sat'] = $_POST['sat'] ?? '';

$row['group_name'] 		= $_POST['group_name'] 									?? '';
$row['meet_phone'] 		= preg_replace('/[^0-9]/', '', $_POST['meet_phone']) 	?? '';
$row['one_tap'] = $_POST['one_tap'] ?? '';
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
$row['link1'] 		= trim($_POST['link1'])										?? '';
$row['link2'] 		= trim($_POST['link2'])										?? '';
$row['link3'] 		= trim($_POST['link3'])										?? '';
$row['link4'] 		= trim($_POST['link4'])										?? '';

$row['hid_f1'] = '';
$row['hid_f2'] = '';
$row['hid_f3'] = '';
$row['hid_f4'] = '';

$row['add_note'] 		= $_POST['add_note'] 									?? '';

	$result = create_new_meeting($row, $nf1, $fn1, $nf2, $fn2, $nf3, $fn3, $nf4, $fn4);

	if ($result === true) {
		$new_id = mysqli_insert_id($db);
	    header('location: manage_new_review.php?id=' . $new_id);
	} else {
		$errors = $result;
	}
} // end > if (is_post_request()) {

require '_includes/head.php'; ?>

<body>
<?php preload_config($layout_context); ?>
<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-set-timezone.php'; ?>
<?php require '_includes/msg-extras.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<?php require '_includes/lat-long-instructions.php'; ?>
<?php require '_includes/descriptive-location-msg.php'; ?>
<?php require '_includes/pdf-upload-txt.php'; ?>
<?php require '_includes/link-label-txt.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">
	
<div class="manage-simple intro">

	<?php if ($role != 1 && $role != 2) { ?>
	<p>Meetings save lives. <i class="fas fa-om"></i></p>
<?php } else if ($role == 1) { ?>
	<p>Hey Me,</p>
	<p>Quit talking to yourself.</p>
<?php } else { ?>
	<p>Hey<?= ' ' . $_SESSION['username'] . ',' ?></p>
	<p>Meetings save lives. <i class="fas fa-om"></i></p>
<?php } ?>
<?php require '_includes/inner_nav.php'; ?>

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