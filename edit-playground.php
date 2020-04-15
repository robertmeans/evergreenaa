<?php $layout_context = "edit-meeting"; ?>
<?php
include 'error-reporting.php';

require_once 'controllers/authController.php';

?>
<?php include '_includes/head.php'; ?>

<body>
<?php require '_includes/nav.php'; ?>
	
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="landing">
	<div id="landing-content">

<?php

	// $subject_set = find_all_users();

	// while($username = mysqli_fetch_assoc($subject_set)) {
	// 	echo h($username["username"]) . " | " . h($username["email"]) . "<br>";
	// }
	// ------------------------------------------------
	// $subject_set = find_all_meetings();

	// while($meeting = mysqli_fetch_assoc($subject_set)) {
	// 	echo h($meeting["group_name"]) . " | " . h($meeting["add_note"]) . "<br>";
	// }
	// ------------------------------------------------
	$id = $_GET['id'] ?? '1';

	$meeting = find_meeting_by_id($id);
	echo h($meeting["meet_time"]) . " | " . h($meeting["group_name"]);
	// ------------------------------------------------




?>







	</div><!-- #landing-content -->
</div><!-- #landing -->

</body>

<?php require '_includes/footer.php'; ?>