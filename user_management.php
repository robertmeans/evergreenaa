<?php 
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

if ($_SESSION['admin'] != 1 && $_SESSION['admin'] != 2) {
	header('location: https://www.merriam-webster.com/dictionary/go%20away');
	exit();
}

if ($_SESSION['admin'] == 1) {
	$layout_context = "odin-manage";
} else if ($_SESSION['admin'] == 2) {
	$layout_context = "thor-manage";
} else {
	$layout_context = "manage";
}

if (!isset($_SESSION['id'])) {
	header('location: home.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: home.php');
	exit();
}

$user_id = $_SESSION['id'];
$role = $_SESSION['admin'];

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
	<?php if ($role == 1) { ?>
		<p>My User Management</p>
	<?php } else { ?>
		<p><?= ' ' . $_SESSION['username'] . '\'s User Management' ?></p>
	<?php } ?>
		<p class="logout">
			
		<?php
			if ($role == 1) { // my eyes only ?>
			<a href="email_everyone_BCC.php">BCC All</a> |  
			<a href="<?= WWW_ROOT . '/manage.php' ?>">My Dashboard</a> | 
			<a href="logout.php">Logout</a> 
		<?php } else if ($role == 2) { ?>
			<a href="<?= WWW_ROOT . '/manage.php' ?>">My Dashboard</a> | 
			<a href="logout.php">Logout</a>
		<?php } else { ?>
			<a href="<?= WWW_ROOT ?>">Home</a> | <a href="logout.php">Logout</a>
		<?php } ?>

		</p>
	</div>

<?php /* -------------------- SUSPENDED USERS -------------------- */ ?>
<div class="manage-simple s-a">	
	<?php 
	$any_meetings_for_user = find_meetings_for_user_manage_page_glance();
	$result 	= mysqli_num_rows($any_meetings_for_user);
	?>
	<h1>Suspended Users</h1>
</div>

<ul class="manage-weekdays">
<?php 
 	if ($result > 0) { 
		while ($row = mysqli_fetch_assoc($any_meetings_for_user)) { 
			$userz_id = $row['id_user']; ?>

			<?php require '_includes/user-management-user-glance.php'; ?>


			<?php
			$suspended_users_meetings = find_meetings_for_user_manage_page_details($userz_id);
			$resultz = mysqli_num_rows($suspended_users_meetings);

			if ($resultz > 0) {
			?>

			<div class="weekday-wrap user-mng">
				<div class="notes-glance">
					<p class="reason-note">Reason for suspension</p>
					<p class="note-reason"><?= $row['sus_notes'] ?></p>
				</div>

				<?php while ($rowz = mysqli_fetch_assoc($suspended_users_meetings)) { ?>
					<?php require '_includes/user-management-user-meetings.php'; ?>
				<?php } ?>

			</div><!-- .weekday-wrap -->

		<?php } else { ?>


					
			<div class="weekday-wrap user-mng user-empty">
				<div class="notes-glance">
					<p class="reason-note">Reason for suspension</p>
					<p class="note-reason"><?= $row['sus_notes'] ?></p>
				</div>				
				<p style="margin-top:1em;padding:0.5em 1em;">This user has no meetings for public view.</p>
			</div><!-- .weekday-wrap -->
		<?php } ?>

			<?php mysqli_free_result($suspended_users_meetings); ?>

		<?php }  ?>

	<?php  
	} else { // user has no meetings to manage
		echo "<p style=\"margin-top:0.5em;padding:0px 1em;\">There are no members currently suspended.</p>";
	}  mysqli_free_result($any_meetings_for_user); ?>

</ul><!-- .manage-weekdays -->


<?php /* -------------------- CURRENT ADMINISTRATORS -------------------- */ ?>
<div class="manage-simple c-a">	
	<?php 
	$any_meetings_for_admin = find_users_for_admin_glance();
	$result 	= mysqli_num_rows($any_meetings_for_admin);
	$ca = ''; // set just to use in this block
	?>
	<h1>Current Administrators</h1>
</div>

<ul class="manage-weekdays">
<?php 
 	if ($result > 0) { 
		while ($row = mysqli_fetch_assoc($any_meetings_for_admin)) { 
			$userz_id = $row['id_user']; ?>

			<?php require '_includes/user-management-user-glance.php'; ?>


			<?php
			$suspended_users_meetings = find_meetings_for_user_manage_page_details($userz_id);
			$resultz = mysqli_num_rows($suspended_users_meetings);

			if ($resultz > 0) {
			?>

			<div class="weekday-wrap user-mng">

				<?php while ($rowz = mysqli_fetch_assoc($suspended_users_meetings)) { ?>
					<?php require '_includes/user-management-user-meetings.php'; ?>
				<?php } ?>

			</div><!-- .weekday-wrap -->

		<?php } else { ?>
			<div class="weekday-wrap user-mng user-empty">
				<p>This user has no meetings for public view.</p>
			</div><!-- .weekday-wrap -->
		<?php } ?>

			<?php mysqli_free_result($suspended_users_meetings); ?>


		<?php }  ?>

	<?php  
	} else { // user has no meetings to manage
		echo "<p style=\"margin-top:0.5em;padding:0px 1em;\">There are no Administrators other than you.</p>";
	}  mysqli_free_result($any_meetings_for_admin); ?>

</ul><!-- .manage-weekdays -->

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>