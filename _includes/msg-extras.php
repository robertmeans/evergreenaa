<div id="msg-one">
	<div class="msg-bkg">
		<div class="inside-msg-one">
			<i class="far fa-times-circle"></i>
			<?php /*<p>Hello <?= $_SESSION['username']; ?>,</p>*/?>
			<p>Hello<?php if (isset($_SESSION['username'])) { echo ' ' . h($_SESSION['username']) . ','; } else { echo ','; } ?></p>

			<p>Thank you for joining. If you host an online AA meeting you can post it here (go to Dashboard) or you can use this site as your own private meeting organizer.</p>
			<p>If something needs attention here please email at the bottom of any page.</p>

			<p class="info-links"> 
				<a id="preamble" class="extras" href="https://www.aa.org/assets/en_US/smf-92_en.pdf" target="_blank">AA Preamble</a>

				<a id="twelvesteps" class="extras" href="https://www.aa.org/assets/en_US/smf-121_en.pdf" target="_blank">12 Steps</a>

				<a id="traditions" class="extras" href="https://www.aa.org/assets/en_US/smf-122_en.pdf" target="_blank">12 Traditions</a>

				<a id="topics" class="extras" href="_images/Meeting-Starters.pdf" target="_blank">101 Meeting Starters</a>
			</p>
			<!-- <p class="daccaa-ctr"><a id="daccaa" class="daccaa" href="http://www.daccaa.org" target="_blank">DACCAA Website</a></p> -->
		</div><!-- .inside-msg-one -->
	</div><!-- .msg-bkg -->
</div><!-- #msg-one -->