<?php if ($layout_context == "dashboard" && ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3)) { ?>
 	<p class="logout">
	 	<a href="<?= WWW_ROOT ?>">Home</a>
	 	<?php if ($_SESSION['mode'] == 1) { ?>
	 	 | <a href="<?= WWW_ROOT . '/user_management.php' ?>">User Management</a>
	 	<?php } ?>
 	</p>
 <?php } ?>
 
 <?php if ($layout_context == "dashboard" && ($_SESSION['admin'] == 0 || $_SESSION['admin'] == 2)) { ?>
 	<p class="logout">
	 	<a href="<?= WWW_ROOT ?>">Home</a>
 	</p>
 <?php } ?>

 <?php if ($layout_context == "um") { ?>
 	<p class="logout">
	 	<a href="<?= WWW_ROOT ?>">Home</a> | 
	 	<a href="<?= WWW_ROOT . '/manage.php' ?>">Dashboard</a>
	</p>
 <?php } ?>

 <?php if ($layout_context == "alt-manage" && ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3)) { ?>
 	<p class="logout">
	 	<a href="<?= WWW_ROOT ?>">Home</a> | 
	 	<a href="<?= WWW_ROOT . '/manage.php' ?>">Dashboard</a>
	 	<?php if ($_SESSION['mode'] == 1) { ?>
	 	 | <a href="<?= WWW_ROOT . '/user_management.php' ?>">User Management</a>
	 	<?php } ?>
	</p>
 <?php } ?>
 <?php  if ($layout_context == "alt-manage" && ($_SESSION['admin'] != 1 && $_SESSION['admin'] != 3)){ ?>
 	<p class="logout">
	 	<a href="<?= WWW_ROOT ?>">Home</a> | 
	 	<a href="<?= WWW_ROOT . '/manage.php' ?>">Dashboard</a>
	</p>
 <?php } ?>
