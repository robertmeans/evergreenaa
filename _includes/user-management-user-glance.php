	<div class="manage-glance-wrap u-m">
		<div class="manage-glance-user">
			<div class="manage-user-left">
			<?php 
      if (is_owner($row) && declare_executive()) { 
					echo 'You, of course &bullet; Site Executive';
			 } else if (is_owner($row) && declare_admin()) { 
					echo 'You, of course &bullet; Site Administrator';
			 } else if ($row['admin'] == 1) { 
					echo $row['username'] . ' &bullet; ' . strtolower($row['email']) . ' &bullet; Website Guy';
			 } else if ($row['admin'] == 2) {  
					echo $row['username'] . ' &bullet; ' . strtolower($row['email']) . ' &bullet; Tier II Admin';
			 } else if ($row['admin'] == 3) { 
					echo $row['username'] . ' &bullet; ' . strtolower($row['email']) . ' &bullet; Top Tier Admin';
			 } else { 
					echo $row['username'] . ' &bullet; ' . strtolower($row['email']) . ' ';
			 } ?>
			</div>
			<div class="manage-user-right">

			<?php if (is_owner($row)) { ?>
				<a class="manage-edit my-stuff"><div class="tooltip right"><span class="tooltiptext">Don't play with yourself</span><i class="far fas fa-user-cog"></i></div></a>
			<?php } else if ($_SESSION['admin'] != 1 && ($row['admin'] == 1 || $row['admin'] == 3)) { ?>	
				<a class="manage-edit my-stuff"><div class="tooltip right"><span class="tooltiptext">Top Tier Admin are off limits</span><i class="far fas fa-user-cog"></i></div></a>
			<?php } else { ?>
				<a class="manage-edit" href="user_role.php?user=<?= $row['id_user'] ?>"><div class="tooltip right"><span class="tooltiptext"><?php if ($row['admin'] == 3) { ?>Demote Admin<?php } else if ($row['admin'] == 2) { ?>Change role<?php } else { ?>Reinstate User<?php } ?></span><i class="far fas fa-user-cog"></i></div></a>
			<?php } ?>

			</div>
		</div>
	</div>
