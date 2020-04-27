<?php $layout_context = "login-page"; ?>
<?php 
include 'error-reporting.php';

require_once 'config/initialize.php';

include '_includes/head.php'; 
?>

<body>
<?php require '_includes/nav.php'; ?>

<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">
<div id="landing">
    <form action="" method="post">
        <h1 class="text-center">Login</h1>

        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <?php // if(isset($rememberme_error)) { echo $rememberme_error; } ?>
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

        <!-- 
        <input type="text" class="text" name="email" value="<?php //if(isset($email)) { echo h($email); } ?>" placeholder="Email address">
        -->

        <input type="text" class="text" name="username" value="<?= $username; ?>" placeholder="Username or Email">
                
        <input type="password" class="text" name="password" placeholder="Password">
        <!-- **Awa: Add remember me option -->
        <label for="remember_me">
            <input type="checkbox" name="remember_me" id="remember_me">Remember me
        </label>
        <input type="submit" name="login" class="submit" value="Login">

        <p class="btm-p">No account? <a class="log" href="signup.php">Create one</a></p>
        <!-- <p class="btm-p">Not a member? <a class="log" href="signup.php">Sign up</a></p> -->
        <div style="font-size:0.8em; text-align:center; color:#fff;"><a style="color:#fff;" href="forgot_password.php">Forgot your Password?</a></div>
    </form>
    
</div><!-- #landing -->

</body>

<?php require '_includes/footer.php'; ?>