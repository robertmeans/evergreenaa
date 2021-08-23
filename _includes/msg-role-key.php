<?php if (!isset($_SESSION['admin'])) { // Visitor to home.php ?>
<div id="role-key">
	<div class="msg-bkg">
		<div class="inside-msg-one">
			<i class="far fa-times-circle"></i>
			<h1>Visitor</h1>

			<p>Thanks for visiting! If a single person finds a single meeting on this site that starts them towards a better life, the effort to prepare it will have been worthwhile.</p>

		</div><!-- .inside-msg-one -->
	</div><!-- .msg-bkg -->
</div><!-- #msg-two -->
<?php } else if ($_SESSION['admin'] == 1) { // Bob mode ?>
<div id="role-key">
	<div class="msg-bkg">
		<div class="inside-msg-one">
			<i class="far fa-times-circle"></i>
			<h1>Top dog</h1>

			<p>You can do anything you want here while in Admin Mode including:</p>
			<ul>
				<li>Assign or revoke Top Tier Admin privileges</li>
				<li>Suspend or unsuspend anyone</li>
				<li>See other's private meetings + edit, transfer or delete them</li>
				<li>Edit, Transfer or Delete any meeting anywhere</li>
				<li>See username + email address of meeting host when viewing a meeting on the homepage</li>
				<li>Access Email Everyone page in order to BCC all members. *Note: At the moment it works best to just copy addresses to clipboard and use your own email client ( <em>use BCC!</em> ). Going through website is at the mercy of GoDaddy servers and they're unpredictible.</li>
			</ul>

		</div><!-- .inside-msg-one -->
	</div><!-- .msg-bkg -->
</div><!-- #msg-two -->
<?php } else if ($_SESSION['admin'] == 3) { // Top Tier Admin ?>	
<div id="role-key">
	<div class="msg-bkg">
		<div class="inside-msg-one">
			<i class="far fa-times-circle"></i>
			<h1>Admin Top Tier privileges</h1>
			<p>While in Admin Mode you can:</p>
			<ul>
				<li>Edit any meeting (including Tier II Admin)</li>
				<li>Transfer any meeting (including Tier II Admin)</li>
				<li>Delete any meeting (including Tier II Admin)</li>
				<li>Assign or revoke Admin II privileges</li>
				<li>Suspend or unsuspend users</li>
				<li>See username + email address of meeting host when viewing a meeting on the homepage</li>
			</ul>

		</div><!-- .inside-msg-one -->
	</div><!-- .msg-bkg -->
</div><!-- #msg-two -->
<?php } else if ($_SESSION['admin'] == 2) { // Tier II Admin ?>
<div id="role-key">
	<div class="msg-bkg">
		<div class="inside-msg-one">
			<i class="far fa-times-circle"></i>
			<h1>Admin Tier II privileges</h1>
			<p>While in Admin Mode you can:</p>
			<ul>
				<li>Edit any meeting (except other Admins) - You can change other meetings to Draft or Private thereby effectively removing them from view but you cannot delete any meetings other than your own.</li>
				<li>Transfer any meeting (except other Admins)</li>
				<li>See username + email address of meeting host when viewing a meeting on the homepage</li>
			</ul>

		</div><!-- .inside-msg-one -->
	</div><!-- .msg-bkg -->
</div><!-- #msg-two -->
<?php } else { //                                 Member ?>		
<div id="role-key">
	<div class="msg-bkg">
		<div class="inside-msg-one">
			<i class="far fa-times-circle"></i>
			<h1>Member privileges</h1>
			<ul>
				<li>Add meetings</li>
				<li>Edit your meetings</li>
				<li>Transfer your meetings</li>
				<li>Delete your meetings</li>
			</ul>

		</div><!-- .inside-msg-one -->
	</div><!-- .msg-bkg -->
</div><!-- #msg-two -->
<?php } ?>
