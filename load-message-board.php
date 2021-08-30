<?php 
require_once 'config/initialize.php';

$mb_posts = get_mb_posts(); 
$results = mysqli_num_rows($mb_posts);

if ($results > 0) { 
$i = 1;
while ($row = mysqli_fetch_assoc($mb_posts)) { ?>
<?php  
	$get_replies = get_mb_replies($row['id_topic']);
	$results = mysqli_num_rows($get_replies);
?>

	<li id="li_<?= $i ?>">

		<div class="mb-individual">
			<a class="mb-date" href="post.php?post-id=<?= $row['id_topic'] ?>"><?= date('g:i A D, M d, \'y', strtotime($row['opened'])) ?> | <?= substr($row['username'], 0, 1) . '... ' ?> Posted:</a>

			<div class="group-mb"><?php /* favicon links */ ?>
		    <form id="<?= $i ?>" class="mbform" action="post.php?post-id=<?= $row['id_topic'] ?>" method="get">
		      <input id="pid_<?= $i ?>" type="hidden" name="post-id" value="<?= $row['id_topic'] ?>">
		      <?php if (isset($_SESSION['id']) && (($_SESSION['id'] == $row['id_user']) || ($_SESSION['mode'] == 1 && ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3))) ) { 
		      	// this is either their post which means they have a delete btn or it's an admin (in admin mode) which means they have a delete btn - either way, there's another icon to the right so don't put the class of 'right' in the tooltip div. ?>
		      	<a data-id="<?= $i ?>" data-role="go-to-post" class="gtp"><div class="tooltip"><span class="tooltiptext">Read &amp; Reply</span><i class="far fa-comments"></i></div></a>

		      <?php } else if (isset($_SESSION['id']) && ($_SESSION['id'] != $row['id_user'])) { // logged in but not theirs so put 'Read & Reply' in tooltip with class of right ?>
		      	<a data-id="<?= $i ?>" data-role="go-to-post" class="gtp"><div class="tooltip right"><span class="tooltiptext">Read &amp; Reply</span><i class="far fa-comments"></i></div></a>

		      <?php } else { // put the class of 'right' in the tooltip div and just show 'Comments' in tooltip ?>
		      	<a data-id="<?= $i ?>" data-role="go-to-post" class="gtp"><div class="tooltip right"><span class="tooltiptext">Comments</span><i class="far fa-comments"></i></div></a>
		      <?php } ?>
		    </form>


				<?php if ($_SESSION['mode'] == 1 && ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3)) { ?>
					<a class="gtp" href="user_role.php?user=<?= h(u($row['id_user'])); ?>"><div class="tooltip"><span class="tooltiptext">Manage User</span><i class="far fas fa-user-cog"></i></div></a>
				<?php } ?>

		    <?php if (isset($_SESSION['id']) && $_SESSION['id'] == $row['id_user'] || ($_SESSION['mode'] == 1 && ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3))) { ?>
		      <form id="df_<?= $i ?>">
		        <input type="hidden" name="post-id" value="<?= $row['id_topic'] ?>">
		        <input type="hidden" name="uid" value="<?= $row['id_user'] ?>">

		    <?php if ($_SESSION['id'] == $row['id_user']) { ?>
		        <a data-id="df_<?= $i ?>" data-role="delete-post" class="manage-delete-mb"><div class="tooltip right"><span class="tooltiptext">Delete your Post</span><i class="far fas fa-minus-circle"></i></div></a>
		    <?php } else { ?>
		    		<a data-id="df_<?= $i ?>" data-role="delete-post" class="manage-delete-mb"><div class="tooltip right"><span class="tooltiptext">Delete their Post</span><i class="far fas fa-minus-circle"></i></div></a>
		    <?php } ?>
		      </form>
		    <?php } ?>
			</div>
		</div>


		<a class="mb-entire" href="post.php?post-id=<?= $row['id_topic'] ?>">
			<p class="title"><?= $row['mb_header'] ?> | <span class="num-replies"><?php if ($results == 0 || $results > 1) { echo $results . ' replies'; } else { echo $results . ' reply'; } ?></span></p>

			<?php 
				$firstLine = preg_split('~<br */?>|\R~i', $row['mb_body'], -1, PREG_SPLIT_NO_EMPTY)[0]; 
				if (strlen($firstLine) > 80 || substr_count($row['mb_body'], "\n") > 0) { ?>
				<p class="mb-body"><?= nl2br(substr($firstLine, 0, 80)) . '...' ?></p>
			<?php } else { ?>
				<p class="mb-body"><?= nl2br($firstLine) ?></p>
			<?php } ?>
		</a>

	</li>
<?php $i++; } // end while loop ?>
	<?php } else { ?>
			<li>
				<p id="npy" class="nry">There are currently no posts.</p>
			</li>
	<?php } ?>
