<?php
if (!isset($_SESSION['mode'])) {
  $_SESSION['mode'] = 'not-set';
}
?>
<nav id="navigation" class="sm-g">
	<div class="top-nav <?php if (isset($_SESSION['admin']) && ($_SESSION['mode'] == 1)) { ?>admin-logged<?php } ?>" onclick="openNav();">

		<div class="menu-basket">
			<div class="bar-box">
				<span class="bars"></span>
			</div> 
			<div class="mt">Menu</div>
		</div>

		<?php /* works - just needs an if statement to wrap it...
		<div class="tooltip"><span class="tooltiptext type">New posts</span><i class="fas far fa-regular fa-star"></i></div> 
		*/ ?>

	</div>
</nav>

<nav id="navigation" class="lg-g"><?php // mobile nav ?>
	<div class="top-nav <?php if (isset($_SESSION['admin']) && ($_SESSION['mode'] == 1)) { ?>admin-logged<?php } ?>" onclick="openNav();"><i class="fas fa-bars"></i></div>
</nav>

<div id="side-nav-bkg">

<div id="side-nav" class="sidenav">
	<div id="sidenav-wrapper">
		<a class="closebtn" onclick="closeNav();"><i class="fas far fa-caret-square-down"></i> <div class="ctxt ctd">Close</div></a>

    <div class="theme-nav">
    <?php 
      $theme = configure_theme(); 
      $ctpg = basename($_SERVER['PHP_SELF']); 

      if ($ctpg === 'manage_new.php' || $ctpg === 'manage_edit.php') {

      ?>

    <?php if ($theme == '0') { ?>
      <a class="dark nav-active"><i class="fas far fa-moon"></i></a>

      <a id="bright-opt" class="light<?php if ($theme == '1') { echo ' nav-active'; } ?>"  onclick="themeSpecialSubmitLight(); closeNav();"><i class="fas far fa-lightbulb"></i></a>

      <div id="ct-dark" class="current-theme" style="display:block;"><p>Current:</p><h4>Dark Theme</h4></div>
      <div id="ct-bright" class="current-theme"><p>Change to:</p><h4>Bright Theme</h4></div>

    <?php } else {  ?>

      <a id="dark-opt" class="dark<?php if ($theme == '0') { echo ' nav-active'; } ?>"  onclick="themeSpecialSubmitDark(); closeNav();"><i class="fas far fa-moon"></i></a>

      <a class="light nav-active"><i class="fas far fa-lightbulb"></i></a>

      <div id="ct-dark" class="current-theme"><p>Change to:</p><h4>Dark Theme</h4></div>
      <div id="ct-bright" class="current-theme" style="display:block;"><p>Current:</p><h4>Bright Theme</h4></div>

    <?php } ?>

      <?php } else { ?>

    <?php if ($theme == '0') { ?>
      <a class="dark nav-active"><i class="fas far fa-moon"></i></a>

      <form action="process-theme.php" method="post">
        <input type="hidden" name="theme" value="1">
        <input type="hidden" id="themeurl" name="themeurl">
        <a id="bright-opt" class="light<?php if ($theme == '1') { echo ' nav-active'; } ?>"  onclick="$(this).closest('form').submit(); closeNav();"><i class="fas far fa-lightbulb"></i></a>
      </form>


      <div id="ct-dark" class="current-theme" style="display:flex;"><p>Current:</p><h4>Dark Theme</h4></div>
      <div id="ct-bright" class="current-theme"><p>Change to:</p><h4>Bright Theme</h4></div>

    <?php } else {  ?>
      <form action="process-theme.php" method="post">
        <input type="hidden" name="theme" value="0">
        <input type="hidden" id="themeurl" name="themeurl">
        <a id="dark-opt" class="dark<?php if ($theme == '0') { echo ' nav-active'; } ?>"  onclick="$(this).closest('form').submit(); closeNav();"><i class="fas far fa-moon"></i></a>
      </form>

      <a class="light nav-active"><i class="fas far fa-lightbulb"></i></a>

      <div id="ct-dark" class="current-theme"><p>Change to:</p><h4>Dark Theme</h4></div>
      <div id="ct-bright" class="current-theme" style="display:flex;"><p>Current:</p><h4>Bright Theme</h4></div>

    <?php } ?>


<?php } ?>

    </div>
    <?php 
		// make sure session is cleared if going from login to homepage via nav
		if ($layout_context == 'login-page' || (isset($_SESSION['admin']) && ($_SESSION['admin'] == 85 || $_SESSION['admin'] == 86))) { ?>
			<a href="<?= WWW_ROOT . '/logout.php' ?>" onclick="closeNav();">Homepage</a>
		<?php } else { ?>
			<a href="<?= WWW_ROOT ?>" class="<?php if ($layout_context == 'home-public' || $layout_context == 'home-private') { echo 'nav-active'; } ?>">Homepage</a>
		<?php } ?>

