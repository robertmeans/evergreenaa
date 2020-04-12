<div id="private-msg-one">
	<div class="inside-message-one">
		<i class="far fa-times-circle"></i>
		<?php /*<p>Hello <?= $_SESSION['username']; ?>,</p>*/?>
		<p>Hello<?php if (isset($_SESSION['username'])) { echo ' ' . $_SESSION['username'] . ','; } else { echo ','; } ?></p>
		<!-- <p>If you like what you see and/or have ideas for the site please let me know. While I am not soliciting donations I am not refusing them either.</p> -->
		<p>Thank you for setting up an account. At the moment there is not much difference between inside and outside your account. This will change soon. </p>
		<p>If something needs attention on this site please email at the bottom of this page. Whatever you do, don't play <a id="bingo" class="bingo" href="bingo.php" target="_blank">this game</a> during a meeting. </p>

		<p class="info-links"> 
			<a id="preamble" class="extras" href="https://www.aa.org/assets/en_US/smf-92_en.pdf" target="_blank">AA Preamble</a> | 
			<a id="twelvesteps" class="extras" href="https://www.aa.org/assets/en_US/smf-121_en.pdf" target="_blank">12 Steps</a> | 
			<a id="traditions" class="extras" href="https://www.aa.org/assets/en_US/smf-122_en.pdf" target="_blank">12 Traditions</a> | 
			<a id="topics" class="extras" href="_images/Meeting-Starters.pdf" target="_blank">101 Meeting Starters</a>
		</p>
		<a id="daccaa" class="daccaa" href="http://www.daccaa.org" target="_blank">DACCAA Website</a>
	</div>
</div><!-- #msg-one -->