<?php 
$layout_context = 'alt-manage';
require_once 'config/initialize.php'; /* calls controllers/analytics.php */
require_once 'config/verify_admin.php';

if (!isset($_SESSION['id']) || $_SESSION['id'] != '1') { /* my eyes only */
  header('location: ' . WWW_ROOT);
  exit();
}

require '_includes/head.php'; ?>

<body>
<?php preload_config($layout_context); ?> 
<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-set-timezone.php'; ?>
<?php require '_includes/msg-extras.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<?php $theme = configure_theme(); mobile_bkg_config($theme); ?>
<div id="manage-wrap">
  
  <div class="manage-simple intro">
    <?php require '_includes/inner_nav.php'; ?>
  </div>

  <div class="manage-simple"> 
    <h1 class="my-meet">Internal Analytics</h1>
  </div>

  <div id="ia-wrap">
    <?php // start grabbing data and filling in page ?>
    <p>Total site visits since November 16, 2024 at 10:59 AM.</p>
  </div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>