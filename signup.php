<?php $layout_context = "signup"; ?>
<?php
// ini_set("display_errors","on");
// error_reporting(E_ALL && ~E_NOTICE);
?>
<?php require_once 'controllers/authController.php'; ?>
<?php include '_includes/head.php'; ?>

<body>
<?php require '_includes/nav.php'; ?>
<?php // require '_includes/msg-one.php'; ?>
<?php // require '_includes/msg-two.php'; ?>	
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="landing">
	<form action="" method="post">
        <h1 class="text-center">Register</h1>

        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <input type="text" class="text" name="username" value="<?= $username; ?>" placeholder="Username">
        <input type="email" class="text" name="email" value="<?= $email; ?>" placeholder="Email address" required>
        <input type="password" class="text" name="password" placeholder="Password">
        <input type="password" class="text" name="passwordConf" placeholder="Confirm password">
        <!-- <button type="submit" name="signup-btn">Sign Up</button> -->
		<input type="submit" name="submit" class="submit" value="Submit">
        <p class="btm-p">Already a member? <a class="log" href="login.php">Sign in</a></p>
	</form>
    
</div><!-- #landing -->

</body>

<?php require '_includes/footer-static.php'; ?>