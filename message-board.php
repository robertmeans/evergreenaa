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
	<p>One day at a time.</p>
</div>
<?php } ?>	

<?php require '_includes/nav.php'; ?>
<?php require '_includes/msg-extras.php'; ?>
<?php require '_includes/msg-role-key.php'; ?>
<img class="background-image" src="_images/message-board-mobile.jpg" alt="AA Logo">
<div id="wrap">

<?php 
if (is_post_request()) { // this is SINGLE TOPIC + REPLY PAGE 

	$post = $_POST['post-id'];
	$get_post = get_this_post($post);
	$row = mysqli_fetch_assoc($get_post);

?>
<div id="mb-wrap">
	<h1 class="topic-h"><?= $row['mb_header'] ?></h1>
	<div class="new-topic">
		<a href="message-board.php" class="bkpg"><i class="fas fa-backward"></i> Back</a>
	</div>
	<div class="post-content">
		<p class="mb-date"><?= date('g:m A D, M d, \'y', strtotime($row['opened'])) ?> | <?= substr($row['username'], 0, 1) . '... ' ?> Posted:</p>
		<p class="mb-body"><?= nl2br($row['mb_body']) ?></p>


	</div>

	<div class="replies">
		<ul id="replies">		
<?php 
	$get_replies = get_mb_replies($post);
	$results = mysqli_num_rows($get_replies);
	$results = mysqli_fetch_all($get_replies, MYSQLI_ASSOC);
	if ($results > 0) { 
		foreach ($results as $row) {
		// while ($row = mysqli_fetch_assoc($get_replies)) { ?>
			<li>
				<p class="date"><p class="mb-date"><?= date('g:m A D, M d, \'y', strtotime($row['replied'])) ?> | <?= substr($row['username'], 0, 1) . '... ' ?> Replied:</p>
				<p class="mb-body"><?= nl2br($row['reply']) ?></p>
			</li>
		<?php } // end while loop ?>
	<?php } else { ?>
			<li>
				<p class="mb-body">No replies yet.</p>
			</li>
	<?php } ?>
		</ul>
	</div>


		<div class="mb-reply">
			<a id="mb-reply" class="gtp res">Post a reply</a>
		</div>

		<div id="reply-spot">
			<form id="post-reply" action="" method="post">
				<textarea name="mb-reply" class="mb-reply" placeholder="Enter your reply here."></textarea>
				<input type="hidden" name="post-id" value="<?= $row['id_topic'] ?>">
				<a id="reply">Post reply</a>
			</form>
		</div>



</div><!-- #mb-wrap -->
<?php /* ......................... End REPLY PAGE ......................... */ ?>




<?php } else { // ................. not post request - show them TOPICS PAGE ?>
<div id="mb-wrap">
	<h1>Message Board Posts</h1>
	<div class="new-topic">
		<?php if (isset($_SESSION['id'])) { ?>
			<a data-role="mb">Start a new topic</a>
		<?php } else { ?>
			<a id="toggle-gottajoin">Start a new topic</a>
		<?php } ?>
	</div>
	

<?php 
	$mb_posts = get_mb_posts(); 
	$results = mysqli_num_rows($mb_posts);
	if ($results > 0) { ?>

		<ul id="post-topics">
			<?php 
			$i = 1;
			while ($row = mysqli_fetch_assoc($mb_posts)) { ?>
				<li>
					<p class="mb-date"><?= date('g:m A D, M d, \'y', strtotime($row['opened'])) ?> | <?= substr($row['username'], 0, 1) . '... ' ?> Posted:</p>
					<p class="title"><?= $row['mb_header'] ?></p>


					<?php 
						$firstLine = preg_split('~<br */?>|\R~i', $row['mb_body'], -1, PREG_SPLIT_NO_EMPTY)[0]; 
						if (strlen($firstLine) > 80) { ?>
						<p class="mb-body"><?= nl2br(substr($firstLine, 0, 80)) . '...' ?></p>
					<?php } else { ?>
						<p class="mb-body"><?= nl2br($firstLine) ?></p>
					<?php } ?>


					<form id="<?= $i ?>" class="mbform" action="" method="post">
						<input type="hidden" name="post-id" value="<?= $row['id_topic'] ?>">
						<a data-id="<?= $i ?>" data-role="go-to-post" class="gtp">View | Respond</a>
					</form>
				</li>
			<?php $i++; } // end while loop ?>
		</ul>

	<?php } else { // no message board posts to display ?>
		<p>There are no Posts to display</p>
	<?php } ?>

</div><!-- #mb-wrap -->

<?php } ?>
</div><!-- #wrap -->

<?php require '_includes/footer.php'; ?>
