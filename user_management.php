<?php 
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

if ($_SESSION['mode'] != 1 || ($_SESSION['admin'] != 1 && $_SESSION['admin'] != 3)) {
	header('location: ' . WWW_ROOT);
	exit();
}

$layout_context = "um";

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
<?php require '_includes/msg-extras.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">
	
	<div class="manage-simple intro">
	<?php if ($role == 1) { ?>
		<p>My User Management</p>
	<?php } else { ?>
		<p><?= ' ' . $_SESSION['username'] . '\'s User Management' ?></p>
	<?php } ?>


<?php require '_includes/inner_nav.php'; ?>
</div>
		<?php if ($role == 1 || $role == 3) { ?>

		<?php // dropdown list of users for admin
		$user_management_list = find_all_users_to_manage($user_id);
		$users 	= mysqli_num_rows($user_management_list);
		
		if ($users > 0) { ?>










<div class="tabs ump">
  <ul class="tab-links">
    <li class="focus"><a href="#tab1">Username</a></li>
    <li><a href="#tab2">Email</a></li>
  </ul>

<div class="tab-content">
  <div id="tab1">
		<div class="user-box">
			<p>Select a user by their Username</p>
			<form id="user-list">
				<select id="mng-usr" class="transfer-usr" name="transfer-usr">
					<option value="empty">Select by Username</option>
				<?php  
				while ($li = mysqli_fetch_assoc($user_management_list)) { ?>

					<option value="<?php echo WWW_ROOT . '/user_role.php?user=' . $li['id_user']; ?>"><?= $li['username']; ?></option>
							
				<?php } mysqli_data_seek($user_management_list,0); ?>

				</select> <a id="usr-role-go">GO</a>
			</form>
		</div>

  </div>
  <div id="tab2">

		<div class="user-box">
			<p>Select a user by their email address</p>
			<form id="user-listz">
				<select id="mng-usrz" class="transfer-usr" name="transfer-usr">
					<option value="empty">Select by Email</option>
				<?php  
				while ($lii = mysqli_fetch_assoc($user_management_list)) { ?>

					<option value="<?php echo WWW_ROOT . '/user_role.php?user=' . $lii['id_user']; ?>"><?= strtolower($lii['email']); ?></option>
							
				<?php } ?>

				</select> <a id="usr-role-goz">GO</a>
			</form>
		</div>

  </div>
</div><?php /* .tab-content */ ?>
</div>





		<?php } mysqli_free_result($user_management_list); ?>

		<?php } ?>
	
	
	

<?php /* -------------------- SUSPENDED USERS -------------------- */ ?>
<div class="manage-simple s-a">	
	<?php 
	$any_meetings_for_user = user_manage_page_glance();
	$suspended_users 	= mysqli_num_rows($any_meetings_for_user);
	?>
	<h1>Suspended Users</h1>
</div>

<ul class="manage-weekdays">
<?php 
 	if ($suspended_users > 0) { 
		while ($row = mysqli_fetch_assoc($any_meetings_for_user)) { 
			$suspended_id = $row['id_user']; ?>

			<?php require '_includes/user-management-user-glance.php'; ?>

			<?php
			$suspended_users_meetings = user_manage_page_details($suspended_id);
			$suspended_users = mysqli_num_rows($suspended_users_meetings);

			if ($suspended_users > 0) {
			?>

			<div class="weekday-wrap user-mng">
				<div class="notes-glance">
					<p class="reason-note">Reason for suspension</p>
					<p class="note-reason"><?= nl2br($row['sus_notes']) ?></p>
				</div>

				<?php while ($rowz = mysqli_fetch_assoc($suspended_users_meetings)) { ?>
					<?php require '_includes/user-management-user-meetings.php'; ?>
				<?php } ?>

			</div><!-- .weekday-wrap -->

		<?php } else { ?>
	
			<div class="weekday-wrap user-mng user-empty">
				<div class="notes-glance">
					<p class="reason-note">Reason for suspension</p>
					<p class="note-reason"><?= nl2br($row['sus_notes']) ?></p>
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
	$administrators 	= mysqli_num_rows($any_meetings_for_admin);
	$ca = ''; // set just to use in this block
	?>
	<h1>Current Administrators</h1>
</div>

<ul class="manage-weekdays">
<?php 
 	if ($administrators > 0) { 
		while ($row = mysqli_fetch_assoc($any_meetings_for_admin)) { 
			$userz_id = $row['id_user']; ?>

			<?php require '_includes/user-management-user-glance.php'; ?>

			<?php
			$admin_meetings = user_manage_page_details($userz_id);
			$resultz = mysqli_num_rows($admin_meetings);

			if ($resultz > 0) {
			?>

			<div class="weekday-wrap user-mng">

				<?php while ($rowz = mysqli_fetch_assoc($admin_meetings)) { ?>
					<?php require '_includes/user-management-user-meetings.php'; ?>
				<?php } ?>

			</div><!-- .weekday-wrap -->

		<?php } else { ?>
			<div class="weekday-wrap user-mng user-empty">
				<p>This user has no meetings for public view.</p>
			</div><!-- .weekday-wrap -->
		<?php } ?>

			<?php mysqli_free_result($admin_meetings); ?>

		<?php }  ?>

	<?php  
	} else { // user has no meetings to manage
		echo "<p style=\"margin-top:0.5em;padding:0px 1em;\">There are no Administrators other than you.</p>";
	}  mysqli_free_result($any_meetings_for_admin); ?>

</ul><!-- .manage-weekdays -->

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>