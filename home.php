<?php 
$layout_context = 'home';
require_once 'config/initialize.php'; 

require '_includes/head.php'; ?>

<body>
<?php $theme = preload_config($layout_context);
require '_includes/nav.php';
require_once '_includes/messages.php';
mobile_bkg_config($theme); ?>
<div id="wrap">
  
<?php if (!is_suspended()) { ?>
<ul id="weekdays">

<?php  
  // this block only needed once for page
  $dt = new DateTime('now'); 
  $user_tz = new DateTimeZone($tz);
  $dt->setTimezone($user_tz);
  $offset = $dt->format('P'); // find offset +, - or = +00:00

  /* get correct data set */
  if (is_visitor()) {
    $subject_set = get_all_public_meetings();
  } else if (is_president()) {
    $subject_set = get_all_public_and_private_meetings();
  } else {
    $subject_set = get_meetings_for_members($user_id);  
  }

  if ($offset == '+00:00') { 
    $time_offset = '00';
    $sorted = mysqli_fetch_all($subject_set, MYSQLI_ASSOC);
    } else if (strpos($offset, '+') !== false) { 
      $time_offset = 'pos';
      $results = mysqli_fetch_all($subject_set, MYSQLI_ASSOC);
    } else if (strpos($offset, '-') !== false) { 
      $time_offset = 'neg';
      $results = mysqli_fetch_all($subject_set, MYSQLI_ASSOC);
  }

if ($time_offset != '00') {
  $sorted = apply_offset_to_meetings($results, $tz, $time_offset);
}

$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'); 
$h = 0;
foreach ($days as $today) { ?>

  <li class="ctr-day">
    <button id="open-<?php echo strtolower($today); ?>" class="day"><?= $today; ?></button>
    <div id="<?php echo strtolower($today); ?>-content" class="day-content">
    <div class="collapse-day">
      <span class="collapse-btn"><i class="fas fa-angle-double-up"></i></span>
    </div>
    <p class="inline-tz"><a class="inline-show-tz"><?php pretty_tz($tz); ?></span></a></p>

      <?php
        list($yesterday, $tomorrow, $y, $d, $t) = day_range($today);
          $i = 1;
          foreach ($sorted as $row) {

            if ($row['mtg_tz'] === $tz) {  
              $mt = new DateTime($row['meet_time']);

            } else {
              $from_tz_obj = new DateTimeZone($row['mtg_tz']);
              $to_tz_obj = new DateTimeZone($tz);

              $mt = new DateTime($row['meet_time'], $from_tz_obj);
              $mt->setTimezone($to_tz_obj);
            }

            $ic = 'i'.$h.'_'.$i;
            $pc = 'p'.$h.'_'.$i;

            if (($row['issues'] < 3) && ($row[$d] == '1')) {
              $mtgs_exist = $today;
              require '_includes/daily-glance.php'; ?>
              <div class="weekday-wrap <?php if (!empty($row['add_note'])) { echo 'note-here'; } ?>">
                <?php require '_includes/meeting-details.php'; ?>
              </div><!-- .weekday-wrap -->
            <?php } 

          $i++; } if (!isset($mtgs_exist) || $mtgs_exist != $today) { ?> <p class="no-mtgs">No meetings posted for <?= $today . ' ' . $offset ?>.</p> <?php } ?>

    </div><!-- #<$today>-content .day-content -->
  </li>

<?php $h++; } ?>

</ul><!-- #weekdays -->

<?php } else { /* suspended (kept meetings) = 1, (meetings into draft) = 2 */
 
  $sus_stuff = suspended_msg($user_id);
  $row = mysqli_fetch_assoc($sus_stuff);
?>
  <div id="sus-wrap">
    <p>This account has been put on hold.</p>
    <p class="sus-header">Additional details</p>
    <div class="sus-notes"><?= $row['sus_notes']; ?></div>
  </div>
<?php } ?>

</div><!-- #wrap -->

<?php require '_includes/footer.php'; ?>