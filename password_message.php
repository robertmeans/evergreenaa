<?php $layout_context = "password-message"; 
require_once 'config/initialize.php'; 
require '_includes/head.php'; ?>

<body>
<?php $theme = configure_theme(); mobile_bkg_config($theme); ?>
<div id="landing">
	<div id="landing-content">
		<h1 class="text-center">Evergreen AA</h1>
		<div class="pswd-recovery">
             <h1 class="text-center">Help on the way!</h1>
        </div>
        <div class="alert alert-warning">
			<p class="center">An email has been sent to your email address to reset your password.</p>
		</div>
       <a class="verified" href="login.php">wait at the login screen</a>
         
    </div><!-- #landing-content -->
</div>
</body>

<?php require '_includes/footer.php'; ?>