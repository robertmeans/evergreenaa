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
<?php require '_includes/msg-analytics.php'; ?>

<?php $theme = configure_theme(); mobile_bkg_config($theme); ?>
<?php

  $results = get_analytic_data();
  /* fields are:   id,  occurred,  auser_email, device,  page,  day_opened, host_id, mtg_id,  mtg_opened, mtg_days, mtg_day,  a_ip */
  $i = 0;

  $homepage_loads   = 0;  $ip_groups        = [];  $all_mobile       = '';  
  $sunday_opened    = 0;  $unique_ips       = [];  $all_tablet       = '';  
  $monday_opened    = 0;  $mobile_count     = [];  $all_desktop      = '';  
  $tuesday_opened   = 0;  $tablet_count     = [];  $itemCounts       = [];
  $wednesday_opened = 0;  $desktop_count    = [];  $activeMtgs       = []; 
  $thursday_opened  = 0;  $mobile_unique_a  = [];  $analytics_start_date = '';
  $friday_opened    = 0;  $tablet_unique_a  = [];  $dirCounts        = [];  
  $saturday_opened  = 0;  $desktop_unique_a = [];  

  while ($row = mysqli_fetch_assoc($results)) {

    if ($i === 0) { $analytics_start_date = $row['occurred']; } /* grab reset date */
    if ($row['page'] == 'xxx') { $i++; continue; } /* skip the rest bc I record the date in the 1st record after a reset (via using link on this page) and differentiate it by setting page = 'xxx'. I'm leaving this as it's own separate if statement just in case I delete everything from the analytics table via phpMyAdmin and therefore there is no page = 'xxx' record. */

    if (isset($row['page']) && $row['page'] === 'index') { $homepage_loads++; }

    if (isset($row['day_opened'])) { 
      $day = $row['day_opened']; 
      if ($day === 'Sunday')    { $sunday_opened++;     }
      if ($day === 'Monday')    { $monday_opened++;     }
      if ($day === 'Tuesday')   { $tuesday_opened++;    }
      if ($day === 'Wednesday') { $wednesday_opened++;  }
      if ($day === 'Thursday')  { $thursday_opened++;   }
      if ($day === 'Friday')    { $friday_opened++;     }
      if ($day === 'Saturday')  { $saturday_opened++;   }
    }

    if (!empty($row['device']) && ($row['device'] === 'mobile' && $row['page'] === '')) {  $mobile_count[]   = $row; }
    if (!empty($row['device']) && ($row['device'] === 'tablet' && $row['page'] === '')) {  $tablet_count[]   = $row; }
    if (!empty($row['device']) && ($row['device'] === 'desktop' && $row['page'] === '')) { $desktop_count[]  = $row; }

    if (isset($row['device']) && $row['device'] === 'mobile') { $all_mobile = $row['device'] . ' ' .    $row['a_ip']; }
    if (isset($row['device']) && $row['device'] === 'tablet') { $all_tablet = $row['device'] . ' ' .    $row['a_ip']; }
    if (isset($row['device']) && $row['device'] === 'desktop') { $all_desktop = $row['device'] . ' ' .  $row['a_ip']; }




    $ip = $row['a_ip'];  
    /* get visits that are likely bots due to no interactions, just page visits */
    if (!isset($ip_groups[$ip])) {
        $ip_groups[$ip] = [$row];
    } else {
        $ip_groups[$ip][] = $row;
    }
    /* consolidate unique ip's for a count of how many people are using the site */
    if (!empty($ip) && !in_array($ip, $unique_ips)) { $unique_ips[] = $ip; }




    /* the following is a great little block o' code that will be repurposed a few times */
    /* if $row['mtg_day'] is not empty, they opened a specific meeting */
    /* (more specifically, they clicked on a, '.daily-glance-wrap')    */
    if ($row['mtg_day'] !== '') {
      /* create a record of this meeting, separate day from name by a space for treating the string as an array later so you can grab the specific information you need based on its place in the array */
      $item = $row['mtg_id'] . ' ' . $row['mtg_day'] . ' ' . $row['mtg_opened'];
    } else {
      $item = '';
    }
    /* put this $item into an array of its own so you can run a count() on it later */
    if (isset($itemCounts[$item])) {
      $itemCounts[$item]++;
    } else {
      // Otherwise, initialize its count to 1
      $itemCounts[$item] = 1;
    }




    /* they clicked on "Directions"... */
    if ($row['dir'] !== '') {
      $itemb = $row['mtg_id'] . ' ' . $row['mtg_day'] . ' ' . $row['mtg_opened'];
    } else {
      $itemb = '';
    }
    if (isset($dirCounts[$itemb])) {
      $dirCounts[$itemb]++;
    } else {
      $dirCounts[$itemb] = 1;
    }













    if (!empty($all_mobile) && !in_array($all_mobile, $mobile_unique_a))    { $mobile_unique_a[]  = $all_mobile;  }
    if (!empty($all_tablet) && !in_array($all_tablet, $tablet_unique_a))    { $tablet_unique_a[]  = $all_tablet;  }
    if (!empty($all_desktop) && !in_array($all_desktop, $desktop_unique_a)) { $desktop_unique_a[] = $all_desktop; }

    $i++; /* get total number of rows - everything included */
  } /* end while loop */
 
  mysqli_free_result($results); 

