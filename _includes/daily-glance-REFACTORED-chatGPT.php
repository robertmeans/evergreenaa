<?php 
  $mtg_days = $row['sun'].$row['mon'].$row['tue'].$row['wed'].$row['thu'].$row['fri'].$row['sat']; 

  $visible = '';
  if ($row['visible'] == '0') { $visible = 'DRAFT'; }
  if ($row['visible'] == '1') { $visible = 'PRIVATE'; }
  if ($row['visible'] == '2') { $visible = 'MEMBER-ONLY'; }
  if ($row['visible'] == '3') { $visible = 'PUBLIC'; }

  $dayNames = [];
  if ($row['sun'] == '1') { array_push($dayNames, 'Sun'); }
  if ($row['mon'] == '1') { array_push($dayNames, 'Mon'); }
  if ($row['tue'] == '1') { array_push($dayNames, 'Tue'); }
  if ($row['wed'] == '1') { array_push($dayNames, 'Wed'); }
  if ($row['thu'] == '1') { array_push($dayNames, 'Thu'); }
  if ($row['fri'] == '1') { array_push($dayNames, 'Fri'); }
  if ($row['sat'] == '1') { array_push($dayNames, 'Sat'); }
  
  if ($layout_context === 'delete-mtg' || $layout_context === 'alt-manage'|| $layout_context === 'um-alt'|| $layout_context === 'dashboard') { ?>
  <div class="mtgdays"><?= $visible; ?> | Held on: <?= implode(', ', $dayNames); ?></div>
<?php } ?>

<div class="daily-glance-wrap<?php if ($layout_context === 'delete-mtg' || $layout_context === 'alt-manage') { echo ' alt-page'; } ?>" data-id="<?= $pc; ?>">
  <input type="hidden" data-role="<?= $pc; ?>_mtg-id" value="<?= $row['id_mtg']; ?>">
  <input type="hidden" data-role="<?= $pc; ?>_hid" value="<?= $row['id_user']; ?>">
  <input type="hidden" data-role="<?= $pc; ?>_mtgdz" value="<?= $mtg_days; ?>">
  <input type="hidden" data-role="<?= $pc; ?>_mtg-day" value="<?= $today; ?>">
  <div class="daily-glance<?php 
    if ($layout_context === 'delete-mtg' || $layout_context === 'alt-manage') { echo ' alt-page'; }
    if ($row['visible'] == 1 && (is_president() && !is_owner($row)) && $layout_context === 'home') { echo ' personal-other'; } 
    if ($row['visible'] == 1 && is_owner($row) && $layout_context === 'home') { echo ' personal-odin'; } ?>">
    <div class="glance-mtg glance-mtg-time">
      <p data-role="<?= $pc; ?>_mtgtm"><?= $mt->format('g:i') ?> <span data-ampm='<?= $mt->format('A') ?>'><?= $mt->format('A') ?></span></p>
    </div><!-- .glance-time-day -->
    <div class="glance-mtg glance-group-title">
    <?php 
      if  (
          !is_owner($row) &&  
          (is_admin() && in_admin_mode() && ($row['role'] == 99 || $row['role'] == 80 || $row['role'] == 60 || $row['role'] == 40))
          ) { 
            if ($row['role'] < 41 && $row['role'] > 29) { $host_role = ' <span style="color:red;">Manager</span>'; }
            if ($row['role'] < 61 && $row['role'] > 49) { $host_role = ' <span style="color:red;">Administrator</span>'; }
            if ($row['role'] < 81 && $row['role'] > 69) { $host_role = ' <span style="color:red;">Executive</span>'; }
            if ($row['role'] == 99) { $host_role = ' <span style="color:red;">President</span>'; }
    ?>
        <div class="tooltip"><span class="tooltiptext"><?= $row['username'] . '\'s:' . $host_role; ?></span><p class="adgrp" data-role="<?= $pc; ?>_mtggn"><?= $row['group_name'] ?></p></div>

    <?php } else { ?>
        <p data-role="<?= $pc; ?>_mtggn"><?= $row['group_name'] ?></p>
    <?php } ?>
    </div><!-- .glance-group -->
    <div class="glance-mtg glance-mtg-type">
  



