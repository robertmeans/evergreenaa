<?php $layout_context = "edit-meeting"; ?>
<?php
include 'error-reporting.php';

require_once 'controllers/authController.php';

?>
<?php include '_includes/head.php'; ?>

<body>
<?php require '_includes/nav.php'; ?>
	
<img class="background-image" src="../_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="landing">
	<div id="landing-content">



<?php
$mtg = $_GET['mtg'];


$sql = "SELECT * FROM meetings WHERE id='$mtg' LIMIT 1";
$result = mysqli_query($conn, $sql);
$meeting = mysqli_fetch_assoc($result);

// echo $meeting['id'] . "<br>" . $meeting['group_name'] . "<br>" . $meeting['add_note'] . "<br>";

?>

<form action="" method="post">
	<label for="id-name" style="display:block;">Session ID
		<input type="text" value="<?php echo h($_SESSION['id']); ?>">
	</label>
	<label for="mtgid" style="display:block;">Meeting ID
		<input type="text" name="id_meeting" value="<?php echo h($mtg); ?>">
	</label>


	<label for="group-name" style="display:block;">Group Name 
		<input type="text" class="text" name="groupname" value="<?php if(isset($meeting['group_name'])) { echo h($meeting['group_name']); } ?>">
	</label>
	<label for="additional-notes" style="display:block;">Additional notes 
		<textarea name="addnotes"><?php if(isset($meeting['add_note'])) { echo h($meeting['add_note']); } ?></textarea>
	</label>

	<input type="submit" name="update-private-mtg" class="submit" value="Update">

</form>




	</div><!-- #landing-content -->
</div><!-- #landing -->

</body>

<?php require '_includes/footer.php'; ?>