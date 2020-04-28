<?php $layout_context = "manage-edit-rev"; ?>
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

// $subject_set = edit_meeting($id);
$row = edit_meeting($id);
?>

<?php require '_includes/head.php'; ?>
<body>
<?php require '_includes/nav.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">
	
<div class="confirm">TEST & CONFIRM!</div>	
<div class="manage-simple intro">
	<p>Take a look. Is everything the way you want it? If not, click the <a class="manage-edit inline" href="manage_edit.php?id=<?= h(u($id)); ?>"><i class="far fa-edit"></i> edit button</a> and polish this sucker up! Or save it for later.</p>
	<p class="logout"><a href="manage.php">Go back to your meeting summary</a></p>
</div>
<div class="manage-simple review">
	<h1>Quick view</h1>
		
		<?php if ($row['id_user'] == $_SESSION['id']) { ?>

			<?php require '_includes/new-review-glance.php'; ?>
			<div class="weekday-edit-wrap">
				<?php require '_includes/new-review-details.php'; ?>

			</div><!-- .weekday-wrap -->

			<form class="new-review" action="new_review_submit.php?id=<?= h(u($row['id_mtg'])); ?>" method="post">

				<label><input type="radio" name="visible" value="0" <?php if ($row['visible'] == "0") { echo "checked"; } ?>> <span>Save as Draft</span></label> 

				<label><input type="radio" name="visible" value="1" <?php if ($row['visible'] == "1") { echo "checked"; } ?>> <span>Private: Only logged-in members of EvergreenAA.com will see this.</span></label> 

				<label><input type="radio" name="visible" value="2" <?php if ($row['visible'] == "2") { echo "checked"; } ?>> <span>Public: Share with everyone.</span></label>

				<input type="submit" name="update-mtg" class="done" value="DONE">
			</form>
			
			
			
		<?php } else { echo "<p style=\"margin-top:1.5em;\">Quit trying to be sneaky.</p>"; } ?>
</div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>