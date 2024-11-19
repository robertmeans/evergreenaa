<?php 
$layout_context = 'alt-manage';
require_once 'config/initialize.php'; /* calls controllers/analytics.php */
require_once 'config/verify_admin.php';

if (!isset($_SESSION['id']) || $_SESSION['id'] != '1') { /* this page is for my eyes only */
  header('location: ' . WWW_ROOT);
  exit();
}

if (isset($_SESSION['alertb']) && $_SESSION['alertb'] == '1') {
  /* query to set alert to '0' and then set $_SESSION['alertb'] = 0 AND unset($_SESSION['bbiw']) so it gets rid of the star */
  global $db;

  $sql  = "UPDATE analytics_admin ";
  $sql .= "SET alert=0 ";
  $sql .= "WHERE id=1";

  mysqli_query($db, $sql);

  $_SESSION['alertb'] = '0'; /* turn off star immediately  */
}

require '_includes/head.php'; ?>

<body>
<?php preload_config($layout_context); ?> 
<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-set-timezone.php'; ?>
<?php require '_includes/msg-extras.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<?php $theme = configure_theme(); mobile_bkg_config($theme); ?>
<?php
  $results = get_analytic_data();
  /* reference:   id  occurred  auser_email page  day_opened  mtg_opened  a_ip */
  $i = 0;
  $array = array();
  while ($row = mysqli_fetch_assoc($results)) {
     $array[] = $row;
     $i++;
  }

  $unique_ips = sizeof(array_column($array, null, 'a_ip'));

  mysqli_free_result($results); 
?>
<div id="manage-wrap">
  
  <div class="manage-simple intro">
    <?php require '_includes/inner_nav.php'; ?>
  </div>

  <div class="manage-simple analy"> 
    <h1 class="my-meet">Internal Analytics</h1><p class="my-sort"><a class="phpma" href="<?php 
    if (WWW_ROOT == 'http://localhost/evergreenaa') { ?>http://localhost/phpmyadmin/<?php 
    } else { ?>https://p3plzcpnl504722.prod.phx3.secureserver.net:2083/cpsess0249341861/frontend/jupiter/sql/PhpMyAdmin.html<?php 
    } ?>" target="_blank">phpMyAdmin</a></p>
  </div>

  <div id="ia-wrap">
    <?php // start grabbing data and filling in page ?>
    <p><?= $i; ?> Interactions</p>

    <?php if ($unique_ips > 0) { ?>
      <p><?= $unique_ips; ?> unique IP<?php if ($unique_ips == 0 || $unique_ips > 1) { echo '\'s'; } ?></p>
    <?php } ?>
  </div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>