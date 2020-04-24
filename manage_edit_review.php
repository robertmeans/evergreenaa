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

	
	<div class="manage-simple-intro">
		<!-- <p>Take a look. Is everything the way you want it? This is how it appears to everyone in our known interplanetary galactic solarplexus. (Consciousness is a dream.)</p> -->
		<p>Take a look. Is everything the way you want it? If not, click the <a class="manage-edit" href="manage_edit.php?id=<?= h(u($id)); ?>">edit button</a> and polish this sucker up!</p>
	</div>
	<div class="manage-simple-content">
		<h1>Quick view</h1>

			<?php
				
				//$row = mysqli_fetch_assoc($subject_set);

				//if ($row > 0) {
					//while ($row = mysqli_fetch_assoc($subject_set)) {  

					require '_functions/manage-edit-glance.php'; ?>
					<div class="weekday-edit-wrap">
						<?php require '_functions/meeting-details.php'; ?>
					</div><!-- .weekday-wrap -->
					<?php
						// mysqli_free_result($row);
					//} else {
						//echo "<p>How did you get here? Seriously, could you please copy the URL and email it to me at the bottom of the page? I mean, if you did something silly like add a random number at the end of the URL to see what would happen then I understand how you got here. But otherwise...?</p>";
					//}
				//}
					
			?>

	</div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>