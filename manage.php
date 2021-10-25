<?php 
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

if ((isset($_SESSION['admin'])) && ($_SESSION['admin'] == 85 || $_SESSION['admin'] == 86)) {
	header('location: ' . WWW_ROOT);
	exit();
}

$layout_context = "dashboard";
$hide_this = "yep";

if (!isset($_SESSION['id'])) {
	header('location: home.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: home.php');
	exit();
}
if (isset($_SESSION['id'])) {
	$user_id = $_SESSION['id'];
	$role = $_SESSION['admin'];
}

require '_includes/head.php'; ?>

<body>
<?php if (WWW_ROOT != 'http://localhost/evergreenaa') { ?>
<div class="preload-manage">
	<p>Loading...</p>
</div>
<?php } ?>	
	
<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-set-timezone.php'; ?>
<?php require '_includes/msg-extras.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">
	
	<div class="manage-simple intro">
		<?php if ($role != 1 && $role != 2) { ?>
		<p>My Dashboard</p>
		<p>The goal here is simple - make AA meetings available 24-7-365. Let's connect people and save lives.
	<?php } else if ($role == 1) { ?>
		<p>The Bob's Dashboard</p>
	<?php } else { ?>
		<p>My Dashboard</p>
	<?php } ?>
	<?php 
	$any_meetings_for_user = find_meetings_for_manage_page($user_id);
	$email_opt = mysqli_fetch_assoc($any_meetings_for_user);
	$result 	= mysqli_num_rows($any_meetings_for_user);
	// find out if user has any meetings they manage ?>

	<form action="" class="email-updates">
		<input type="hidden" name="email-updates" value="0">
		<input type="checkbox" name="email-updates" id="email-updates" value="1" <?php if ($email_opt['email_opt'] == '1') { echo 'checked'; } ?>> <label for="email-updates" id="opt_inout">Email updates: Enabled</label>
	</form>

	<?php require '_includes/inner_nav.php'; ?>
	</div>
	<a href="manage_new.php" class="new-mtg-btn">Add a new meeting</a>
<div class="manage-simple">	
	<h1 class="my-meet">My Meetings</h1><?php if ($result > 1) { ?>
	<p class="my-sort">(sorted by time of day)</p>
	<?php } ?>
</div>

<ul class="manage-weekdays">
<?php if ($result > 0) { ?>

<?php // if user has meetings to manage, display them in order: Day > time, starting with Sun ?>

		<?php while ($row = mysqli_fetch_assoc($any_meetings_for_user)) { ?>

			<?php
			$time = [];
			$time['tz'] = $tz;
			$time['ut'] = $row['meet_time'];

			$time['sun'] = $row['sun'];
			$time['mon'] = $row['mon'];
			$time['tue'] = $row['tue'];
			$time['wed'] = $row['wed'];
			$time['thu'] = $row['thu'];
			$time['fri'] = $row['fri'];
			$time['sat'] = $row['sat'];

			list($ct, $sun, $mon, $tue, $wed, $thu, $fri, $sat) = apply_offset_to_edit($time);

			$row['sun'] = $sun;
			$row['mon'] = $mon;
			$row['tue'] = $tue;
			$row['wed'] = $wed;
			$row['thu'] = $thu;
			$row['fri'] = $fri;
			$row['sat'] = $sat;

			?>

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