<?php 

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

switch ($layout_context) {
case 'manage-update': '$id = $_GET[\'id\']';  break;
case 'manage-edit'  : 'if (!isset($_GET[\'id\'])) { header(\'location: index.php\'); }
					   $id = $_GET[\'id\'] ?? \'1\'';  break;
}

if (is_post_request()) {

$row = [];

switch ($layout_context) {
case 'manage-new':   	'$row[\'id_user\'] 	= $_SESSION[\'id\'];';  break;
case 'manage-update':   '$row[\'visible\'] 	= $_POST[\'visible\'] ?? \'\';';  break;
}

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


switch ($layout_context) {
case 'manage-update':  '$result = update_meeting($id, $row) if ($result === true) {
						header(\'location: manage_edit_review.php?id=\' . $id) 	} else { $errors = $result; } ';  break;

case 'manage-edit'  :  '$result = update_meeting($id, $row) if ($result === true) { 
						header(\'location: manage_edit_review.php?id=\' . $id) 	} else { $errors = $result; } ';  break;

case 'manage-new'   :  '$result = create_new_meeting($row) if ($result === true) {
						$new_id = mysqli_insert_id($db);
	    			    header(\'location: manage_new_review.php?id=\' . $new_id) 	} else { $errors = $result; } ';  break;
}

// close if (is_post_request())
switch ($layout_context) {
case 'manage-update': ' } ' ;  break;
case 'manage-new'   : ' } ' ;  break;
}

switch ($layout_context) {
case 'manage-edit'  :   ' } else { $subject_set = edit_meeting($id); } $row = edit_meeting($id);';  break;
}
?>

<?php require '_includes/head.php'; ?>
<body>
<?php require '_includes/nav.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">
	
<div class="manage-simple intro">
<?php echo "<p>Hey " . $_SESSION['username'] . ",</p>"; ?>

<?php
switch ($layout_context) {
case 'manage-update':   echo '<p>Looks like you\'ve got some corrections to make.</p>';  break;
case 'manage-edit':     echo '<p>Why are you so awesome?</p>
						   <p class="logout"><a href="manage.php">Go back to your meeting summary</a></p>';  break;
case 'manage-new':      echo '<p>Meetings save lives. <i class="fas fa-om"></i></p>
						   <p class="logout"><a href="manage.php">Go back to your meeting summary</a></p>';  break;
}
?>
	
</div><!-- .manage-simple intro -->
<div class="manage-simple empty">

<?php
switch ($layout_context) {
case 'manage-update':   echo '<h1 class="edit-h1">House Keeping</h1>';  break;
case 'manage-edit':     echo '<h1 class="edit-h1">Update this Meeting</h1>';  break;
case 'manage-new':      echo '<h1 class="edit-h1">Add a New Meeting</h1>';  break;
}
?>

<?php echo display_errors($errors); ?>


<?php
switch ($layout_context) {
case 'manage-update':   'if ($row[\'id_user\'] == $_SESSION[\'id\']) { ';  break;
case 'manage-edit':     'if ($row[\'id_user\'] == $_SESSION[\'id\']) { ';  break;
}
?>

<div class="weekday-edit-wrap">

	<?php
	switch ($layout_context) {
	case 'manage-update':   require '_includes/update-details.php';  break;
	case 'manage-edit':     require '_includes/edit-details.php';    break;
	case 'manage-new':      require '_includes/new-details.php';     break;
	}
	?>

</div><!-- .weekday-edit-wrap -->

<?php 
switch ($layout_context) {
case 'manage-update':  ' } else { <p style=\'margin:1.5em 0 0 1em;\'>Either the Internet hiccuped and you ended up here or you\'re trying to be sneaky. Either way, hold your breath and try again.</p> } ';  break;

case 'manage-edit':  ' } else { <p style=\'margin:1.5em 0 0 1em;\'>Either the Internet hiccuped and you ended up here or you\'re trying to be sneaky. Either way, hold your breath and try again.</p> } ';  break;
}
?>


</div><!-- .manage-simple empty -->
</div><!-- #manage-wrap -->
<?php require '_includes/footer.php'; ?>