<?php // for DEVELOPMENT
			// it turns the Message Board link on only for me (bob id=1 (r@ewd.com) AND bobby id=2 (louifoot)) so I can see it from 2 accounts
/*
		 if ((isset($_SESSION['id']) && ($_SESSION['id'] == 1 || $_SESSION['id'] == 2 || $_SESSION['id'] == 19) && $layout_context == 'message-board')) { ?>
			<a href="<?= WWW_ROOT . '/message-board.php'; ?>" class="apr nav-active">Message Board</a>

		<?php } else if (isset($_SESSION['id']) && ($_SESSION['id'] == 1 || $_SESSION['id'] == 2 || $_SESSION['id'] == 19)) { ?>
			<a href="<?= WWW_ROOT . '/message-board.php'; ?>" class="apr" onclick="closeNav();"><span class="new-item">New</span><span class="mb-new">Message Board</span></a>
		<?php }
*/
?>

<?php // for PRODUCTION
     /* start 001 comment
     if ($layout_context == 'message-board') { ?>
      <a href="<?= WWW_ROOT . '/message-board.php'; ?>" class="apr nav-active">Message Board</a>
    <?php } else { ?>

      <a href="<?= WWW_ROOT . '/message-board.php'; ?>" class="apr" onclick="closeNav();">Message Board </a>
     
      <?php (end 001 comment)*/ /* start 002 comment; - this works - just needs an if statement to wrap it
      <a href="<?= WWW_ROOT . '/message-board.php'; ?>" class="apr" onclick="closeNav();">Message Board <div class="tooltip"><span class="tooltiptext type">New posts</span><i class="fas far fa-regular fa-star"></i></div></a> 
			(end 002 comment) */ ?>

    <?php /* start 003 comment } (end 003 comment)*/ // end else ?>

		<?php
		if (isset($_SESSION['verified']) && $_SESSION['verified'] != '0' && isset($_SESSION['id']) && $layout_context == 'dashboard') { ?>
			<a href="manage.php" class="<?php if ($layout_context == 'dashboard') { echo 'nav-active'; } ?>">My Dashboard</a>
		<?php } 
		if (isset($_SESSION['verified']) && $_SESSION['verified'] != '0' && isset($_SESSION['id']) && $layout_context != 'dashboard') { ?>
			<a href="manage.php" class="<?php if ($layout_context == 'dashboard') { echo 'nav-active'; } ?>" onclick="closeNav();">My Dashboard</a>
		<?php } 

		if ($layout_context != "login-page") { ?>
			<a id="show-tz">Timezone: <?php 
				if ($tz == 'America/New_York') { echo 'USA Eastern'; }
					elseif ($tz == 'America/Chicago') { echo 'USA Central'; }
					elseif ($tz == 'America/Denver') { echo 'USA Mountain'; }
					elseif ($tz == 'America/Phoenix') { echo 'USA [Phoenix, AZ]'; }
					elseif ($tz == 'America/Los_Angeles') { echo 'USA Pacific'; }
					elseif ($tz == 'America/Anchorage') { echo 'USA Alaska'; }
					elseif ($tz == 'Pacific/Honolulu') { echo 'USA Hawaii'; }
					else echo $tz; 
					 ?></a>
		<?php }


		if ((isset($_SESSION['admin']) && ($_SESSION['mode'] == 1 && ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3))) && $layout_context == 'um') { ?>
			<a href="user_management.php" class="<?php if ($layout_context == 'um') { echo 'nav-active'; } ?>">Manage Users</a>
		<?php } 
		if ((isset($_SESSION['admin']) && ($_SESSION['mode'] == 1 && ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3))) && $layout_context != 'um') { ?>
      <a href="user_management.php" onclick="closeNav();">Manage Users</a>
			<?php /* <a class="<?php if ($layout_context == 'eeveryone') { echo 'nav-active'; } ?>" href="user_management.php" onclick="closeNav();">Manage Users</a> */ ?>
		<?php } 


		// my eyes only 
		if (isset($_SESSION['admin']) && ($_SESSION['mode'] == 1 && $_SESSION['admin'] == 1)) { ?>
			<a href="email_members.php" class="<?php if ($layout_context == 'alt-manage') { echo 'nav-active'; } ?>" onclick="closeNav();">Email Everyone</a>
		<?php } 

		if (isset($_SESSION['admin']) && (($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3) && $_SESSION['mode'] == 0)) { ?>
			<form action="process-admin-mode.php" method="post">
				<input type="hidden" name="mode" value="1">
				<input type="hidden" id="url" name="url">
				<a class="admin-login" onclick="$(this).closest('form').submit(); closeNav();">Enter Admin Mode</a>
			</form>
		<?php } 
		if (isset($_SESSION['admin']) && (($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3) && $_SESSION['mode'] == 1)) { ?>
			<form action="process-admin-mode.php" method="post">
				<input type="hidden" name="mode" value="0">
				<input type="hidden" id="url" name="url">
				<a class="admin-logout" onclick="$(this).closest('form').submit(); closeNav();">Exit Admin Mode</a>	
			</form>

		<?php } 

		if (!isset($_SESSION['id']) && $layout_context != "login-page") { ?>
			<a href="login.php" class="login" onclick="closeNav();"><i class="fas far fa-power-off"></i> Login</span></a>
		<?php } else if ($layout_context != "login-page") { ?>
			<a href="logout.php" class="logout" onclick="closeNav();"><i class="fas far fa-power-off"></i> Logout</a>
		<?php } 

		if (!isset($_SESSION['id']) && ($layout_context != "login-page")) { ?>
			<a href="<?= WWW_ROOT . '/signup.php' ?>" class="cc-x">Create an Account</a>
			<a id="toggle-why-join" class="cc-x eotw">Why Join?</a>
		<?php } else if ($layout_context == "login-page") { ?>
			<a id="toggle-why-join" class="cc-x eotw">Why Join?</a>
		<?php } else { ?>
			<a id="toggle-msg-one" class="cc-x eotw">Extras</a>
		<?php } ?>

	</div><!-- #sidenav-wrapper -->

		<?php
		if (isset($_SESSION['admin']) && $layout_context != 'login-page') {
		 if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3) { ?>
			<div class="admin-role">
				<?php if ($_SESSION['admin'] == 1) { ?>
					The Bob <a id="toggle-role-key"><i class="fas fa-info-circle"></i></a>
				<?php } else if ($_SESSION['admin'] == 2) { ?>
					<?= $_SESSION['username'] . ': '; ?>Tier II Admin <a id="toggle-role-key"><i class="fas fa-info-circle"></i></a>
				<?php } else if ($_SESSION['admin'] == 3) { ?>
					<?= $_SESSION['username'] . ': '; ?>Top Tier Admin <a id="toggle-role-key"><i class="fas fa-info-circle"></i></a>
				<?php } ?>
			</div>
		<?php } else if ($_SESSION['admin'] == 85 || $_SESSION['admin'] == 86) { ?>
			<div class="sus-user">
				<?= $_SESSION['username'] . ': '; ?>Suspended Account
			</div>
		<?php } else { ?>
			<div class="member-role">
				Member: <?= $_SESSION['username'] . ' '; ?> <a id="toggle-role-key"><i class="fas fa-info-circle"></i></a>
			</div>		
			<?php } 
			} else { ?>
			<div class="visitor-role">
				Welcome Visitor <a id="toggle-role-key"><i class="fas fa-info-circle"></i></a>
			</div>
		<?php } ?>
</div><!-- #side-nav -->

</div><!-- #side-nav-bkg -->
