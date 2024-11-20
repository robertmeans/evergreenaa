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
  $array = [];
  $ip_counts = [];
  $ip_counts2 = [];

  while ($row = mysqli_fetch_assoc($results)) {
    $array[] = $row;

    /* this shows those ip's that only occur once */
    $ip = $row['a_ip'];
    $ip2 = $row['auser_email'] . ' ' . $row['page'] . ' ' . $row['a_ip'];

    if (!isset($ip_counts[$ip])) {
      $ip_counts[$ip] = 1;
    } else {
      $ip_counts[$ip]++;
    }


    if (!isset($ip_counts2[$ip2])) {
      $ip_counts2[$ip2] = 1;
    } else {
      $ip_counts2[$ip2]++;
    }


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

  <div class="ia-headwrap">
    <?php // start grabbing data and filling in page ?>
    <p class="ail"><?php
      echo $i . ' Interactions | ';

      if ($unique_ips == 1 ) { echo $unique_ips . ' unique IP'; } 
      if ($unique_ips == 0 || $unique_ips > 1) { echo $unique_ips . ' unique Ip\'s'; } 


    ?></p>



<?php  /* this grabs each unique ip - an ip that only appears once */
foreach ($ip_counts as $ip => $count) {
  if ($count === 1) {
    // This IP appears only once
    echo 'Unique: ' .  $ip . '<br>';
    // You can further process this unique IP, such as storing it in an array or performing other actions.
  }
}

echo '<br><br>';

foreach ($ip_counts2 as $ip2 => $count) {
  if ($count !== 1) {
    // This IP appears only once
    echo 'Unique: ' .  $ip2 . '<br>';
    // You can further process this unique IP, such as storing it in an array or performing other actions.
  }
}

?>


  </div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>