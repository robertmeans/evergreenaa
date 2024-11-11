<?php 
$layout_context = 'alt-manage';
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

if ($_SESSION['admin'] == 85 || $_SESSION['admin'] == 86) {
	header('location: ' . WWW_ROOT);
	exit();
}

if (!isset($_SESSION['id'])) {
	header('location: ' . WWW_ROOT);
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: ' . WWW_ROOT);
	exit();
}

$id = $_GET['id'];

// If validation fails -> this page is rendered
if (is_post_request()) {

$rando_num = rand(100,999);
$row = [];
$url = $_POST['themeurl'];
$themeChange = $_POST['ctpg-hf'];

 	// if everything's good: file selected + label present
	if (!empty($_FILES['file1']['name'])) {
		$uploaded_file1 = $_FILES['file1']['name'];
		$uploaded_size1 = $_FILES['file1']['size'];
		$ext1 = strtolower(pathinfo($uploaded_file1, PATHINFO_EXTENSION));
		$rename1 = $_SESSION['id'] . '_' . date('mdYHi') . '_01_' . $rando_num;

		$nf1 = $rename1 . '.' . $ext1;
		$fn1 = $_FILES['file1']['tmp_name'];
	} 
	// whoops, they added a label but no file to upload or in hidden field (they're not renaming)
	if ((empty($_FILES['file1']['name'])) && (isset($_POST['hid_f1']) && isset($_POST['link1'])))  {
		$nf1 = $_POST['hid_f1']; 
		$fn1 = ''; 
	} 
	// to catch no file/label OR if they deleted the the label then delete the file reference too
	if ((empty($_FILES['file1']['name'])) && (!isset($_POST['hid_f1']) && !isset($_POST['link1']))) {
		$nf1 = ''; 
		$fn1 = ''; 	
	}

	if (!empty($_FILES['file2']['name'])) {
		$uploaded_file2 = $_FILES['file2']['name'];
		$uploaded_size2 = $_FILES['file2']['size'];
		$ext2 = strtolower(pathinfo($uploaded_file2, PATHINFO_EXTENSION));
		$rename2 = $_SESSION['id'] . '_' . date('mdYHi') . '_02_' . $rando_num;

		$nf2 = $rename2 . '.' . $ext2;
		$fn2 = $_FILES['file2']['tmp_name'];
	} 
	if ((empty($_FILES['file2']['name'])) && (isset($_POST['hid_f2']) && isset($_POST['link2'])))  {
		$nf2 = $_POST['hid_f2']; 
		$fn2 = ''; 
	} 
	if ((empty($_FILES['file2']['name'])) && (!isset($_POST['hid_f2']) && !isset($_POST['link2']))) {
		$nf2 = ''; 
		$fn2 = ''; 	
	}

	if (!empty($_FILES['file3']['name'])) {
		$uploaded_file3 = $_FILES['file3']['name'];
		$uploaded_size3 = $_FILES['file3']['size'];
		$ext3 = strtolower(pathinfo($uploaded_file3, PATHINFO_EXTENSION));
		$rename3 = $_SESSION['id'] . '_' . date('mdYHi') . '_03_' . $rando_num;

		$nf3 = $rename3 . '.' . $ext3;
		$fn3 = $_FILES['file3']['tmp_name'];
	} 
	if ((empty($_FILES['file3']['name'])) && (isset($_POST['hid_f3']) && isset($_POST['link3'])))  {
		$nf3 = $_POST['hid_f3']; 
		$fn3 = ''; 
	} 
	if ((empty($_FILES['file3']['name'])) && (!isset($_POST['hid_f3']) && !isset($_POST['link3']))) {
		$nf3 = ''; 
		$fn3 = ''; 	
	}

	if (!empty($_FILES['file4']['name'])) {
		$uploaded_file4 = $_FILES['file4']['name'];
		$uploaded_size4 = $_FILES['file4']['size'];
		$ext4 = strtolower(pathinfo($uploaded_file4, PATHINFO_EXTENSION));
		$rename4 = $_SESSION['id'] . '_' . date('mdYHi') . '_04_' . $rando_num;

		$nf4 = $rename4 . '.' . $ext4;
		$fn4 = $_FILES['file4']['tmp_name'];
	} 
	if ((empty($_FILES['file4']['name'])) && (isset($_POST['hid_f4']) && isset($_POST['link4'])))  {
		$nf4 = $_POST['hid_f4']; 
		$fn4 = ''; 
	} 
	if ((empty($_FILES['file4']['name'])) && (!isset($_POST['hid_f4']) && !isset($_POST['link4']))) {
		$nf4 = ''; 
		$fn4 = ''; 	
	}

$row['visible'] = $_POST['visible'] ?? '';
$row['mtg_tz'] = $_POST['mtg-tz'] ?? '';


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
if (isset($_POST['meet_time'])) {
	$row['meet_time'] = $_POST['meet_time'];
} else {
	$row['meet_time'] = '';
}

$row['sun'] = $_POST['sun'] ?? '';
$row['mon'] = $_POST['mon'] ?? '';
$row['tue'] = $_POST['tue'] ?? '';
$row['wed'] = $_POST['wed'] ?? '';
$row['thu'] = $_POST['thu'] ?? '';
$row['fri'] = $_POST['fri'] ?? '';
$row['sat'] = $_POST['sat'] ?? '';


$row['group_name'] 		= $_POST['group_name'] 									?? '';

if (isset($_POST['meet_phone'])) {
	$row['meet_phone'] 		= preg_replace('/[^0-9]/', '', $_POST['meet_phone']) 	?? '';
} else {
	$row['meet_phone'] 		= '';
}
$row['one_tap']			= $_POST['one_tap'] 									?? '';
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

$row['hid_f1'] 		= $_POST['hid_f1']										?? '';

if (isset($_POST['link1'])) {
	$row['link1'] 		= trim($_POST['link1'] ?? '')										?? '';
} else {
	$row['link1'] = '';
}

$row['hid_f2'] 		= $_POST['hid_f2']										?? '';

if (isset($_POST['link2'])) {
	$row['link2'] 		= trim($_POST['link2'] ?? '')										?? '';
} else {
	$row['link2'] = '';
}
$row['hid_f3'] 		= $_POST['hid_f3']										?? '';

if (isset($_POST['link3'])) {
	$row['link3'] 		= trim($_POST['link3'] ?? '')										?? '';
} else {
	$row['link3'] = '';
}

$row['hid_f4'] 		= $_POST['hid_f4']										?? '';

if (isset($_POST['link4'])) {
	$row['link4'] 		= trim($_POST['link4'] ?? '')										?? '';
} else {
	$row['link4'] = '';
}

$row['add_note'] 		= $_POST['add_note'] 									?? '';


  if ($themeChange === 'notset') {

  	$result = update_meeting($id, $row, $nf1, $fn1, $nf2, $fn2, $nf3, $fn3, $nf4, $fn4);

  	if ($result === true) {
  		$issue_removed = remove_issue($id); // delete any instances from issues table
  		if ($result === true) {
  	  	header('location: manage_edit_review.php?id=' . $id);
  		  } else {
  			$errors = $result;
  		}
  	} else {
  		$errors = $result;
  	}

  } else {

    $errors = theme_switch_on_form_page($row, $nf1, $fn1, $nf2, $fn2, $nf3, $fn3, $nf4, $fn4);

    if ($user_id != '1' && $_SERVER['REMOTE_ADDR'] !== '174.51.162.17') { /* exclude me from count */
      $date = new DateTime('now', new DateTimeZone('America/Denver'));
      $now = $date->format("H:i D, m.d.y");

      if ($theme === '0') { $color = 'Dark'; } else { $color = 'Bright'; }
      monitor_theme_usage($now, $user_id, $color);
    }
    
    $result = set_theme($themeChange, $user_id);

    if ($result === true) {
      $_SESSION['db-theme'] = $themeChange;
      
    } else {
      $errors = $result;
    }

  }

}

