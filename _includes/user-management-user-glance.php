
	<div class="manage-glance-wrap u-m">
		<div class="manage-glance-user">
			<div class="manage-user-left">
				<?= $row['username'] . ' &bullet; ' . $row['email'] ?>
			</div>
			<div class="manage-user-right">
				<a class="manage-edit" href="user_role.php?user=<?= $row['id_user'] ?>"><div class="tooltip right"><span class="tooltiptext"><?php if (isset($ca)) { ?>Demote Admin<?php } else { ?>Reinstate User<?php } ?></span><i class="far fas fa-user-cog"></i></div></a>
			</div>
		</div>
	</div>
