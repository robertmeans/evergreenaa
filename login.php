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
<form id="login-form">
  <h1 class="text-center">Login</h1>

  <div id="session-msg">
    <?php if(isset($_SESSION['message'])) { ?>
    <div class="alert <?php 
    echo $_SESSION['alert-class'];

    $reset_pswd = strval($_SESSION['message']);
    $reset_txt = 'Your password has been updated.';
    $new_mem = 'Your email address was successfully verified! You can now login.';

    // if (strpos($reset_pswd, $reset_txt) !== false || strpos($reset_pswd, $new_mem) !== false) {
    if (str_contains($reset_pswd, $reset_txt) !== false || str_contains($reset_pswd, $new_mem) !== false) {
    // strpos() instead of str_contins() bc we're on PHP 7.4 
      echo ' left'; 
    } 
    ?>">

      <?php
        if (isset($_SESSION['username'])) { echo $_SESSION['username'] . ',<br>'; } 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        unset($_SESSION['alert-class']); 
      ?>
    </div><!-- .alert -->
    <?php } ?>
  </div>

  <div id="login-alert">
    <ul id="errors"></ul>
  </div>

  <input type="text" class="text" name="username" value="<?= $username; ?>" placeholder="Username or Email" autoFocus>       
  <input type="password" id="password" class="text login-pswd" name="password" placeholder="Password">
  
  <div class="showpassword-wrap"> 
      <div id="showLoginPass"><i class="far fa-eye"></i> Show password</div>
  </div>

  <input type="checkbox" name="remember_me" id="remember_me">
  <label for="remember_me" class="rm-checked"> 
    <div class="rm-wrap">
        <div class="aa-rm-out">
            <div class="aa-rm-in"></div>
        </div>
        <span class="rm-rm">Remember me</span>
    </div>
  </label>
  
  <input type="hidden" name="login" value="login">

  <div id="toggle-btn">
    <div id="login-btn"><span class="login-txt"><img src="_images/login.png"></span></div>
  </div>

  <p class="btm-p">No account? <a class="log" href="signup.php">Create one</a></p>

  <div class="fpwd"><a href="forgot_password.php">Forgot your Password?</a></div>
</form>
 
</div><!-- #landing -->

</body>

<?php require '_includes/footer.php'; ?>