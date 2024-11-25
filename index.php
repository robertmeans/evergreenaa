<?php 
require_once 'config/initialize.php';

$layout_context = "login-page";

if (isset($_GET['token'])) {
	$token = $_GET['token'];
	verifyUser($token);
}

if (isset($_GET['password-token'])) {
	$passwordToken = $_GET['password-token'];
	resetPassword($passwordToken);
}

if (!isset($_SESSION['verified'])) {
	require 'home.php';
	exit;
}

if (isset($_SESSION['mode']) && $_SESSION['mode'] == 1) {
	require 'home_admin.php';
	exit;
}

if (((isset($_SESSION['verified']) && ($_SESSION['verified'] != "0")) && (!isset($_SESSION['message'])))) {
	require 'home_private.php';
	exit;
}

include '_includes/head.php'; ?>

<body>
<?php /* special preload just for index in order to preload the preload image */
      /* this image will be used everywhere other than the index              */
if (WWW_ROOT != 'http://localhost/evergreenaa') { ?>
<?php $theme = preload_config($layout_context); ?>
<?php } ?>
<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-why-join.php'; ?>
<?php require '_includes/msg-theme-message.php'; ?>
<?php mobile_bkg_config($theme); ?>
<div id="landing">
	<div id="landing-content">

		<?php if(isset($_SESSION['message'])) { ?>
		<div class="alert <?php if (isset($_SESSION['alert-class'])) { echo $_SESSION['alert-class']; } ?>">
			<?php 
				echo $_SESSION['message'];
        $check_for = strval($_SESSION['message']);
				unset($_SESSION['message']);
				unset($_SESSION['alert-class']); 
			?>
		</div><!-- .alert -->
		<?php } ?>

    <?php 
      if (!isset($check_for)) { $check_for = ''; }
      $not_found = 'User not found.';
      if (isset($_SESSION['username']) && strpos($check_for, $not_found) === false) { 
        // if 'User not found' is NOT the session message then greet with their username
    ?>
		  <h1 class="welcome">Welcome<?php if (isset($_SESSION['username'])) { echo ' ' . h($_SESSION['username']) . ','; } else { echo ','; } ?></h1>
    <?php } ?>


		<?php if($_SESSION['verified'] === false) { ?>
			<div class="alert new-member">
				<p>Check your email and click on the link verification that was sent to: <span class="yo-email"><?= $_SESSION['email']; ?></span></p>
				<p>It could take up to 2 minutes. Check Spam, Junk, etc. if you don't see it.</p>
				<p>&nbsp;</p>
				<p>If you think you are seeing this message in error...</p>
				<a class="verified" href="login.php">try to log in</a>
			</div>
		<?php } ?>

		<?php if($_SESSION['verified']) { ?>
      <p>Your account is ready!</p>
		 	<a class="verified" href="<?= WWW_ROOT ?>">Click here to sign in</a>
		 <?php } ?>

	</div><!-- #landing-content -->
</div><!-- #landing -->

</body>

<?php require '_includes/footer.php'; ?>