<?php 

require_once 'config/initialize.php';
require_once 'config/verify_admin.php';
if ($_SESSION['admin'] == 85 || $_SESSION['admin'] == 86) {
	header('location: ' . WWW_ROOT);
	exit();
}

$layout_context = "alt-manage";

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
$role = $_SESSION['admin'];

$row = transfer_meeting($id);

require '_includes/head.php'; ?>

<body>
<?php if (WWW_ROOT != 'http://localhost/evergreenaa') { ?>
<div class="preload-manage">
	<p>Loading...</p>
</div>
<?php } ?>	
	
<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-extras.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">


<div id="host-manage-wrap">
	<div class="manage-simple intro">
	<?php require '_includes/inner_nav.php'; ?>
	</div>
	<?php if ((($row['id_user'] == $_SESSION['id']) && ($row['id_mtg'] == $id)) || $_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3) { ?>

	<h2 id="trans-h2" class="trans-h2">Transfer Meeting</h2>
	<div id="transfer-host">
		<p id="current-host" class="current-role">Host: <?= $row['username'] . ' &bullet; ' . $row['email'] ?></p>
		<p><?= date('g:i A', strtotime($row['meet_time'])) . ' - '; ?>
				<?php 
				if ($row['sun'] == 0) {  } 
				else if (($row['sun'] !=0) && (($row['mon'] != 0) || ($row['tue'] != 0) || ($row['wed'] != 0) || ($row['thu'] != 0) || ($row['fri'] != 0) || ($row['sat'] != 0))) {
					echo "Sun, "; 
				} else { echo "Sun"; }

				if ($row['mon'] == 0) {  }
				else if (($row['mon'] !=0) && (($row['tue'] != 0) || ($row['wed'] != 0) || ($row['thu'] != 0) || ($row['fri'] != 0) || ($row['sat'] != 0))) { 
					echo "Mon, "; 
				} else { echo "Mon"; }

				if ($row['tue'] == 0) {  }
				else if (($row['tue'] !=0) && (($row['wed'] != 0) || ($row['thu'] != 0) || ($row['fri'] != 0) || ($row['sat'] != 0))) { 
					echo "Tue, "; 
				} else { echo "Tue"; }

				if ($row['wed'] == 0) {  }
				else if (($row['wed'] !=0) && (($row['thu'] != 0) || ($row['fri'] != 0) || ($row['sat'] != 0))) { 
					echo "Wed, "; 
				} else { echo "Wed"; }

				if ($row['thu'] == 0) {  }
				else if (($row['thu'] !=0) && (($row['fri'] != 0) || ($row['sat'] != 0))) { 
					echo "Thu, "; 
				} else { echo "Thu"; }

				if ($row['fri'] == 0) {  }
				else if (($row['fri'] !=0) && ($row['sat'] != 0)) { 
					echo "Fri, "; 
				} else { echo "Fri"; }

				if ($row['sat'] == 0) {  }
				else { echo "Sat "; }
				?>
				<?= ' - ' . $row['group_name'] ?></p>

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

		<?php if ($_SESSION['admin'] == 0) { /* only show to non-admin folks because admin can hit the "whoops" link to reload the page and transfer to someone else */ ?>
			<div id="trans-msg">
				<p class="host-disclaimer">Note: You are transfering this meeting to someone else. It will no longer be in your account but will jump up and git on over into their account right here directly. There's no going back. It's adios amigos. Make sure you've said your goodbyes and are secure in the decisions you're making here today. Some things in life are profound. (This isn't one, however.)</p>
			</div>
		<?php } else { ?>
			<div id="trans-msg"></div>
		<?php } ?>

		<?php if ($_SESSION['admin'] != 0) { echo '<div id="imnadmin"></div>'; } /* this is so we have something to identify whether or not we're dealing with admin. if we are, show them the "Whoops" link after submit so they can do-over if necessary. otherwise, a regular member couldn't transfer the meeting if it's not in their account so don't bother showing them this link. (sorce in _scripts.staging.js - search: 0823211116 ) */ ?>
		<div id="whoops"></div>
		<div id="th-btn">
			<a id="transfer-this" class="<?php if ($_SESSION['admin'] != 0) { echo 'ap'; } ?>">TRANSFER</a>
		</div>
	</div>

	<?php } else { ?>
		<p style="margin:1.5em 0 0 1em;width:96%;max-width:600px;">Either the Internet hiccuped and you ended up here or you're trying to be sneaky. Either way, hold your breath and try again.</p>
	<?php } ?>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>