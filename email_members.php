<?php 
require_once 'config/initialize.php';

$layout_context = "email-members";

if (!is_executive()) {
	header('location: https://www.merriam-webster.com/dictionary/go%20away');
	exit();
}

$resultz = find_all_hosts();
	$emailz = array();
	while($subject = mysqli_fetch_assoc($resultz)) {
		$emailz[] = $subject['email'] . "; ";
	}
	$member_addresses = substr(implode($emailz), 0 , -2);

$result = find_all_users();
	$emails = array();
	// get email addresses ready for sending and put them in a hidden field
	while($subject = mysqli_fetch_assoc($result)) {
		$emails[] = $subject['email'] . "; ";
	}
	// get rid of the last comma
	$all_email_addresses = substr(implode($emails), 0 , -2);

?>

<?php require '_includes/head.php'; ?>
<body>	
<?php preload_config($layout_context); ?>   
<?php require '_includes/nav.php'; ?>
<?php require_once '_includes/messages.php'; ?>
<?php $theme = configure_theme(); mobile_bkg_config($theme); ?>
<div id="manage-wrap">

<div class="manage-simple intro">	
<p>Email All Members</p>
<?php require '_includes/inner_nav.php'; ?>
</div>

<div class="manage-simple-email">

	<form class="admin-email-form" action="email_review_BCC.php" method="post">

		<div class="bccem">
			<input id="pickitup" type="hidden" value="<?= strtolower($member_addresses); ?>" class="day-values input-copy">
			<a data-role="em" data-id="pickitup"><i class="far fa-copy"></i> Only Hosts</a>


			<input id="pickemup" type="hidden" value="<?= strtolower($all_email_addresses); ?>" class="day-values input-copy">
			<a data-role="em" data-id="pickemup"><i class="far fa-copy"></i> All Addresses</a>			
		</div>

	
	</div><!-- .btm-notes -->
	</form>
</div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>
<?php // mysqli_free_result($result); ?>
