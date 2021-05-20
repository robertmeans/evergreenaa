<?php $layout_context = "manage-edit-rev";

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
	
<div class="confirm">TEST & SELECT AUDIENCE</div>	
<div class="manage-simple intro">
	<p>Take a look. Is everything the way you want it? If not, click the <a class="manage-edit inline" href="manage_edit.php?id=<?= h(u($id)); ?>"><i class="far fa-edit"></i> edit button</a> and polish this sucker up! Otherwise, scroll down, select your audience and click DONE.</p>
	<p class="logout"><a href="home_private.php">Home</a> | <a href="manage.php">Dashboard</a></p>
</div>
<div class="manage-simple review">
	<h1>Quick view</h1>
		
		<?php if ($row['id_user'] == $_SESSION['id']) { ?>

			<?php require '_includes/new-review-glance.php'; ?>
			<div class="weekday-edit-wrap">
				<?php require '_includes/new-review-details.php'; ?>

			</div><!-- .weekday-wrap -->

		<form class="new-review" action="new_review_submit.php?id=<?= h(u($row['id_mtg'])); ?>" method="post">

		<div class="visible">

			<h1><i class="fas fa-users" style="margin-right:1em;"></i> Select your audience</h1>
			<div class="radio-group">
				<div class='radio<?php if ($row['visible'] == "0") { echo " selected"; } ?>' value="0">
					Draft | Save for later.
				</div>
				<div class='radio<?php if ($row['visible'] == "1") { echo " selected"; } ?>' value="1">
					Private | Only you will see this.
				</div>
				<div class='radio<?php if ($row['visible'] == "2") { echo " selected"; } ?>' value="2">
					Members Only | Only members of EvergreenAA.com.</div>
				<div class='radio<?php if ($row['visible'] == "3") { echo " selected"; } ?>' value="3">
					Public | Share with everyone. No membership required.
				</div>

	<?php /* 	grab value and put it into hidden field to submit 
				this is also in _includes/manage_new_review */		?>
				<input type="hidden" name="visible" value="<?php 
				if ($row['visible'] == "0") { echo "0"; } // Draft 
				if ($row['visible'] == "1") { echo "1"; } // Private
				if ($row['visible'] == "2") { echo "2"; } // Members Only
				if ($row['visible'] == "3") { echo "3"; } // Public
				?>" />
			 </div>

		</div><!-- .visible -->

		<input type="submit" name="update-mtg" class="done" value="DONE">
		</form>
			
		<?php } else { echo "<p style=\"margin-top:1.5em;\">Quit trying to be sneaky.</p>"; } ?>
</div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>