<?php $layout_context = "reset-password"; ?>
<?php require_once 'controllers/authController.php' ?>

<?php include '_includes/head.php'; ?>

<body>
<?php require '_includes/nav.php'; ?>
<?php // require '_includes/msg-one.php'; ?>
<?php // require '_includes/msg-two.php'; ?>
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
                
        <input type="password" class="text" name="password" placeholder="Password">
        <input type="password" class="text" name="passwordConf" placeholder="Confirm password">

        <input type="submit" name="reset-password-btn" class="submit" value="Reset Password">
        
	</form>
    
</div>

</body>

<?php require '_includes/footer.php'; ?>