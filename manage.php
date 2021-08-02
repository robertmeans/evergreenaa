<?php $layout_context = "manage";

require_once 'config/initialize.php';
// require_once '_includes/session.php';

// off for local testing

if (!isset($_SESSION['id'])) {
	header('location: home.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: home.php');
	exit();
}

$user_id = $_SESSION['id'];

// echo delete_success_message();
?>

<?php require '_includes/head.php'; ?>
<body>
<?php if (WWW_ROOT != 'http://localhost/evergreenaa') { ?>
<div class="preload-manage">
	<p>Loading...</p>
</div>
<?php } ?>	
	
<?php require '_includes/nav.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">
	
	<div class="manage-simple intro">
		<?php echo "<p>Hello " . $_SESSION['username'] . ",</p>"; ?>
		<p>The goal here is simple - make AA meetings available 24-7-365. Let's connect people and save lives.</p>
		<p>For a tour of what's here check out this quick <a class="ytv" href="https://youtu.be/CC1HlQcmy6c" target="_blank">YouTube video</a>.</p>
		<p class="logout">
		<?php
			if ($_SESSION['admin'] == "1") { 
				echo "<a href=\"email_everyone_BCC.php\">BCC All</a> | <a href=\"email_everyone_PERSONAL.php\">Personal All</a> | "; 
			}
		?>
			<a href="<?= WWW_ROOT ?>">Home</a> | <a href="logout.php">Logout</a>
		</p>
	</div>
	<a href="manage_new.php" class="new-mtg-btn">Add a new meeting</a>
<div class="manage-simple">	
	<?php 
	$any_meetings_for_user = find_meetings_for_manage_page($user_id);
	$result 	= mysqli_num_rows($any_meetings_for_user);
	// find out if user has any meetings they manage ?>
	<h1>My Meetings<?php if ($result > 1) { ?>
		<span style="font-size: 0.65em; margin-left: 0.25em;">(sorted by time of day)</span>
	<?php } ?></h1>
</div>

<ul class="manage-weekdays">
<?php if ($result > 0) { ?>

<?php // if user has meetings to manage, display them in order: Day > time, starting with Sun ?>

		<?php while ($row = mysqli_fetch_assoc($any_meetings_for_user)) { ?>

			<?php require '_includes/manage-glance.php'; ?>
			<div class="weekday-wrap<?php if ('visible' == 0) { echo ' draft-bkg'; }  ?>">
				<?php require '_includes/meeting-details.php'; ?>
			</div><!-- .weekday-wrap -->

		<?php }  ?>

	<?php  
	} else { // user has no meetings to manage
		echo "<p style=\"margin-top:0.5em;padding:0px 1em;\">When you add a meeting it will display here and wherever else you choose. You can make your meetings public or keep them private. Add a new meeting and give it a try.</p>";
	}  mysqli_free_result($any_meetings_for_user); ?>

</ul><!-- .manage-weekdays -->

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>