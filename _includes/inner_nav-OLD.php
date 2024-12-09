<?php if ($layout_context == "dashboard" && is_executive()) { ?>
 	<p class="logout">
	 	<a href="<?= WWW_ROOT ?>">Home</a>

	 	<a href="<?= WWW_ROOT . '/user_management.php' ?>">User Management</a>

    <?php if (isset($analytics_on_off) && is_admin()) { ?>
      <a class="<?php if (isset($_SESSION['alertb']) && $_SESSION['alertb'] !== '0') { ?>new-action<?php } ?>" href="<?= WWW_ROOT . '/internal_analytics.php' ?>">Analytics</a>
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
	 	<a href="<?= WWW_ROOT ?>">Home</a>
	 	<a href="<?= WWW_ROOT . '/manage.php' ?>">Dashboard</a>

    <?php if (isset($analytics_on_off) && is_admin()) { ?>
      <a class="<?php if (isset($_SESSION['alertb']) && $_SESSION['alertb'] !== '0') { ?>new-action<?php } ?>" href="<?= WWW_ROOT . '/internal_analytics.php' ?>">Analytics</a>
    <?php } ?>

	</p>
 <?php } ?>




 <?php if (($layout_context == "alt-manage" || $layout_context == "analytics" || $layout_context == "um-alt") && ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3)) { ?>
 	<p class="logout">
	 	<a href="<?= WWW_ROOT ?>">Home</a>
	 	<a href="<?= WWW_ROOT . '/manage.php' ?>">Dashboard</a>
	 	<?php if ($_SESSION['mode'] == 1) { ?>
	 	<a href="<?= WWW_ROOT . '/user_management.php' ?>">User Management</a>
	 	<?php } ?>
    <?php if (isset($analytics_on_off) &&  $_SESSION['id'] == '1' && basename($_SERVER['PHP_SELF']) !== 'internal_analytics.php') { ?>
      <a class="<?php if (isset($_SESSION['alertb']) && $_SESSION['alertb'] !== '0') { ?>new-action<?php } ?>" href="<?= WWW_ROOT . '/internal_analytics.php' ?>">Analytics</a>
    <?php } ?>  
	</p>
 <?php } ?>



 <?php  if (($layout_context == "alt-manage" || $layout_context == "analytics") && ($_SESSION['admin'] != 1 && $_SESSION['admin'] != 3)){ ?>
 	<p class="logout">
	 	<a href="<?= WWW_ROOT ?>">Home</a>
	 	<a href="<?= WWW_ROOT . '/manage.php' ?>">Dashboard</a>
	</p>
 <?php } ?>
