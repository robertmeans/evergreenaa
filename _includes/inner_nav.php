<p class="logout">

  <a href="<?= WWW_ROOT ?>">Home</a>

  <?php if ($layout_context !== 'dashboard') { ?>
    <a href="<?= WWW_ROOT . '/manage.php' ?>">Dashboard</a>
  <?php } ?>

  <?php if ($layout_context !== 'um' && is_executive()) { ?>
    <a href="<?= WWW_ROOT . '/user_management.php' ?>">User Management</a>
  <?php } ?>

  <?php if ($layout_context !== 'analytics' && is_executive()) { ?>
    <a class="<?php if (isset($_SESSION['alertb']) && $_SESSION['alertb'] !== '0') { ?>new-action<?php } ?>" href="<?= WWW_ROOT . '/internal_analytics.php' ?>">Analytics</a>
  <?php } ?>

</p>