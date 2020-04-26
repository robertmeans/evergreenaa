<?php $layout_context = "index"; ?>
<?php 
include 'error-reporting.php';

require_once 'config/initialize.php';

if (isset($_GET['token'])) {
	$token = $_GET['token'];
	verifyUser($token);
}

if (!isset($_SESSION['verified'])) {
	header('location: home.php');
	exit;
}

if ((isset($_SESSION['verified']) && (!$_SESSION['message']))) {
	header('location: home_private.php');
	exit;
}

?>

<?php include '_includes/head.php'; ?>

<body>
<?php require '_includes/nav.php'; ?>
	
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="landing">
	<div id="landing-content">

		<?php if(isset($_SESSION['message'])): ?>
		<div class="alert <?= $_SESSION['alert-class']; ?>">
			<?php 
				echo $_SESSION['message'];
				unset($_SESSION['message']);
				unset($_SESSION['alert-class']); 
			?>
		</div><!-- .alert -->
		<?php endif; ?>

		<h1 class="welcome">Welcome<?php if (isset($_SESSION['username'])) { echo ' ' . h($_SESSION['username']) . ','; } else { echo ','; } ?></h1>

		<?php if(!$_SESSION['verified']): ?>
			<div class="alert alert-warning">
				<p>To help keep the riffraff out you need to verify your account. Check your email and click on the link verification that was sent to: <span class="yo-email"><?= $_SESSION['email']; ?></span></p>
				<p>If you think you are seeing this message in error...</p>
				<a class="verified" href="login.php">try to log in</a>
			</div>
		<?php endif; ?>

		<?php if($_SESSION['verified']): ?>
		 	<a class="verified" href="home_private.php">Let me in already!</a>
		 <?php endif; ?>

	</div><!-- #landing-content -->
</div><!-- #landing -->

</body>

<?php require '_includes/footer.php'; ?>