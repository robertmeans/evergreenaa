<?php $layout_context = "manage-update";

require_once 'config/initialize.php';

// off for local testing
if (!isset($_SESSION['id'])) {
	header('location: ' . WWW_ROOT);
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: ' . WWW_ROOT);
	exit();
}

$id = $_GET['id'];

if (is_post_request()) {

$row = [];
$row['visible'] = $_POST['visible'] ?? '';

	$result = finalize_new_meeting($id, $row);

	if ($result === true) {
	    header('location: manage.php');
	} else {
		$errors = $result;
	}
}

?>