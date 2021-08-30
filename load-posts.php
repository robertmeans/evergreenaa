<?php 
require_once 'config/initialize.php';

	$post = $_GET['post-id'];
	// $post = '84';
	$get_replies = get_mb_replies($post);
	$results = mysqli_num_rows($get_replies);
	// $results = mysqli_fetch_all($get_replies, MYSQLI_ASSOC);

	if ($results > 0) { 
		// echo 'I\'m here!';
		// echo '<pre>' . print_r($results) . '</pre>';
		$i = 1;
		// foreach ($results as $row) {
		while ($row = mysqli_fetch_assoc($get_replies)) { ?>
			<li id="li_<?= $i ?>">
				<p class="date"><p class="mp-date"><?= date('g:i A D, M d, \'y', strtotime($row['replied'])) ?> | <?= substr($row['username'], 0, 1) . '... ' ?> Replied:</p>
				<p class="mb-body"><?= nl2br($row['reply']) ?></p>


    <?php if (isset($_SESSION['id']) && $_SESSION['id'] == $row['id_user'] || ($_SESSION['mode'] == 1 && ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3))) { ?>

      <form id="dr_<?= $i ?>" class="delete-reply">
        <input type="hidden" name="id-reply" value="<?= $row['id_reply'] ?>">
        <input type="hidden" name="uid" value="<?= $row['id_user'] ?>">
        <a data-id="dr_<?= $i ?>" data-role="delete-reply" class="manage-delete-mb"><div class="tooltip right"><span class="tooltiptext">Delete</span><i class="far fas fa-minus-circle"></i></div></a>
      </form>

    <?php } ?>
			</li>
		<?php $i++; } mysqli_free_result($get_replies); // end while loop ?>
	<?php } else { ?>
			<li>
				<p class="nry">No replies yet.</p>
			</li>
	<?php } ?>
