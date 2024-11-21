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
  /* fields are:   id,  occurred,  auser_email, page,  day_opened,  mtg_opened,  a_ip */
  $i = 0;
  $ip_groups = [];
  $unique_count = 0;
  $unique_ips = [];

  while ($row = mysqli_fetch_assoc($results)) {

    $all_records[] = $row; /* grab everything for later processing */

    $ip = $row['a_ip']; /* 'bout to do tricky stuff based on IP addresses... */
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

    $i++; /* get total number of rows - everything included */
  }
 
?>
<div id="manage-wrap">
  
  <div class="manage-simple intro">
    <?php require '_includes/inner_nav.php'; ?>
  </div>

  <div class="manage-simple analy"> 
    <h1 class="my-meet">Internal Analytics</h1><p class="my-sort"><a class="phpma" href="<?php 
    if (WWW_ROOT === 'http://localhost/evergreenaa') { ?>http://localhost/phpmyadmin/<?php 
    } else { ?>https://p3plzcpnl504722.prod.phx3.secureserver.net:2083/cpsess0249341861/frontend/jupiter/sql/PhpMyAdmin.html<?php 
    } ?>" target="_blank">phpMyAdmin</a></p>
  </div>

<?php  
/* begin - this grabs each unique ip */
$single_visit_no_action = []; // $unique_row['a_ip'];
$multiple_visits_no_action = []; // $multiple_but_same_ip;

foreach ($ip_groups as $multiple_but_same_ip => $rows) {
  if (count($rows) === 1) {
    // This IP appears only once
    $unique_row = $rows[0];
    // echo "Unique IP: " . $unique_row['a_ip'] . "<br>";
    // Process the unique row as needed
    $single_visit_no_action[] = "'" . $unique_row['a_ip'] . "'";
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
      // echo "Multiple but same: " . $multiple_but_same_ip . "<br>";
      // Process the identical rows as needed
      $multiple_visits_no_action[] = "'" . $multiple_but_same_ip . "'";
    }
  }
}
/* end - this grabs each unique ip */

/* begin - get first row date to use as "analytics started" date */
foreach ($all_records as $row) {
  $analytics_start_date = $row['occurred'];
  break;
}
/* end - get first row date */

/* begin - homepage only count */
  $homepage_loads = 0;
  foreach ($all_records as $row) {
    if (!empty($row['page']) && empty($row['day_opened']) && empty($row['mtg_opened'])) {
      $homepage_loads++;
    }
  }
/* end - homepage only count */
?>
  <div class="ia-headwrap">
    <?php // start grabbing data and filling in page ?>
    <p class="ail"><?php

      $dateTime = DateTime::createFromFormat('H:i:s D, m.d.y', $analytics_start_date);
      $new_start_formatted = $dateTime->format('l, F d, Y \a\t H:i:s A');

      echo 'Since: ' . $new_start_formatted . '<br>' . $i - $homepage_loads . ' Interactions | ';

      if ($unique_count == 1 ) { echo $unique_count . ' unique IP'; } 
      if ($unique_count == 0 || $unique_count > 1) { echo $unique_count . ' unique IP\'s'; } 

      if ($unique_count > 0) { 
      $list_to_delete = implode(', ', $single_visit_no_action) . ', ' . implode(', ', $multiple_visits_no_action); 

      if ($single_visit_no_action || $multiple_visits_no_action) {
      ?>
       <div id="clean-up-btn"><input type="hidden" id="ip-delete-list" value="<?php echo $list_to_delete; ?>"><a class="analytics-cleanup">Clean up</a></div>
      <?php } 
        }

    ?></p>
  </div>

<?php if ($single_visit_no_action || $multiple_visits_no_action) { ?>
  <div id="replace-this" class="ia-ip-list">
  <?php if ($single_visit_no_action) { ?>
    <div class="col unique-ips">
      <h1>Unique IP</h1>
      <p class="ip-notes">appears only once, no actions taken</p>
      <?php 
      $new_single_visit_list = [];
      foreach ($single_visit_no_action as $item) {
        $new_single_visit_list[] = str_replace("'", "", $item) . "<br>"; // remove all single quotes
      }
      echo implode("", $new_single_visit_list);

      ?>
    </div>
  <?php } if ($multiple_visits_no_action) { ?>
    <div class="col multi-visits">
      <h1>Multiple visits</h1>
      <p class="ip-notes">no action taken</p>
      <?php 
      $new_multiple_visits = [];
      foreach ($multiple_visits_no_action as $item) {
        $new_multiple_visits[] = str_replace("'", "", $item) . "<br>";
      }
      echo implode("", $new_multiple_visits); 

      ?>
    </div>
  <?php } ?>
  </div>
<?php } ?>

<?php mysqli_free_result($results); ?>

</div><!-- #manage-wrap -->

<?php require '_includes/footer.php'; ?>