?>
<div id="manage-wrap">
  
  <div class="manage-simple intro">
    <?php require '_includes/inner_nav.php'; ?>
  </div>

  <div class="manage-simple analy"> 
    <h1 class="my-meet">Internal Analytics</h1><p class="my-sort"><a class="phpma" href="<?php 
      if (WWW_ROOT === 'http://localhost/evergreenaa') { 
        ?>http://localhost/phpmyadmin/<?php 
      } else { 
        ?>https://p3plzcpnl504722.prod.phx3.secureserver.net:2083/cpsess0249341861/frontend/jupiter/sql/PhpMyAdmin.html<?php 
      } ?>" target="_blank"><span class="pc">php</span><span class="ma">MyAdmin</span></a></p>
  </div>


<?php /* put links to backup & delete here */ 
    $analytics_begin = DateTime::createFromFormat('H:i:s D, m.d.y', $analytics_start_date);
    $analytics_start_for_export = $analytics_begin->format('mdyHi');
?>
  <div class="db-mng-links">
    <input type="hidden" id="as-date" value="<?= $analytics_start_for_export; ?>">
    <p><a class="link" href="process-sql-export.php"><i class="fas far fa-file-download"></i> Export Entire DB</a> <?php if ($i > 1) { ?><a class="link" href="process-sql-table-analytics-export.php"><i class="fas far fa-file-download"></i> Export analytics Table</a> <a class="link" data-role="pa-reset"><i class="fas far fa-trash"></i> Reset Analytics</a><?php
  } ?></p>
  </div>


<?php 

/* NOTE: some logic no longer makes sense due to implementing the "Reset Analytics" feature. this does not take into account those people who were on the site before the reset and then get counted as 1 visit afterwards. originally, it made sense if an IP only showed up once, that wouldn't make any since because they would not have interacted with the site in any practical way. now, they could have just left a tab open and after a reset, I won't see any of their prior activity. */

/* begin - this grabs each unique ip */
$single_visit_no_action = []; // $unique_row['a_ip'];
$multiple_visits_no_action = []; // $multiple_but_same_ip;

