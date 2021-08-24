	<div class="manage-glance-wrap u-m">
		<div class="manage-glance-user">
			<div class="manage-user-left">
			<?php if (($row['id_user'] == $_SESSION['id']) && $row['admin'] == 2) { ?>
					You, of course &bullet; Tier II Admin
			<?php } else if (($row['id_user'] == $_SESSION['id']) && $row['admin'] == 3) { ?>
					You, of course &bullet; Top Tier Admin
			<?php } else if ($row['admin'] == 1) { ?>
					<?php // SQL = WHERE u.admin=2 OR u.admin=3 -> that's why this won't show... ?>
					<?= $row['username'] . ' &bullet; ' . strtolower($row['email']) . ' ' ?>&bullet; Website Guy
			<?php } else if ($row['admin'] == 2) { ?>
					<?= $row['username'] . ' &bullet; ' . strtolower($row['email']) . ' ' ?>&bullet; Tier II Admin
			<?php } else if ($row['admin'] == 3) { ?>
					<?= $row['username'] . ' &bullet; ' . strtolower($row['email']) . ' ' ?>&bullet; Top Tier Admin
			<?php } else { ?>
					<?= $row['username'] . ' &bullet; ' . strtolower($row['email']) . ' ' ?>
			<?php }
				?>
			</div>
			<div class="manage-user-right">

			<?php if ($row['id_user'] == $_SESSION['id']) { ?>
				<a class="manage-edit my-stuff"><div class="tooltip right"><span class="tooltiptext">Don't play with yourself</span><i class="far fas fa-user-cog"></i></div></a>
			<?php } else if ($_SESSION['admin'] != 1 && ($row['admin'] == 1 || $row['admin'] == 3)) { ?>	
				<a class="manage-edit my-stuff"><div class="tooltip right"><span class="tooltiptext">Top Tier Admin are off limits</span><i class="far fas fa-user-cog"></i></div></a>
			<?php } else { ?>
				<a class="manage-edit" href="user_role.php?user=<?= $row['id_user'] ?>"><div class="tooltip right"><span class="tooltiptext"><?php if ($row['admin'] == 3) { ?>Demote Admin<?php } else if ($row['admin'] == 2) { ?>Change role<?php } else { ?>Reinstate User<?php } ?></span><i class="far fas fa-user-cog"></i></div></a>
			<?php } ?>

			</div>
		</div>
	</div>