$row = edit_meeting($id);
$role = $_SESSION['admin'];

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
<?php require '_includes/lat-long-instructions.php'; ?>
<?php require '_includes/descriptive-location-msg.php'; ?>
<?php require '_includes/pdf-upload-txt.php'; ?>
<?php require '_includes/link-label-txt.php'; ?>
<?php $theme = configure_theme(); mobile_bkg_config($theme); ?>
<div id="manage-wrap">
	<?php // print_r($row); ?>
<div class="manage-simple intro">
	<?php if (($row['id_user'] == $_SESSION['id']) || ($role != 1 && $role != 2 && $role != 3)) { ?>
	<p>Hey<?= ' ' . $_SESSION['username'] . ',' ?></p>
<?php } else if ($role == 1) { ?>
	<p>Hey Me,</p>
	<p>Quit talking to yourself.</p>
<?php } else { ?>
	<p>Hey<?= ' ' . $_SESSION['username'] . ',' ?></p>
	<p>Clean it up!</p>
<?php } ?>
<?php require '_includes/inner_nav.php'; ?>
</div>
<div class="manage-simple empty">
	<?php if (!empty(display_errors($errors))) { ?>
		<h1 class="edit-h1">Update this Meeting</h1>
		<?php if ($themeChange === 'notset') { echo display_errors($errors); } else { echo display_theme_errors($errors); } ?>
	<?php } else { ?>
		<h1 class="edit-h1">Edit this meeting</h1>
	<?php } ?>

	<?php 
	$result = display_issues($id);
	$issues_found = mysqli_num_rows($result);

	if ($issues_found > 0) { 
		if ($issues_found == 1) { ?>
		<p class="address-this">Please resolve the following issue that was submitted by another member:</p>
	<?php } else { ?>
		<p class="address-this">Please resolve the following issues that were submitted by other members.</p>

		<?php }
		while($rowz = mysqli_fetch_assoc($result)) { ?>
			<p class="display-issues"><?= nl2br($rowz['the_issue']); ?></p>
	<?php 
		}
	}
	?>

	<?php if (($row['id_user'] == $_SESSION['id']) || ($role == 1 || $role == 2 || $role == 3)) { ?>

		<div class="weekday-edit-wrap">
			<?php require '_includes/edit-details.php'; ?>
		</div><!-- .weekday-wrap -->

	<?php } else { echo "<p style=\"margin:1.5em 0 0 1em;\">Either the Internet hiccuped and you ended up here or you're trying to be sneaky. Either way, hold your breath and try again.</p>"; } ?>		

</div>
</div><!-- #manage-wrap -->
<?php require '_includes/footer.php'; ?>