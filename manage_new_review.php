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

if (!isset($_GET['id'])) {
	header('location: index.php');
}

$id = $_GET['id'];
$id_user = $_SESSION['id'];
$role = $_SESSION['admin'];

$row = edit_meeting($id_user, $id);

require '_includes/head.php'; ?>

<body>
<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-set-timezone.php'; ?>
<?php require '_includes/msg-extras.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="manage-wrap">
	
<div class="confirm">TEST & SELECT AUDIENCE</div>	
<div class="manage-simple intro">
	<?php if ($role != 1 && $role != 2) { ?>
	<p>Take a look. Is everything the way you want it? If not, click the <a class="manage-edit inline" href="manage_edit.php?id=<?= h(u($id)); ?>"><i class="far fa-edit"></i> edit button</a> and polish this sucker up! Or save it for later.</p>
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
		
		<?php if ($row['id_user'] == $_SESSION['id']) { ?>

			<?php require '_includes/new-review-glance.php'; ?>
			<div class="weekday-edit-wrap">
				<?php require '_includes/new-review-details.php'; ?>

			</div><!-- .weekday-wrap -->

		<form class="new-review" action="new_review_submit.php?id=<?= h(u($row['id_mtg'])); ?>" method="post">

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