<?php 

require_once 'config/initialize.php';
require_once 'config/verify_admin.php';
if ($_SESSION['admin'] == 85 || $_SESSION['admin'] == 86) {
	header('location: ' . WWW_ROOT);
	exit();
}

$layout_context = "alt-manage";

if (!isset($_SESSION['id'])) {
	header('location: home.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: home.php');
	exit();
}

$id = $_GET['id'];
$user_id = $_SESSION['id'];

$row = transfer_meeting($id);

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


<div id="host-manage-wrap">
	<div class="manage-simple intro">
	<?php require '_includes/inner_nav.php'; ?>
	</div>
	<?php if ((($row['id_user'] == $_SESSION['id']) && ($row['id_mtg'] == $id)) || $_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3) { ?>

	<h2 class="trans-h2">Transfer Meeting</h2>
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

		<form id="transfer-form">
			<input type="hidden" name="current-user" value="<?= $user_id ?>">
			<input type="hidden" name="current-mtg" value="<?= $id ?>">
			<input type="hidden" name="host-email" value="<?= $row['email'] ?>">
			<p>Email of new Host</p>
			<input type="email" id="new-email" name="email" placeholder="Enter member's email address">
		</form>
		
		<div id="trans-msg">
			<p class="host-disclaimer">Note: You are transfering this meeting to someone else. It will no longer be in your account but will jump up and git on over into their account right here directly. There's no going back. It's adios amigos. Make sure you've said your goodbyes and are secure in the decisions you're making here today.</p>
		</div>
		<div id="th-btn">
			<a id="transfer-this">TRANSFER</a>
		</div>
	</div>

	<?php } else { ?>
		<p style="margin:1.5em 0 0 1em;width:96%;max-width:600px;">Either the Internet hiccuped and you ended up here or you're trying to be sneaky. Either way, hold your breath and try again.</p>
	<?php } ?>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>