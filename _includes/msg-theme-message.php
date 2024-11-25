<div id="theme-options">
	<div class="msg-bkg">
		<div class="inside-msg-one">

      <?php if (isset($_SESSION['username'])) { 
        $greeting = ' ' . $_SESSION['username']; 
      } else { $greeting = ''; } ?>

			<i class="far fa-times-circle"></i>
			<h1><i class="far fas fa-lightbulb"></i>&nbsp; Light this sucker up!</h1>

			<p>Hey<?= $greeting ?>, did you know there's a "Bright Theme" option? Just in case the long days of winter leave you wanting to chipper up this joint - open the Menu and you'll find it at the top.</p>

      <form action="process-theme.php" method="post">
        <input type="hidden" name="theme" value="1">
        <input type="hidden" id="themepopupurl" name="themeurl">
        <a class="theme-popup-btn" onclick="$(this).closest('form').submit(); closeNav();">click here to try it now</a>
      </form>

      <?php /* <p class="poprt">This message should only appear once.</p> */ ?>
		</div><!-- .inside-msg-one -->
	</div><!-- .msg-bkg -->
</div><!-- #msg-two -->