<nav>
	<ul>
		<!-- 1st link -->
		<?php
		switch ($layout_context) {
			case 'signup' 					:	break;
			case 'reset-password' 	:	break;
			case 'password-message' :	break;
			case 'login-page' 			:	break;
			case 'index' 						:	break;
			case 'forgot-password' 	:	break;
			case 'edit-meeting' 		:	break;
			case 'home-private' 		:	?><li><a id="toggle-private-msg" class="cc-x">Extras</a></li><?php  				break;
			case 'home-public' 			:	?><li><a id="toggle-public-msg" class="cc-x why-join">Readme</a></li><?php 	break;
			case 'email-everyone' 	:	?><li><a class="logout" href="<?= WWW_ROOT ?>">Home</a></li><?php 					break;
			case 'co-host' 			:	?><li><a class="logout" href="<?= WWW_ROOT ?>">Home</a></li><?php 					break;
			case 'manage-edit' 			:	?><li><a class="logout" href="<?= WWW_ROOT ?>">Home</a></li><?php 					break;
			case 'manage-edit-rev' 	:	?><li><a class="logout" href="<?= WWW_ROOT ?>">Home</a></li><?php 					break;
			case 'manage-delete' 		:	?><li><a class="logout" href="<?= WWW_ROOT ?>">Home</a></li><?php 					break;
			default 								:	break;
		}
		?>
		
		
		<!-- 2nd link... -->
		<?php
		switch ($layout_context) {
			case 'signup' 					:	?><li><a class="logout" href="<?= WWW_ROOT ?>">Home</a></li><?php 	break;
			case 'reset-password' 	:	?><li><a class="logout" href="<?= WWW_ROOT ?>">Home</a></li><?php 	break;
			case 'password-message' :	?><li><a class="logout" href="<?= WWW_ROOT ?>">Home</a></li><?php 	break;
			case 'login-page' 			:	?><li><a class="logout" href="<?= WWW_ROOT ?>">Home</a></li><?php 	break;
			case 'index' 						:	?><li><a class="logout" href="<?= WWW_ROOT ?>">Home</a></li><?php 	break;
			case 'home-private' 		:	?><li><a class="logout" href="manage.php">Manage</a></li><?php 			break;
			case 'home-public' 			:	?><li><a class="logout" href="login.php">Login</a></li><?php 				break;
			case 'forgot-password' 	:	?><li><a class="logout" href="<?= WWW_ROOT ?>">Home</a></li><?php 	break;
			case 'manage' 					:	?><li><a class="logout" href="<?= WWW_ROOT ?>">Home</a></li><?php 	break;
			case 'manage-new' 			:	?><li><a class="logout" href="<?= WWW_ROOT ?>">Home</a></li><?php 	break;
			case 'email-everyone' 	:	?><li><a class="logout" href="manage.php">Manage</a></li><?php 			break;
			case 'co-host' 			:	?><li><a class="logout" href="manage.php">Manage</a></li><?php 			break;
			case 'manage-edit' 			:	?><li><a class="logout" href="manage.php">Manage</a></li><?php 			break;
			case 'manage-edit-rev' 	:	?><li><a class="logout" href="manage.php">Manage</a></li><?php 			break;
			case 'manage-delete' 		:	?><li><a class="logout" href="manage.php">Manage</a></li><?php 			break;
			default 								:	?><li><a class="logout" href="<?= WWW_ROOT ?>">Home</a></li><?php 	break;
		}
		?>
		
	</ul>
</nav>