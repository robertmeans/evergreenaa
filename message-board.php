<?php 
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

$layout_context = 'message-board';

if (isset($_SESSION['id'])) {
	$user_id = $_SESSION['id'];
	$user_role = $_SESSION['admin'];
}

require '_includes/head.php'; ?>

<body>
<?php if (WWW_ROOT != 'http://localhost/evergreenaa') { ?>
<div class="preload">
	<p>One question at a time.</p>
	<i class="far fa-smile"></i>
</div>
<?php } ?>

<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-set-timezone.php'; ?>
<?php require '_includes/msg-why-join.php'; ?>
<?php require '_includes/msg-mb-notes.php'; ?>
<?php require '_includes/msg-extras.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<img class="background-image" src="_images/message-board-mobile.jpg" alt="AA Logo">
<div id="wrap">

<div id="mb-wrap">
	<h1>All Posts</h1>
	<div class="new-topic">

		<?php if (isset($_SESSION['id'])) { ?>
			<a data-role="mb">Start a new topic</a> <a id="toggle-mb-notes" class="pnd">Privacy &amp; Decorum</a>
		<?php } else { ?>
			<a id="toggle-gottajoin">Start a new topic</a> <a id="toggle-mb-notes" class="pnd">Privacy &amp; Decorum</a>
		<?php } ?>

	</div>

<ul id="post-topics"><?php /* magic */ ?></ul>

</div><!-- #mb-wrap -->
</div><!-- #wrap -->

<script>
$(document).ready(function() {
  $('#post-topics').load('load-message-board.php');
  	setInterval(function() {
    	$('#post-topics').load('load-message-board.php');
  	}, 3555000);  	
});
</script>

<?php require '_includes/footer.php'; ?>
