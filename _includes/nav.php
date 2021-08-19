<nav id="navigation" class="sm-g">
	<span class="top-nav <?php if (isset($_SESSION['admin']) && ($_SESSION['mode'] == 1)) { ?>admin-logged<?php } ?>" onclick="openNav();"><i class="fas fa-bars"></i> Menu</span>
</nav>
<nav id="navigation" class="lg-g">
	<span class="top-nav <?php if (isset($_SESSION['admin']) && ($_SESSION['mode'] == 1)) { ?>admin-logged<?php } ?>" onclick="openNav();"><i class="fas fa-bars"></i></span>
</nav>

<div id="side-nav" class="sidenav">
	<div id="sidenav-wrapper">
		<a class="closebtn" onclick="closeNav();"><i class="fas far fa-caret-square-down"></i> <span class="ctxt ctd">Close</span></a>

		<?php if (($layout_context != 'home-private') && ($layout_context != 'home-public')) { ?>
			<a href="<?= WWW_ROOT ?>" onclick="closeNav();">Homepage</a>
		<?php } ?>

		<?php if (isset($_SESSION['admin']) && ($_SESSION['admin'] == 85 || $_SESSION['admin'] == 86)) { ?>
			<a href="<?= WWW_ROOT . '/logout.php' ?>" onclick="closeNav();">Homepage</a>
		<?php } ?>

		<?php if ((isset($_SESSION['id']) && $layout_context != 'dashboard') && (isset($_SESSION['admin']) && ($_SESSION['admin'] != 85 && $_SESSION['admin'] != 86))) { ?>
			<a href="manage.php" onclick="closeNav();">My Dashboard</a>
		<?php } ?>

		<?php if (isset($_SESSION['admin']) && ($_SESSION['mode'] == 1 && ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3))) { ?>
			<a href="user_management.php" onclick="closeNav();">Manage Users</a>
		<?php } ?>

		<?php // my eyes only ?>
		<?php if (isset($_SESSION['admin']) && ($_SESSION['mode'] == 1 && $_SESSION['admin'] == 1)) { ?>
			<a href="email_everyone_BCC.php" onclick="closeNav();">Email Everyone</a>
		<?php } ?>

		<?php if (isset($_SESSION['admin']) && (($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3) && $_SESSION['mode'] == 0)) { ?>
			<form action="process-admin-mode.php" method="post">
				<input type="hidden" name="mode" value="1">
				<input type="hidden" id="url" name="url">
				<a href="#" class="admin-login" onclick="$(this).closest('form').submit(); closeNav();">Enter Admin Mode</a>
			</form>
		<?php } ?>
		<?php if (isset($_SESSION['admin']) && (($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3) && $_SESSION['mode'] == 1)) { ?>
			<form action="process-admin-mode.php" method="post">
				<input type="hidden" name="mode" value="0">
				<input type="hidden" id="url" name="url">
				<a href="#" class="admin-logout" onclick="$(this).closest('form').submit(); closeNav();">Exit Admin Mode</a>	
			</form>

		<?php } ?>

		<?php if (!isset($_SESSION['id'])) { ?>
			<a href="login.php" class="login" onclick="closeNav();"><i class="fas far fa-power-off"></i> Login</span></a>
		<?php } else { ?>
			<a href="logout.php" class="logout" onclick="closeNav();"><i class="fas far fa-power-off"></i> Logout</a>
		<?php } ?>

		<?php if (!isset($_SESSION['id'])) { ?>
			<a href="<?= WWW_ROOT . '/signup.php' ?>" class="cc-x">Create an Account</a>
			<a id="toggle-msg-one" class="cc-x eotw">Why Join?</a>
		<?php } else { ?>
			<a id="toggle-msg-one" class="cc-x eotw">Extras</a>
		<?php } ?>

	</div><!-- #sidenav-wrapper -->

		<?php
		if (isset($_SESSION['admin'])) {
		 if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3) { ?>
			<div class="admin-role">
				Your role: <?php if ($_SESSION['admin'] == 1) { ?>
					One and only Bob
				<?php } else if ($_SESSION['admin'] == 2) { ?>
					Tier II Admin
				<?php } else if ($_SESSION['admin'] == 3) { ?>
					Top Tier Admin
				<?php } ?>
			</div>
		<?php } else if ($_SESSION['admin'] == 85 || $_SESSION['admin'] == 86) { ?>
			<div class="sus-user">
				Suspended Member
			</div>
		<?php } else { ?>
			<div class="member-role">
				User role: Member
			</div>		
			<?php } 
			} else { ?>
			<div class="visitor-role">
				Welcome Visitor
			</div>
		<?php } ?>
</div><!-- #side-nav -->
