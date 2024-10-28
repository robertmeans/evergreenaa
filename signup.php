<?php 
$layout_context = 'login-page';

require_once 'config/initialize.php';
include '_includes/head.php'; ?>

<body>
<?php preload_config($layout_context); ?>
<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-why-join.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<?php $theme = configure_theme(); mobile_bkg_config($theme); ?>
<div id="landing">
	<form id="signup-form">
    <h1 class="text-center">Join here</h1>

    <div id="login-alert">
      <ul id="errors"></ul>
    </div>

    <input type="text" class="text" name="username" value="<?= h($username); ?>" placeholder="Username" autoFocus>
    <input type="email" class="text" name="email" value="<?= h($email); ?>" placeholder="Email address" required>
    <input type="password" id="showPassword" class="text" name="password" placeholder="Password">
    <input type="password" id="showConf" class="text" name="passwordConf" placeholder="Confirm password">
    
    <div class="showpassword-wrap"> 
        <div id="showSignupPass"><i class="far fa-eye"></i> Show passwords</div>
    </div>

		<input type="hidden" name="signup" value="signup">

    <div id="toggle-btn">
      <div id="signup-btn"><span class="login-txt"><img src="_images/signup.png"></span></div>
    </div>

      <p class="btm-p">Already a member? <a class="log" href="login.php">Sign in</a></p>
	</form>
    
</div><!-- #landing -->

</body>

<?php require '_includes/footer.php'; ?>