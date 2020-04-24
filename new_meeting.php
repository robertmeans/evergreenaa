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



if (is_post_request()) {

$id 			= $_SESSION['id']				 ;
$groupname 		= $_POST['groupname'] 		?? '';
$sun 			= $_POST['sun'] 			?? '';
$mon 			= $_POST['mon'] 			?? '';
$tue 			= $_POST['tue'] 			?? '';
$wed 			= $_POST['wed'] 			?? '';
$thu 			= $_POST['thu'] 			?? '';
$fri 			= $_POST['fri'] 			?? '';
$sat 			= $_POST['sat'] 			?? '';
$time 			= $_POST['mtgHour'] 		?? '';
$ampm 			= $_POST['ampm'] 			?? '';
$phone 			= $_POST['phone'] 			?? '';
$idnum 			= $_POST['idnum'] 			?? '';
$meetingpswd 	= $_POST['meetingpswd'] 	?? '';
$meeturl 		= $_POST['meeturl'] 		?? '';
$dedicated_om 	= $_POST['dedicated_om'] 	?? '';
$code_o 		= $_POST['code_o'] 			?? '';
$code_w 		= $_POST['code_w'] 			?? '';
$code_m 		= $_POST['code_m'] 			?? '';
$code_c 		= $_POST['code_c'] 			?? '';
$code_beg 		= $_POST['code_beg'] 		?? '';
$code_h 		= $_POST['code_h'] 			?? '';
$code_d 		= $_POST['code_d'] 			?? '';
$code_b 		= $_POST['code_b'] 			?? '';
$code_ss 		= $_POST['code_ss'] 		?? '';
$code_sp 		= $_POST['code_sp'] 		?? '';
$month_speaker 	= $_POST['month_speaker'] 	?? '';
$potluck 		= $_POST['potluck']			?? '';
$addnotes 		= $_POST['addnotes'] 		?? '';

	$result = create_new_meeting($id, $groupname, $sun, $mon, $tue, $wed, $thu, $fri, $sat, $time, $ampm, $phone, $idnum, $meetingpswd, $meeturl, $dedicated_om, $code_o, $code_w, $code_m, $code_c, $code_beg, $code_h, $code_d, $code_b, $code_ss, $code_sp, $month_speaker, $potluck, $addnotes);

	$new_id = mysqli_insert_id($db);
    header('location: manage_edit_review.php?id=' . $new_id);

}

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
		<h1 class="edit-h1">Create New Meeting</h1>
		<?php echo display_errors($errors); ?>
 
			<?php
				
				// $row = mysqli_fetch_assoc($subject_set);

				// if ($row > 0) {
					//while ($row = mysqli_fetch_assoc($subject_set)) {  

					// require '_functions/manage-edit-glance.php'; ?>
					<div class="weekday-edit-wrap">
						<?php require '_functions/new-meeting-details.php'; ?>
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