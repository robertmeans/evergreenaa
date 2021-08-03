<?php $layout_context = "host-management";

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

$id = $_GET['id'];
$user_id = $_SESSION['id'];
$user_email = $_SESSION['email'];

$row = edit_meeting($id);

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

	<?php if ((($row['id_user'] == $_SESSION['id']) && ($row['id_mtg'] == $id)) || $_SESSION['admin'] == '1') { ?>

	<div id="transfer-host">
		<h2>Transfer Meeting</h2>
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
			<input type="hidden" name="current-host" value="<?= $user_id ?>">
			<input type="hidden" name="current-mtg" value="<?= $id ?>">
			<input type="hidden" name="current-host-email" value="<?php echo strtolower($user_email) ?>">
			<p>Email of new Host</p>
			<input type="email" name="email" placeholder="Enter member's email address">
		</form>
		
		<div id="trans-msg">
			<p class="host-disclaimer">Note: You are transfering this meeting to someone else. It will no longer be in your account but will jump up and git on over into their account right here directly. There's no going back. It's adios amigos. Make sure you've said your goodbyes and are secure in the decisions you're making here today.</p>
		</div>
		<div id="th-btn">
			<a id="transfer-this">TRANSFER</a>
		</div>
	</div>

	<?php } else { echo "<p style=\"margin:1.5em 0 0 1em;\">Either the Internet hiccuped and you ended up here or you're trying to be sneaky. Either way, hold your breath and try again.</p>"; } ?>











</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>