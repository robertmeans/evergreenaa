<?php $layout_context = "manage-edit"; ?>
<?php 
include 'error-reporting.php';

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

// grab meeting id in order to edit this meeting
// if it's not there -> go back to index.php
if (!isset($_GET['id'])) {
	header('location: index.php');
}

$id = $_GET['id'];

// if user clicks UPDATE MEETING
if (is_post_request()) {

	$row = []; 
	$row['mon'] 			= $_POST['mon'] 										?? ''; 
	$row['tue'] 			= $_POST['tue'] 										?? ''; 
	$row['wed'] 			= $_POST['wed'] 										?? ''; 
	$row['thu'] 			= $_POST['thu'] 										?? ''; 
	$row['fri'] 			= $_POST['fri'] 										?? ''; 
	$row['sat'] 			= $_POST['sat'] 										?? ''; 
	$row['sun'] 			= $_POST['sun'] 										?? '';
	$row['meet_time'] 		= ($_POST['mtgHour'] . $_POST['mtgMinute']) 			?? '';
	$row['am_pm'] 			= $_POST['am_pm'] 										?? ''; 
	$row['group_name'] 		= $_POST['group_name'] 									?? '';
	$row['meet_phone'] 		= preg_replace('/[^0-9]/', '', $_POST['meet_phone']) 	?? '';
	$row['meet_id'] 		= $_POST['meet_id'] 									?? ''; 
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
	$row['potluck'] 		= $_POST['potluck'] 									?? ''; 
	$row['add_note'] 		= $_POST['add_note'] 									?? ''; 

	$result = update_meeting($id, $row);

	if ($result === true) {
		header('location: manage_edit_review.php?id=' . $id);
	} else {
		$errors = $result;
		//var_dump($errors);
		// $subject_set = edit_meeting($id);
	}

	} else {
		$subject_set = edit_meeting($id);
	}
	
	$row = edit_meeting($id);
?>

<?php require '_includes/head.php'; ?>
<body>
<?php require '_includes/nav.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">
	
	<div class="manage-simple-intro">
		<?php echo "<p>Hey " . $_SESSION['username'] . ",</p>"; ?>
		<p>You look nice today. <i class="far fa-smile"></i></p>
	</div>
	<div class="manage-simple-content">
		<h1 class="edit-h1">Update this Meeting</h1>
		<?php echo display_errors($errors); ?>
 
			<?php
				
				// $row = mysqli_fetch_assoc($subject_set);

				// if ($row > 0) {
					//while ($row = mysqli_fetch_assoc($subject_set)) {  

					// require '_functions/manage-edit-glance.php'; ?>
					<div class="weekday-edit-wrap">
						<?php require '_functions/edit-meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
						// mysqli_free_result($row);
					// } else {
						// echo "<p>How did you get here? Seriously, could you please copy the URL and email it to me at the bottom of the page? I mean, if you did something silly like add a random number at the end of the URL to see what would happen then I understand how you got here. But otherwise...?</p>";
					// }
				//}
					
			?>
	</div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>