<?php 
include 'error-reporting.php';

require_once 'config/initialize.php';

if (is_post_request()) {

$row = [];
$row['$id_user'] 		= $_SESSION['id']				 							 ;
$row['$sun'] 			= $_POST['sun'] 										?? '';
$row['$mon'] 			= $_POST['mon'] 										?? '';
$row['$tue'] 			= $_POST['tue'] 										?? '';
$row['$wed'] 			= $_POST['wed'] 										?? '';
$row['$thu'] 			= $_POST['thu'] 										?? '';
$row['$fri'] 			= $_POST['fri'] 										?? '';
$row['$sat']				= $_POST['sat'] 										?? '';
$row['$meet_time'] 		= (preg_replace('/[^0-9]/', '', $_POST['mtgHour']) . preg_replace('/[^0-9]/', '', $_POST['mtgMinute'])) 			?? '';

$row['$mtgHour']			= preg_replace('/[^0-9]/', '', $_POST['mtgHour'])										?? '';
$row['$mtgMinute']		= preg_replace('/[^0-9]/', '', $_POST['mtgMinute'])									?? '';

// $row['$mtgMinute']		= $_POST['mtgMinute']									?? '';
$row['$am_pm'] 			= $_POST['am_pm'] 										?? '';
$row['$group_name'] 		= $_POST['group_name'] 									?? '';
$row['$meet_phone'] 		= preg_replace('/[^0-9]/', '', $_POST['meet_phone']) 	?? '';
$row['$meet_id']			= $_POST['meet_id'] 									?? '';
$row['$meet_pswd'] 		= $_POST['meet_pswd'] 									?? '';
$row['$meeturl'] 		= $_POST['meeturl'] 									?? '';
$row['$dedicated_om'] 	= $_POST['dedicated_om'] 								?? '';
$row['$code_b'] 			= $_POST['code_b'] 										?? '';
$row['$code_d'] 			= $_POST['code_d'] 										?? '';
$row['$code_o'] 			= $_POST['code_o'] 										?? '';
$row['$code_w'] 			= $_POST['code_w'] 										?? '';
$row['$code_beg'] 		= $_POST['code_beg'] 									?? '';
$row['$code_h'] 			= $_POST['code_h'] 										?? '';
$row['$code_sp'] 		= $_POST['code_sp'] 									?? '';
$row['$code_c'] 			= $_POST['code_c'] 										?? '';
$row['$code_m'] 			= $_POST['code_m'] 										?? '';
$row['$code_ss'] 		= $_POST['code_ss'] 									?? '';
$row['$month_speaker'] 	= $_POST['month_speaker'] 								?? '';
$row['$potluck'] 		= $_POST['potluck']										?? '';
$row['$add_note'] 		= $_POST['add_note'] 									?? '';

	$result = create_new_meeting($row);

	if ($result === true) {
		$new_id = mysqli_insert_id($db);
	    header('location: manage_edit_review.php?id=' . $new_id);
	} else {
		$errors = $result;
	}
}

?>