<?php /* refactored via chatGPT */
function renderTooltip($type, $iconClass) {
    echo "<div class=\"tooltip\">\n";
    echo "  <span class=\"tooltiptext type\">$type</span><i class=\"$iconClass\"></i>\n";
    echo "</div>\n";
}

function getMeetingType($row) {
    if ($row['code_o'] != 0) return 'Open meeting';
    if ($row['code_w'] != 0) return "Women's meeting";
    if ($row['code_m'] != 0) return "Men's meeting";
    return 'Join us';
}

function shouldDisplay($row, $layout_context) {
    $isSpecialRole = in_array($row['role'], [99, 80, 60, 40]);

    return (
        (!is_admin() || (is_admin() && !in_admin_mode())) ||
        ($isSpecialRole && !is_president() && !is_owner($row)) ||
        (declare_manager() && !is_owner($row))
    ) && $layout_context !== 'dashboard';
}

function shouldAllowAdminActions($row, $layout_context) {
    $isSpecialRole = !in_array($row['role'], [99, 80, 60, 40]);

    return (
        (is_president() && in_admin_mode()) ||
        (is_admin() && in_admin_mode() && !declare_manager() && $isSpecialRole) ||
        (is_admin() && is_owner($row) && in_admin_mode()) ||
        (is_owner($row) && !is_suspended())
    );
}

function renderAdminActions($row, $layout_context) {
    if (is_executive() && in_array($layout_context, ['home', 'um-alt'])) {
        if (is_owner($row)) {
            echo "<a class=\"manage-edit my-stuff\"><div class=\"tooltip\"><span class=\"tooltiptext\">My Meeting</span><i class=\"far fas fa-user-cog\"></i></div></a>\n";
        } else {
            echo "<a class=\"manage-edit\" href=\"user_role.php?id=" . h(u($row['id_mtg'])) . "&user=" . h(u($row['id_user'])) . "\"><div class=\"tooltip\"><span class=\"tooltiptext\">Manage User</span><i class=\"far fas fa-user-cog\"></i></div></a>\n";
        }
    }

    echo "<a class=\"manage-edit\" href=\"transfer-meeting.php?id=" . h(u($row['id_mtg'])) . "\"><div class=\"tooltip\"><span class=\"tooltiptext\">Transfer Meeting</span><i class=\"far fas fa-people-arrows\"></i></div></a>\n";

    if ($layout_context !== 'delete-mtg') {
        echo "<a class=\"manage-delete\" href=\"manage_delete.php?id=" . h(u($row['id_mtg'])) . "\"><div class=\"tooltip right\"><span class=\"tooltiptext\">Delete Meeting</span><i class=\"far fas fa-minus-circle\"></i></div></a>\n";
    }
}

  if (shouldDisplay($row, $layout_context)) {
      if (!empty($row['meet_url'])) {
          renderTooltip('Zoom Meeting', 'fas far fa-video fa-fw');
      }

      if (!empty($row['meet_addr'])) {
          renderTooltip('In-Person Meeting', 'fas far fa-map-marker-alt fa-fw');
      }

      echo "<div class=\"ctr-type\">" . getMeetingType($row) . "</div>\n";
  }


  if (shouldAllowAdminActions($row, $layout_context)) {
      renderAdminActions($row, $layout_context);
  } 

/* end refactoring */



    if  (is_owner($row) || 
        is_president() && in_admin_mode() || 
        is_manager() && in_admin_mode() && ($row['role'] != 99 && $row['role'] != 80 && $row['role'] != 60 && $row['role'] != 40)
        ) { 

      ?><a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip right"><span class="tooltiptext">Edit Meeting</span><i class="far fa-edit"></i></div></a><?php

      } ?>

    </div><!-- .glance-mtg-type -->
  </div><!-- .daily-glance -->
</div>