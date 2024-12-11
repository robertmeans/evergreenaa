<?php $mtg_days = $row['sun'].$row['mon'].$row['tue'].$row['wed'].$row['thu'].$row['fri'].$row['sat']; ?>

<div class="daily-glance-wrap" data-id="<?= $pc; ?>">
  <input type="hidden" data-role="<?= $pc; ?>_mtg-id" value="<?= $row['id_mtg']; ?>">
  <input type="hidden" data-role="<?= $pc; ?>_hid" value="<?= $row['id_user']; ?>">
  <input type="hidden" data-role="<?= $pc; ?>_mtgdz" value="<?= $mtg_days; ?>">
  <input type="hidden" data-role="<?= $pc; ?>_mtg-day" value="<?= $today; ?>">
  <div class="daily-glance<?php 
    if ($row['visible'] == 1 && (is_president() && !is_owner($row))) { echo ' personal-other'; } 
    if ($row['visible'] == 1 && is_owner($row)) { echo ' personal-odin'; } ?>">
    <div class="glance-mtg glance-mtg-time">
      <p data-role="<?= $pc; ?>_mtgtm"><?= $mt->format('g:i') ?> <span data-ampm='<?= $mt->format('A') ?>'><?= $mt->format('A') ?></span></p>
    </div><!-- .glance-time-day -->
    <div class="glance-mtg glance-group-title">
    <?php 
      if  (
          !is_owner($row) && 
          (is_admin() && in_admin_mode() && ($row['role'] == 99 || $row['role'] == 80 || $row['role'] == 60 || $row['role'] == 40))
          ) { ?>

        <div class="tooltip"><span class="tooltiptext">Meeting belongs to management</span><p class="adgrp" data-role="<?= $pc; ?>_mtggn"><?= $row['group_name'] ?></p></div>

    <?php } else { ?>
        <p data-role="<?= $pc; ?>_mtggn"><?= $row['group_name'] ?></p>
    <?php } ?>
    </div><!-- .glance-group -->
    <div class="glance-mtg glance-mtg-type">
    
<?php if  (
          is_president() && in_admin_mode() || 
          is_admin() && in_admin_mode() && ($row['role'] != 80 && $row['role'] != 60 && $row['role'] != 40)
          ) { 

  if (is_owner($row)) { ?>
    <a class="manage-edit my-stuff"><div class="tooltip"><span class="tooltiptext">My Stuff</span><i class="far fas fa-user-cog"></i></div></a>
  <?php } else { ?>
    <a class="manage-edit" href="user_role.php?id=<?= h(u($row['id_mtg'])) . '&user=' . h(u($row['id_user'])); ?>"><div class="tooltip"><span class="tooltiptext">Manage User</span><i class="far fas fa-user-cog"></i></div></a>
  <?php } ?>

  <a class="manage-edit" href="transfer-meeting.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip"><span class="tooltiptext">Transfer Meeting</span><i class="far fas fa-people-arrows"></i></div></a>

<?php if ($layout_context !== 'alt-delete') { ?>
  <a class="manage-delete" href="manage_delete.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip right"><span class="tooltiptext">Delete Meeting</span><i class="far fas fa-minus-circle"></i></div></a>
<?php } ?>

<?php } 

  if  (
      !is_admin() || 
      is_admin() && !in_admin_mode() || 
        (
          (is_admin() && $row['role'] == 99 || $row['role'] == 80 || $row['role'] == 60 || $row['role'] == 40) && !is_president()
        )
      ) {

    if ($row['meet_url'] != '') { ?>
      <div class="tooltip">
        <span class="tooltiptext type">Zoom Meeting</span><i class="fas far fa-video fa-fw"></i>
      </div> 
    <?php } 

    if ($row['meet_addr'] != '') { ?>
      <div class="tooltip">
        <span class="tooltiptext type">In-Person Meeting</span><i class="fas far fa-map-marker-alt fa-fw"></i>
      </div>
    <?php   } ?>
  
  <div class="ctr-type">
    <?php 
    if ($row['code_o'] != 0) { echo 'Open meeting'; } 
    else if ($row['code_w'] != 0) { echo 'Women\'s meeting'; } 
    else if ($row['code_m'] != 0) { echo 'Men\'s meeting'; } 
    else { echo 'Join us'; }
    ?>
  </div>

<?php } 

    if  (is_owner($row) || 
        is_president() && in_admin_mode() || 
        is_manager() && in_admin_mode() && ($row['role'] != 99 && $row['role'] != 80 && $row['role'] != 60 && $row['role'] != 40)
        ) { 

      ?><a class="manage-edit" href="manage_edit.php?id=<?= h(u($row['id_mtg'])); ?>"><div class="tooltip right"><span class="tooltiptext">Edit Meeting</span><i class="far fa-edit"></i></div></a><?php

      } ?>

    </div><!-- .glance-mtg-type -->
  </div><!-- .daily-glance -->
</div>