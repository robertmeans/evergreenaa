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
  $ip_groups = [];

  $unique_count = 0;
  $unique_ips = [];

  while ($row = mysqli_fetch_assoc($results)) {
    $array = $row;

    $ip = $row['a_ip'];
    /* get visits that are likely bots due to no interactions, just page visits */
    if (!isset($ip_groups[$ip])) {
        $ip_groups[$ip] = [$row];
    } else {
        $ip_groups[$ip][] = $row;
    }

    /* consolidate unique ip's for a count of how many people are using the site */
    if (!in_array($ip, $unique_ips)) {
        $unique_ips[] = $ip;
        $unique_count++;
    }

    /* get total number of rows total interactions */
    $i++;
  }


  
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

      if ($unique_count == 1 ) { echo $unique_count . ' unique IP'; } 
      if ($unique_count == 0 || $unique_count > 1) { echo $unique_count . ' unique Ip\'s'; } 


    ?></p>



<?php  /* this grabs each unique ip - an ip that only appears once */
foreach ($ip_groups as $ip => $rows) {
  if (count($rows) === 1) {
    // This IP appears only once
    $unique_row = $rows[0];
    echo "Unique IP: " . $unique_row['a_ip'] . "<br>";
    // Process the unique row as needed
  } else {
    // This IP appears multiple times
    $first_row = $rows[0];
    $all_same_except_id_and_occurred = true;
    foreach ($rows as $row) {
      if ($row['auser_email'] !== $first_row['auser_email'] ||
        $row['day_opened'] !== $first_row['day_opened'] ||
        $row['mtg_opened'] !== $first_row['mtg_opened']) {
        $all_same_except_id_and_occurred = false;
        break;
      }
    }

    if ($all_same_except_id_and_occurred) {
      echo "Multiple but same: " . $ip . "<br>";
        // Process the identical rows as needed
    }
  }
}


/* add link here for - remove_likely_bots($bot_ips); 
link title idea: Remove Likely Bots
and put all the results in the foreach above into arrays so you can implode them, etc. */


mysqli_free_result($results); 
?>


  </div>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>