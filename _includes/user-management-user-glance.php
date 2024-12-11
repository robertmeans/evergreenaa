	<div class="manage-glance-wrap u-m">
		<div class="manage-glance-user">
			<div class="manage-user-left">
			<?php 
      if (is_owner($row) && declare_executive()) { 
					echo 'You, of course &bullet; Site Executive';
			 } else if ($row['role'] == 99) { 
					echo $row['username'] . ' &bullet; ' . strtolower($row['email']) . ' &bullet; President';
			 } else if ($row['role'] == 80) {  
					echo $row['username'] . ' &bullet; ' . strtolower($row['email']) . ' &bullet; Executive';
       } else if ($row['role'] == 60) {  
          echo $row['username'] . ' &bullet; ' . strtolower($row['email']) . ' &bullet; Administrator';
       } else if ($row['role'] == 40) {  
          echo $row['username'] . ' &bullet; ' . strtolower($row['email']) . ' &bullet; Manager';
			 } else { 
					echo $row['username'] . ' &bullet; ' . strtolower($row['email']) . ' ';
			 } ?>
			</div>
			<div class="manage-user-right">

			<?php if (is_owner($row)) { ?>
				<a class="manage-edit my-stuff"><div class="tooltip right"><span class="tooltiptext">Can't change own role</span><i class="far fas fa-user-cog"></i></div></a>

      <?php } else if (is_president()) { 
        if ($row['role'] == 80) { ?>  
          <a class="manage-edit" href="user_role.php?user=<?= $row['id_user'] ?>"><div class="tooltip right"><span class="tooltiptext">Demote</span><i class="far fas fa-user-cog"></i></div></a>
        <?php } else if ($row['role'] == 60 || $row['role'] == 40 || $row['role'] == 20) { ?>
          <a class="manage-edit" href="user_role.php?user=<?= $row['id_user'] ?>"><div class="tooltip right"><span class="tooltiptext">Change role</span><i class="far fas fa-user-cog"></i></div></a>
        <?php } else { ?>
          <a class="manage-edit" href="user_role.php?user=<?= $row['id_user'] ?>"><div class="tooltip right"><span class="tooltiptext">Reinstate</span><i class="far fas fa-user-cog"></i></div></a>
        <?php } ?>

			<?php } else { 	

        if ($row['role'] == 80) { ?>  
          <a class="manage-edit my-stuff"><div class="tooltip right"><span class="tooltiptext">Executives are off limits</span><i class="far fas fa-user-cog"></i></div></a>
        <?php } else if ($row['role'] == 60) { ?>
          <a class="manage-edit" href="user_role.php?user=<?= $row['id_user'] ?>"><div class="tooltip right"><span class="tooltiptext">Demote</span><i class="far fas fa-user-cog"></i></div></a>
        <?php } else if ($row['role'] == 40 || $row['role'] == 20) { ?>
          <a class="manage-edit" href="user_role.php?user=<?= $row['id_user'] ?>"><div class="tooltip right"><span class="tooltiptext">Change role</span><i class="far fas fa-user-cog"></i></div></a>
        <?php } else { ?>
          <a class="manage-edit" href="user_role.php?user=<?= $row['id_user'] ?>"><div class="tooltip right"><span class="tooltiptext">Reinstate</span><i class="far fas fa-user-cog"></i></div></a>
        <?php } ?>

			<?php } ?>

			</div>
		</div>
	</div>
