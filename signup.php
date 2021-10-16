<?php 

$layout_context = "login-page"; ?>

<?php require_once 'config/initialize.php'; ?>
<?php include '_includes/head.php'; ?>

<body>
<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-why-join.php'; ?>
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="landing">
	<form action="" method="post">
    <h1 class="text-center">Join here</h1>

    <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <input type="text" class="text" name="username" value="<?= h($username); ?>" placeholder="Username">
    <input type="email" class="text" name="email" value="<?= h($email); ?>" placeholder="Email address" required>
    <input type="password" id="showPassword" class="text" name="password" placeholder="Password">
    <input type="password" id="showConf" class="text" name="passwordConf" placeholder="Confirm password">
    
    <div class="showpassword-wrap"> 
        <div id="showSignupPass"><i class="far fa-eye"></i> Show Passwords</div>
    </div>

		<input type="submit" name="submit" class="submit" value="Sign up">
      <p class="btm-p">Already a member? <a class="log" href="login.php">Sign in</a></p>
	</form>
    
</div><!-- #landing -->

</body>

<?php require '_includes/footer.php'; ?>