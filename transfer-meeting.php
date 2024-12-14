<?php 
$layout_context = 'alt-manage';
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';
if (is_suspended()) {
	header('location: ' . WWW_ROOT);
	exit();
}

if (!isset($_SESSION['id'])) {
	header('location: ' . WWW_ROOT);
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: ' . WWW_ROOT);
	exit();
}

$id = $_GET['id'];
$user_id = $_SESSION['id'];
$role = $_SESSION['role'];


$row = edit_meeting($id); 

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

// end


require '_includes/head.php'; ?>

<body>
<?php preload_config($layout_context); ?>
<?php require '_includes/nav.php'; ?>
<?php require_once '_includes/messages.php'; ?>
<?php $theme = configure_theme(); mobile_bkg_config($theme); ?>


<div id="host-manage-wrap">
	<div class="manage-simple intro">
	<?php require '_includes/inner_nav.php'; ?>
	</div>
	<?php if ($row['id_user'] == $_SESSION['id'] || $_SESSION['role'] == 99 || $_SESSION['role'] == 80 || $_SESSION['role'] == 60) { ?>

	<h2 id="trans-h2" class="trans-h2">Transfer Meeting</h2>
	<div id="transfer-host">
		<p id="current-host" class="current-role">Host: <?php if (is_owner($row)) { echo 'You'; } else { echo $row['username'] . ' &bullet; ' . $row['email']; } ?></p>

    <?php 
      $time = $row['meet_time'];
      $mtg_tz = $row['mtg_tz'];
      $mt = converted_time($time, $mtg_tz, $tz); 
    ?>
		<p><?php echo $mt . ' - '; print_day($row); echo ' - ' . $row['group_name'] ?></p>

		<?php if ($role == 1 || $role ==2 || $role == 3) { ?>

		<?php // dropdown for admin
		$user_management_list = find_all_users_to_manage($user_id);
		$users = mysqli_num_rows($user_management_list);
		$results = mysqli_fetch_all($user_management_list, MYSQLI_ASSOC);
		
		if ($users > 0) { ?>

<div id="tabs" class="tabs">
  <ul class="tab-links">
    <li class="focus"><a href="#tab1">Username</a></li>
    <li><a href="#tab2">Email</a></li>
  </ul>
<div class="tab-content">
  <div id="tab1">
			<div class="user-box">
				<p>Select a user to transfer this meeting to:</p>
				<form id="transfer-form-top">
					<select id="transfer-usr" class="transfer-usr" name="transfer-usr">
						<option value="empty">Select by Username</option>
					<?php  
					foreach ($results as $li) {
						$user = ($li['id_user']);
						$username = ($li['username']);
						$email = ($li['email']);
						?>
						<option value="<?= $username . ',' . $email; ?>"><?= $username ?></option>		
					<?php }   ?>
					<input type="hidden" name="current-user" value="<?= $user_id ?>">
					<input type="hidden" name="current-mtg" value="<?= $id ?>">
					<input type="hidden" name="host-email" value="<?= $row['email'] ?>">
					<input type="hidden" id="new-usrnm-top">
					<input type="hidden" id="new-email-top" name="email">

					</select> <a id="transfer-this-top">GO</a>
				</form>
			</div>
			<div id="hide-on-success">
				<div id="flash-email-top"></div>
				<p>Click &quot;GO&quot; after selecting a new member OR manually enter an email address below like some kind of prehistoric cave baboon.</p>
			</div>
  </div>

<div id="tab2">
	<div class="user-box">
		<p>Select a user to transfer this meeting to:</p>
		<form id="transfer-form-topz">
			<select id="transfer-usrz" class="transfer-usr" name="transfer-usr">
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
					<option value="<?= $username . ',' . $email; ?>"><?= strtolower($email) ?></option>		
				<?php } ?>

			<input type="hidden" name="current-user" value="<?= $user_id ?>">
			<input type="hidden" name="current-mtg" value="<?= $id ?>">
			<input type="hidden" name="host-email" value="<?= $row['email'] ?>">
			<input type="hidden" id="new-usrnm-topz">
			<input type="hidden" id="new-email-topz" name="email">

			</select> <a id="transfer-this-topz">GO</a>
		</form>
	</div>
	<div id="hide-on-successz">
		<div id="flash-username-top"></div>
		<p>Click &quot;GO&quot; after selecting a new member OR manually enter an email address below like some kind of prehistoric cave baboon.</p>
	</div>

</div>

</div><?php /* .tab-content */ ?>
</div>
<hr>

		<?php  }  ?>

		<?php } ?>

		<form id="transfer-form">
			<input type="hidden" name="current-user" value="<?= $user_id ?>">
			<input type="hidden" name="current-mtg" value="<?= $id ?>">
			<input type="hidden" name="host-email" value="<?= $row['email'] ?>">

			<p>Email of new Host</p>

			<input type="email" id="new-email" name="email" placeholder="Enter member's email address">
		</form>

		<?php if (declare_member()) { /* only show to non-admin folks because admin can hit the "whoops" link to reload the page and transfer to someone else */ ?>
			<div id="trans-msg">
				<p class="host-disclaimer">Note: You are transfering this meeting to someone else. It will no longer be in your account but will jump up and git on over into their account right here directly. There's no going back. It's adios amigos. Make sure you've said your goodbyes and are secure in the decisions you're making here today. Some things in life are profound. (This isn't one, however.)</p>
			</div>
		<?php } else { ?>
			<div id="trans-msg"></div>
		<?php } ?>

		<?php if (is_admin() || is_owner($row)) { echo '<div id="imnadmin"></div>'; } /* this is so we have something to identify whether or not we're dealing with admin. if we are, show them the "Whoops" link after submit so they can do-over if necessary. otherwise, a regular member couldn't transfer the meeting if it's not in their account so don't bother showing them this link. (sorce in _scripts.staging.js - search: 0823211116 ) */ ?>
		<div id="whoops"></div>
		<div id="th-btn">
			<a id="transfer-this" class="<?php if (is_admin() || is_owner($row)) { echo 'ap'; } ?>">TRANSFER</a>
		</div>
	</div>

	<?php } else { ?>
		<p style="margin:1.5em 0 0 1em;width:96%;max-width:900px;">Looks like this meeting is assigned to an Executive, in which case you cannot transfer their meeting, or the Internet hiccuped. Either way, hold your breath and try again if you think you're seeing this in error.</p>
	<?php } ?>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>