foreach ($ip_groups as $multiple_but_same_ip => $rows) {
  if (count($rows) === 1) {
    // This IP appears only once
    $unique_row = $rows[0];
    // echo "Unique IP: " . $unique_row['a_ip'] . "<br>";
    // Process the unique row as needed
    $single_visit_no_action[] = "'" . $unique_row['a_ip'] . "'"; /* not sure why I had these wrapped in single quotes */
    // $single_visit_no_action[] = $unique_row['a_ip'];
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
      // Process the identical rows as needed
      $multiple_visits_no_action[] = "'" . $multiple_but_same_ip . "'"; 
    }
  }
}
/* end - this grabs each unique ip */
?>
  <div class="ia-headwrap">
    <?php // start grabbing data and filling in page ?>
    <p class="ail"><?php
    date_default_timezone_set('America/Denver');
    $dateTime = DateTime::createFromFormat('H:i:s D, m.d.y', $analytics_start_date);
    $new_start_formatted = $dateTime->format('D, M d, \'y \a\t H:i');

    if ($i === 1) {
      echo 'Recent reset. No new data to process yet.</p>';
      echo '<p>New start date: ' . $new_start_formatted . '</p>';
      echo '</div>'; /* if there is no new data, the opening div.ia-headwrap has been closed and nothing else on page will print */
    } else { /* else, we can continue processing page... (this else closes at btm of page above '</div><!-- #manage-wrap -->' ) */

      /* Start date of currently displayed results */

      $total_interactions = $i - ($homepage_loads + $sunday_opened + $monday_opened + $tuesday_opened + $wednesday_opened + $thursday_opened + $friday_opened + $saturday_opened);

      /* thanks chatGPT... */
      
      $currentTime = new DateTime();
      $interval = $currentTime->diff($dateTime);

      if ($interval->days === 1) { $d = 'day'; } else { $d = 'days'; }
      if ($interval->h === 1) { $h = 'hour'; } else { $h = 'hours'; }
      if ($interval->i === 1) { $min = 'minute'; } else { $min = 'minutes'; }
   
      echo 'Since: ' . $new_start_formatted . '</p>';

      if ($interval->days < 1) {
        // Show the difference in hours and minutes
        echo "<p>" .$interval->h. " ".$h." and " .$interval->i. " ".$min."</p>";
      } else {
        // Show the difference in days, hours, and minutes
        echo "<p>".$interval->days." ".$d.", ".$interval->h." ".$h.", and ".$interval->i." ".$min."</p>";
      } 

      ?>
      <p><span id="js-total-interactions"><?= $total_interactions; ?></span>&nbsp;Interactions |&nbsp;<?php

      /* Unique IP's */
      if (count($unique_ips) == 1 ) { echo '<span id="js-unique-ip">' . count($unique_ips) . '</span>&nbsp;unique IP'; } 
      if (count($unique_ips) == 0 || count($unique_ips) > 1) { echo '<span id="js-unique-ip">' . count($unique_ips) . '</span>&nbsp;unique IP\'s'; } 

      if (count($unique_ips) !== 0) { echo '<a class="tgl-msg" id="toggle-total-interactions"><i class="far fa-question-circle fa-fw"></i></a>'; } ?>

      <?php
      /* Clean up button - collect IP's into comma separated string */
      if (count($unique_ips) > 0) { 
        if (count($single_visit_no_action) > 0 && count($multiple_visits_no_action) === 0) {
          $list_to_delete = implode(', ', $single_visit_no_action);
        } else if (count($multiple_visits_no_action) > 0 && count($single_visit_no_action) === 0) {
          $list_to_delete = implode(', ', $multiple_visits_no_action);
        } else { 
          $list_to_delete = implode(', ', $single_visit_no_action) . ', ' . implode(', ', $multiple_visits_no_action);
        } 

      if ($single_visit_no_action || $multiple_visits_no_action) {
      ?>
       <div id="clean-up-btn"><input type="hidden" id="ip-delete-list" value="<?php echo $list_to_delete; ?>"><a class="analytics-cleanup">Delete "no action" IP's below</a></div>
      <?php } 
        }

    ?></p>
  </div>

<?php if ($single_visit_no_action || $multiple_visits_no_action) { ?>
  <div id="replace-this" class="ia-ip-list">
  <?php if ($single_visit_no_action) { ?>
    <div class="col unique-ips">
      <div><h1>Unique IP</h1><a class="tgl-msg" id="toggle-clean-up-ips"><i class="far fa-question-circle fa-fw"></i></a></div>
      <p class="ip-notes">appears only once, no actions taken</p>
      <div class="div-svna">
      <?php 
      $new_single_visit_list = [];
      foreach ($single_visit_no_action as $item) {
        $ip = str_replace("'", "", $item); // remove all single quotes
        $new_single_visit_list[] = '<a class="svna';
        /* add a border-bottom for each except last if there are 3+ */
        if (count($single_visit_no_action) > 2) { $new_single_visit_list[] .= ' bb'; }
        $new_single_visit_list[] .= '" data-role="svna" data-id="'.$ip.'"><i class="far fa-copy fa-fw"></i>' .  $ip . '</a>';
      }
      echo implode("", $new_single_visit_list);

      ?>
    </div>
    </div>
  <?php } if ($multiple_visits_no_action) { ?>
    <div class="col multi-visits">
      <h1>Multiple visits</h1>
      <p class="ip-notes">no action taken</p>
      <div class="div-svna">
      <?php 
      $new_multiple_visits = [];
      foreach ($multiple_visits_no_action as $item) {
        $ip = str_replace("'", "", $item); // remove all single quotes
        $new_multiple_visits[] = '<a class="svna';
        /* add a border-bottom for each except last if there are 3+ */
        if (count($multiple_visits_no_action) > 2) { $new_multiple_visits[] .= ' bb'; }
        $new_multiple_visits[] .= '" data-role="svna" data-id="'.$ip.'"><i class="far fa-copy fa-fw"></i>' .  $ip . '</a>';
      }
      echo implode("", $new_multiple_visits); 

      ?>
    </div>
    </div>
  <?php } ?>
  </div>
<?php } ?>

  <div class="ia-ip-list">

    <div class="col sp"><?php /* sp = special, bc this one has extra margin to push it down on desktop */ ?>
      <div><?php /* so you can treat this as one block */ ?>
      <?php /* Unique IP's for per device */ ?>
      <p><u>Unique IP addresses per device</u><a class="tgl-msg" id="toggle-unique-ip"><i class="far fa-question-circle fa-fw"></i></a>
        <br>
      <p><span id="uipmobile"><?= count($mobile_unique_a); ?></span> Mobile &nbsp;●&nbsp; 
         <span id="uiptablet"><?= count($tablet_unique_a); ?></span> Tablet &nbsp;●&nbsp; 
         <span id="uipdesktop"><?= count($desktop_unique_a); ?></span> Desktop</p>
         <input type="hidden" id="sum-devices" value="<?php echo (count($mobile_unique_a) + count($tablet_unique_a) + count($desktop_unique_a)); ?>">
      <br>
      <p><u>Individual interactions</u><?php /* */ ?><a class="tgl-msg" id="toggle-individual-interactions"><i class="far fa-question-circle fa-fw"></i></a><?php /* */ ?><br>
      <p><?= count($mobile_count); ?> Mobile &nbsp;●&nbsp; 
         <?= count($tablet_count); ?> Tablet &nbsp;●&nbsp; 
         <?= count($desktop_count); ?> Desktop</p>
         <input type="hidden" id="totb-in-int" value="<?php echo count($mobile_count) + count($tablet_count) + count($desktop_count); ?>">
      </div>
    </div>
    <div class="col b"><div></div></div><?php /* border, single pixel (center divider) */ ?>
    <div class="col daysop">
      <div><?php /* so you can treat this as one block */ ?>
      <?php
      /* prepare data */
      $weekdays = array('Sunday' => $sunday_opened,
                        'Monday' => $monday_opened,
                        'Tuesday' => $tuesday_opened,
                        'Wednesday' => $wednesday_opened,
                        'Thursday' => $thursday_opened,
                        'Friday' => $friday_opened,
                        'Saturday' => $saturday_opened,
                      );
      arsort($weekdays); /* sort by value */
      ?>
      <div class="aweek-wrap">
        <div class="aweek-row-top">
          <div class="anum">Days Opened</div><div class="aday">&nbsp;</div>
        </div>
        <?php
        foreach ($weekdays as $day => $num) { ?>
          <div class="aweek-row">
            <div class="anum"><?= $num ?></div><div class="aday"><?= $day ?></div>
          </div>
        <?php } ?>

      </div>
      </div>
    </div>

  </div>

<?php // if (count($itemCounts) > 0) { ?>
  <div class="ia-ip-list">
    <div class="col">
  
    <div class="rowa-header">
      <div class="counta">
        Count <?php // echo count($itemCounts) - 1; 
        /* sub 1 bc otherwise it starts at 0 and the count is 1 too many */
        /* it is counting the number of meetings that have been opened.  */
        /* and I have to make the base = 1 so that mtgs that are only    */
        /* counted once will at least have a count of 1.                 */?>
      </div>
      <div class="daya">
        Day
      </div>
      <div class="timea">
        Time
      </div>
      <div class="mtgnamea">
        Meeting Name
      </div>
    </div>

<?php
arsort($itemCounts);
foreach ($itemCounts as $item => $count) {
  if ($item !== '') {
    $words = explode(' ', $item);
    $meet_id = $words[0];
    $day = $words[1];
    $time = $words[2] . ' ' . $words[3];
    $stringend = array_slice($words, 4);
    $mtgname = implode(' ', $stringend);
    ?>
    <div class="rowa">
      <div class="counta">
        <?= $count; ?>
      </div>
      <div class="daya">
        <?= $day; ?>
      </div>
      <div class="timea">
        <?= $time; ?>
      </div>
      <div class="mtgnamea">
        <?= $mtgname; ?>
      </div>
    </div>
    <?php
    // echo "$count: $day, $time - $mtgname" . "<br>";
  }
}
?>
    </div>
  </div>
<?php // } ?>

<?php } /* end else */ ?>

</div><!-- #manage-wrap -->




<div id="theModal-ia" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <a class="static closefp"><i class="fas fa-fw fa-times"></i></a>
        <h4 class="modal-title">Reset Analytics</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <h3>&nbsp;</h3>
      </div>
    </div>
  </div>
</div> 




<?php require '_includes/footer.php'; ?>