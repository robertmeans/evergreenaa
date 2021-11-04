<?php $layout_context = "forgot-password"; 
require_once 'config/initialize.php'; 
require '_includes/head.php'; ?>

<body>
<?php 
if (WWW_ROOT != 'http://localhost/evergreenaa') { ?>
    <div class="preload"><p>One day at a time.</p></div>
<?php } ?>    
<?php require '_includes/nav.php'; ?> 
<?php require '_includes/msg-why-join.php'; ?> 
<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="landing">
	<form action="" method="post">
    <h1 class="text-center">Recover your password</h1>

    <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if(isset($_SESSION['message'])): ?>
    <div class="alert <?= $_SESSION['alert-class']; ?>">
        <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            unset($_SESSION['alert-class']); 
        ?>
    </div><!-- .alert -->
    <?php endif; ?>

    <div class="pswd-recovery">
        <p class="forgot-pswd">Please enter your email address used to create your account and I will help you reset your password.</p>
    </div>
    <input type="email" class="text" name="email" placeholder="Enter your email">
            
    <input type="submit" name="forgot-password" class="submit" value="Password recovery">
    <p class="btm-p try-again">Think you remembered it? <a class="log" href="login.php">Try again</a></p>
	</form>
    
</div>

</body>

<?php require '_includes/footer.php'; ?>