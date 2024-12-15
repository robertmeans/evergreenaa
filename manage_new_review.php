<?php 
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

if (is_suspended()) {
	header('location: ' . WWW_ROOT);
	exit();
}

$layout_context = "alt-manage";

if (!isset($_SESSION['id'])) {
	$_SESSION['message'] = "You need to be logged in to access that page.";
	$_SESSION['alert-class'] = "alert-danger";
	header('location: ' . WWW_ROOT . '/login.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: ' . WWW_ROOT);
	exit();
}

if (!isset($_GET['id'])) {
	header('location: ' . WWW_ROOT);
}

$id = $_GET['id'];
$id_user = $_SESSION['id'];
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

require '_includes/head.php'; ?>

<body>
<?php 
if (WWW_ROOT != 'http://localhost/evergreenaa') { ?>
	<div class="preload"><p>One meeting at a time.</p></div>
<?php } ?>

<?php require '_includes/nav.php'; ?>
<?php require_once '_includes/messages.php'; ?>
<?php $theme = configure_theme(); mobile_bkg_config($theme); ?>
<div id="manage-wrap">
	
<div class="confirm">REVIEW & SAVE</div>	
<div class="manage-simple intro">
	<?php if ($role != 1 && $role != 2) { ?>
  <p>One more step!</p>
	<p>Scroll to the bottom to select your audience and click "DONE". Confirm all the details along the way and if you need to make changes, click the <a class="manage-edit inline" href="manage_edit.php?id=<?= h(u($id)); ?>"><i class="far fa-edit"></i> edit button</a>.</p>
<?php } else if ($role == 1) { ?>
	<p>Hey Me,</p>
	<p>Quit talking to yourself.</p>
<?php } else { ?>
	<p>Hey<?= ' ' . $_SESSION['username'] . ',' ?></p>
	<p>Make sure everything's just right.</p>
<?php } ?>
<?php require '_includes/inner_nav.php'; ?>

</div>
<div class="manage-simple review">
	<h1>Quick view</h1>
		
		<?php if ($row['id_user'] == $_SESSION['id']) { 
      $pc = '1';
      $ic = '1'; 
      $mt = new DateTime($row['meet_time']);
			require '_includes/daily-glance.php'; ?>
			<div class="weekday-edit-wrap">
				<?php require '_includes/meeting-details.php'; ?>

			</div><!-- .weekday-wrap -->

		<form class="new-review" action="processing.php" method="post">
      <input type="hidden" name="new_review_submit_pg" value="<?= h(u($row['id_mtg'])); ?>">

		<div class="visible">

			<h1><i class="fas fa-users" style="margin-right:1em;"></i> Select your audience</h1>
			<div class="radio-group">
				<div class='radio<?php if ($row['visible'] == "0") { echo " selected"; } ?>' value="0">
					Draft | Save for later.
				</div>
				<div class='radio<?php if ($row['visible'] == "1") { echo " selected"; } ?>' value="1">
					Private | Only you will see this.
				</div>
				<div class='radio<?php if ($row['visible'] == "2") { echo " selected"; } ?>' value="2">
					Members Only | Only members of EvergreenAA.com.</div>
				<div class='radio<?php if ($row['visible'] == "3") { echo " selected"; } ?>' value="3">
					Public | Share with everyone. No membership required.
				</div>

	<?php /* 	grab value and put it into hidden field to submit 
				this is also in _includes/manage_new_review */		?>
				<input type="hidden" name="visible" value="<?php 
				if ($row['visible'] == "0") { echo "0"; } // Draft 
				if ($row['visible'] == "1") { echo "1"; } // Private
				if ($row['visible'] == "2") { echo "2"; } // Members Only
				if ($row['visible'] == "3") { echo "3"; } // Public
				?>" />
			 </div>

		</div><!-- .visible -->

		<input type="submit" name="update-mtg" class="done" value="DONE">
		</form>
			
		<?php } else { echo "<p style=\"margin-top:1.5em;\">Quit trying to be sneaky.</p>"; } ?>
</div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>