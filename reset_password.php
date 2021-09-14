<?php $layout_context = "login-page"; 
require_once 'config/initialize.php'; 
require '_includes/head.php'; ?>

<body>
<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-why-join.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="landing">
	<form action="" method="post">
        <h1 class="text-center">Reset Your Password</h1>

        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>
                
        <input id="showPassword" type="password" class="text" name="password" placeholder="Password">
        <input id="showConf" type="password" class="text" name="passwordConf" placeholder="Confirm password">
        <div class="showpassword-wrap"> 
            <div id="showSignupPass"><i class="far fa-eye"></i> Show Password</div>
        </div>
        <input type="submit" name="reset-password-btn" class="submit" value="Reset Password">
        
	</form>
    
</div>

</body>

<?php require '_includes/footer.php'; ?>