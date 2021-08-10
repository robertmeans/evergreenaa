<?php $layout_context = "manage-delete";

require_once 'config/initialize.php';
require_once 'config/verify_admin.php';
if ($_SESSION['admin'] == 85 || $_SESSION['admin'] == 86) {
	header('location: ' . WWW_ROOT);
	exit();
}

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

	$sql = "DELETE FROM meetings ";
	$sql .= "WHERE id_mtg='" . $id . "' ";
	$sql .= "LIMIT 1";

	$result = mysqli_query($db, $sql);

	if($result) {
		header('location: manage.php');
	} else {
		// delete failed
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
	}

}
	

?>