<?php $layout_context = "suspend-user";

require_once 'config/initialize.php';

// For my eyes only!
if ($_SESSION['id'] != 1) {
	header('location: https://www.merriam-webster.com/dictionary/go%20away');
	exit();
}

$id = $_GET['id'];
$suspend_user = $_GET['user'];

$row = suspend_user_info($id);

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

	<?php if ($_SESSION['admin'] == '1') { ?>

	<div id="transfer-host">
		<h2>Suspend User</h2>
		<p style="margin: 0.25em 0 0;padding-top: 0.25em;">Username: <?= $row['username'] ?></p>
		<p style="margin: 0 0 0.75em 0;padding-bottom: 0.5em;border-bottom: 1px solid rgba(255,255,255,0.1);">Email: <?= $row['email'] ?></p>
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

		<form id="suspend-form">
			<input type="hidden" name="suspend-user" value="<?= $row['id_user'] ?>">
			<p>Reason</p>
			<textarea name="reason"><?= $row['sus_notes'] ?></textarea>
		</form>
		
		<div id="sus-msg">
			
		</div>
		<div id="th-btn">
			<?php if ($suspend_user == 1) { ?>
				<a id="not-yourself">Can't suspend yourself dipshit</a>
			<?php } else { ?>
				<a id="suspend-user">SUSPEND</a>
		<?php } ?>
		</div>
	</div>

	<?php } else { echo "<p style=\"margin:1.5em 0 0 1em;\">How'd you get this far?</p>"; } ?>


</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>