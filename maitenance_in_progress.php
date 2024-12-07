<?php 
require_once 'config/initialize.php';
/* turn this page on & off in initialize.php after constants are called */

if (!isset($mip)) { header('location: ' . WWW_ROOT); exit(); }

$layout_context = "login-page";

include '_includes/head.php'; ?>

<body>
<?php $theme = configure_theme(); mobile_bkg_config($theme); ?>

<div id="landing">
	<div class="uc-page">
		<p>Saturday, October 12 at 7:50 PM Mountain Time</p>
		<p>I'm implementing a super major extra big update at the moment. Come back at 8:30 and I should be done. You won't notice a single difference but trust me, it's next-level phenomonally stupendeous.</p>
    <p>Sorry for any inconvenience.</p>
    <p>Bob</p>
	</div>
</div><!-- #landing -->

</body>
<?php require '_includes/footer.php'; ?>
<?php // exit(); /* can't imagine what I had this here for - ? */ ?>



