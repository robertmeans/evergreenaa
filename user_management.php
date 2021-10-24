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
		$users = mysqli_num_rows($user_management_list);
		$results = mysqli_fetch_all($user_management_list, MYSQLI_ASSOC);
		
		if ($users > 0) { ?>

<div class="tabs ump">
  <ul class="tab-links">
    <li class="focus"><a href="#tab1">Username</a></li>
    <li><a href="#tab2">Email</a></li>
    <li><a href="#tab3">Joined</a></li>
  </ul>

<div class="tab-content">
  <div id="tab1">
		<div class="user-box">
			<p>Select a user by their Username</p>
			<form id="user-list">
				<select id="mng-usr" class="transfer-usr" name="transfer-usr">
					<option value="empty">Select by Username</option>
					<?php  
					foreach ($results as $li) {
						$user = ($li['id_user']);
						$username = ($li['username']);
						$email = ($li['email']);
						?>
						<option value="<?php echo WWW_ROOT . '/user_role.php?user=' . $user . ',' . $email; ?>"><?= $username; ?></option>		
					<?php }   ?>
					<input type="hidden" id="uem">
				</select> <a id="usr-role-go">GO</a>
			</form>
		</div>
		<div id="um-email-top"></div>
  </div>

  <div id="tab2">
		<div class="user-box">
			<p>Select a user by their email address</p>
			<form id="user-listz">
				<select id="mng-usrz" class="transfer-usr" name="transfer-usr">
					<option value="empty">Select by Email</option>
					<?php  
					function cmp($results, $key) {
						foreach($results as $k=>$v) {
							$b[] = strtolower($v[$key]);
						}
						asort($b);
						foreach ($b as $k=>$v) {
							$c[] = $results[$k];
						}
						return $c;
					}
					$sorted = cmp($results, 'email');
					?>
					<?php /* <pre><?php print_r($sorted); ?></pre> */ ?>
					<?php 

					foreach ($sorted as $li) {
						$user = ($li['id_user']);
						$username = ($li['username']);
						$email = ($li['email']); 
						?>
						<option value="<?php echo WWW_ROOT . '/user_role.php?user=' . $user . ',' . $username; ?>"><?= strtolower($email); ?></option>		
					<?php } ?>
				</select> <a id="usr-role-goz">GO</a>
			</form>
		</div>
		<div id="um-un-btm"></div>
  </div>

  <div id="tab3">
		<div class="user-box">
			<p>Select a user by date joined</p>
			<form id="user-listzz">
				<select id="mng-usrzz" class="transfer-usr" name="transfer-usr">
					<option value="empty">Select by Date Joined</option>
					<?php  
					function cmpz($results, $key) {
						foreach($results as $k=>$v) {
							$b[] = strtolower($v[$key]);
						}
						foreach ($b as $k=>$v) {
							$c[] = $results[$k];
						}
						rsort($c);
						return $c;
					}
					$sorted2 = cmpz($results, 'id_user'); 
					?>
					<?php /* <pre><?php print_r($sorted); ?></pre> */ ?>
					<?php 

					foreach ($sorted2 as $li) {
						$joined = ($li['joined']);
						$user = ($li['id_user']);
						$username = ($li['username']);
						$email = ($li['email']); 
						?>
						<option value="<?php echo WWW_ROOT . '/user_role.php?user=' . $user . ',' . $username . ','  . $email; ?>"><?= date('m.d.y H:i', strtotime($joined)) . ' | ' . strtolower($username); ?></option>		
					<?php } ?>
				</select> <a id="usr-role-gozz">GO</a>
			</form>
		</div>
		<div id="um-un-btmz"></div>
		<p class="btm">Listed in order of most recently joined. I figured it would be useful if you ever need to find someone who just joined and is doing stupid stuff on the site but you don't have time to look for something they've posted in order to get to them that way.</p>
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
 		$i = 1;
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
					<span class="reason-header">
						<p class="reason-note">Reason for suspension</p>
						<span id="a_<?= $i ?>" class="ricons">
							<a data-id="<?= $i ?>" data-role="rnote" class="reason-note rt eicon"><div class="tooltip right">
						<span class="tooltiptext type">Edit Note</span><i class="far fa-edit"></i></div></a>
						</span>
					</span>

					<div id="error_<?= $i ?>"></div>
					<div id="<?= $i ?>" class="note-reason"><?= $row['sus_notes'] ?></div>
					<div id="on_<?= $i ?>" style="display:none;"><?= $row['sus_notes'] ?></div>
					<div id="uid_<?= $i ?>" style="display:none;"><?= $row['id_user'] ?></div>
					<div id="round2_<?= $i ?>" style="display:none;"></div>
				</div>

				<?php while ($rowz = mysqli_fetch_assoc($suspended_users_meetings)) { ?>
					<?php require '_includes/user-management-user-meetings.php'; ?>
				<?php } ?>
			</div><!-- .weekday-wrap -->
		<?php } else { ?>
			<div class="weekday-wrap user-mng user-empty">

				<div class="notes-glance">
					<span class="reason-header">
						<p class="reason-note">Reason for suspension</p>
						<span id="a_<?= $i ?>" class="ricons">
							<a data-id="<?= $i ?>" data-role="rnote" class="reason-note rt eicon"><div class="tooltip right">
						<span class="tooltiptext type">Edit Note</span><i class="far fa-edit"></i></div></a>
						</span>
					</span>

					<div id="error_<?= $i ?>"></div>
					<div id="<?= $i ?>" class="note-reason"><?= $row['sus_notes'] ?></div>
					<div id="on_<?= $i ?>" style="display:none;"><?= $row['sus_notes'] ?></div>
					<div id="uid_<?= $i ?>" style="display:none;"><?= $row['id_user'] ?></div>
					<div id="round2_<?= $i ?>" style="display:none;"></div>
				</div>	
				<p style="margin-top:1em;padding:0.5em 1em;">This user has no meetings for public view.</p>
			</div><!-- .weekday-wrap -->
		<?php } ?>

	<?php $i++; } // end while loop  ?>

	<?php  
	} else { // user has no meetings to manage
		echo "<p style=\"margin-top:0.5em;padding:0px 1em;\">There are no members currently suspended.</p>";
	}  
		mysqli_free_result($suspended_users_meetings);
		mysqli_free_result($any_meetings_for_user); ?>

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