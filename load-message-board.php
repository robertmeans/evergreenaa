<?php 
require_once 'config/initialize.php';

$mb_posts = get_mb_posts(); 
$results = mysqli_num_rows($mb_posts);

$i = 1;
while ($row = mysqli_fetch_assoc($mb_posts)) { ?>
<?php  
	$get_replies = get_mb_replies($row['id_topic']);
	$results = mysqli_num_rows($get_replies);
?>


	<li id="li_<?= $i ?>">
		<p class="mb-date"><?= date('g:i A D, M d, \'y', strtotime($row['opened'])) ?> | <?= substr($row['username'], 0, 1) . '... ' ?> Posted:</p>
		<p class="title"><?= $row['mb_header'] ?> | <span class="num-replies"><?= $results ?> replies</span></p>

		<?php 
			$firstLine = preg_split('~<br */?>|\R~i', $row['mb_body'], -1, PREG_SPLIT_NO_EMPTY)[0]; 
			if (strlen($firstLine) > 80 || substr_count($row['mb_body'], "\n") > 0) { ?>
			<p class="mb-body"><?= nl2br(substr($firstLine, 0, 80)) . '...' ?></p>
		<?php } else { ?>
			<p class="mb-body"><?= nl2br($firstLine) ?></p>
		<?php } ?>

	<div class="group-mb">
    <form id="<?= $i ?>" class="mbform" action="post.php?post-id=<?= $row['id_topic'] ?>" method="get">
      <input id="pid_<?= $i ?>" type="hidden" name="post-id" value="<?= $row['id_topic'] ?>">
      <a data-id="<?= $i ?>" data-role="go-to-post" class="gtp">VIEW + RESPOND</a>
    </form>

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

	</li>
<?php $i++; } // end while loop ?>
