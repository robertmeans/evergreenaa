<?php $layout_context = "manage-update"; ?>
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