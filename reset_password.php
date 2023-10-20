<?php 
$layout_context = 'login-page'; 
require_once 'config/initialize.php'; 
require '_includes/head.php'; ?>

<body>
<?php preload_config($layout_context); ?>   
<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-why-join.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="landing">
	<form id="resetpass-form">
    <h1 class="text-center">Reset Your Password</h1>


    <?php if (isset($_SESSION['email'])) { ?>
    <div id="login-alert">
      <ul id="errors"></ul>
    </div>
  
    <?php /* echo $_SESSION['email']; */ ?>
    <input id="showPassword" type="password" class="text" name="password" placeholder="Password" autoFocus>
    <input id="showConf" type="password" class="text" name="passwordConf" placeholder="Confirm password">
    
    <div class="showpassword-wrap"> 
      <div id="showSignupPass"><i class="far fa-eye"></i> Show Password</div>
    </div>

    <input type="hidden" name="resetpass" value="resetpass">
    <!-- <input type="submit" name="reset-password-btn" class="submit" value="Reset Password"> -->
    <div id="toggle-btn">
      <div id="resetpass-btn"><span class="login-txt"><img src="_images/resetpass.png"></span></div>
    </div>  

 <?php } else { ?>
    <div id="login-alert" class="red">
      <ul id="errors">
        <li>It seems you got here without a valid password reset token. Please visit <a class="fp-link" href="<?= WWW_ROOT ?>/forgot_password.php">Forgot Password</a> to initiate the process. You need to use the unique link sent to your email.</li>
      </ul>
    </div>
  <?php } ?>

  <p class="btm-p try-again">Think you remembered it? <a class="log" href="login.php">Try it</a>.</p>
	</form>
    
</div>

</body>

<?php require '_includes/footer.php'; ?>