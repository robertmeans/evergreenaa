<?php

$layout_context = "forgot-password"; 

require_once 'config/initialize.php'; 
require '_includes/head.php'; ?>

<body>
<?php /* page so tiny - do you really a preload?
if (WWW_ROOT != 'http://localhost/evergreenaa') { ?>
    <div class="preload"><p>One day at a time.</p></div>
<?php } */ ?>    
<?php require '_includes/nav.php'; ?> 
<?php require '_includes/msg-why-join.php'; ?> 
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="landing">
	<form id="forgotpass-form">
    <h1 class="text-center">Reset your password</h1>

    <div id="login-alert">
      <ul id="errors"></ul>
    </div>

    <input type="text" id="hidethis" class="text" name="foo" value="foo"><?php /* don't know why this is necessary but it would not submit properly with only an email field. I worked on this all day and finally stumbled on adding another superfluous field in order to get it to work. I hope one day to understand just wtf is happening here. */ ?>
    <input type="email" class="text" name="email" placeholder="Email address" autoFocus>

    <input type="hidden" name="forgotpass" value="forgotpass">

    <div id="toggle-btn">
      <div id="forgotpass-btn"><span class="login-txt"><img src="_images/resetpass.png"></span></div>
    </div>

    <p class="btm-p try-again">Think you remembered it? <a class="log" href="login.php">Try again</a></p>
	</form>
    
</div>

</body>

<?php require '_includes/footer.php'; ?>