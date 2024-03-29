<?php 
require_once 'config/initialize.php';


	if (isset($_GET['post-id'])) {
		$post = $_GET['post-id'];
	} else {
		$post = '0';
	}
	$get_replies = get_mb_replies($post);
	$any_replies = mysqli_num_rows($get_replies);
  $replies = mysqli_fetch_assoc($get_replies);

	if ($any_replies > 0) { 
			/* both topic and reply were returned from this query */
  		mysqli_data_seek($get_replies, 0);
		$i = 1;
		while ($row = mysqli_fetch_assoc($get_replies)) { 

		  $mt = new DateTime($row['replied'], new DateTimeZone('America/Denver'));
		  $mt->setTimezone(new DateTimeZone($tz)); ?>

			<li id="li_<?= $i ?>">
				<?php if (isset($_SESSION['id']) && $_SESSION['id'] == $row['idr_user']) { ?>
				<p class="date"><p class="mp-date"><?= $mt->format("g:i A D, M d, 'y") ?> | You replied:</p>
				<?php } else { ?>
				<p class="date"><p class="mp-date"><?= $mt->format("g:i A D, M d, 'y") ?> | <?= substr($row['username'], 0, 1) . '... ' ?> Replied:</p>
				<?php } ?>


				<?php if (isset($_SESSION['id']) && ($_SESSION['mode'] == 1 && ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3))) { 
				// admin view of username + email - this is for the individual posts NOT the topic (see post.php for that) ?>

				<?php if ($_SESSION['id'] == $row['idr_user']) { ?>
					<p class="admin-mp-info">This is your reply</p>
				<?php } else if ($_SESSION['admin'] != 1 && ($row['admin'] == 1 || $row['admin'] == 3)) { 
					// remember, there's only 1 ($row['admin'] = 1) ?>
					<p class="admin-mp-info">Admin (off limits)</p>

				<?php } else { ?>
					<a class="admin-mp-info gtp" href="user_role.php?user=<?= h(u($row['idr_user'])); ?>"><div class="tooltip"><span class="tooltiptext">Manage User</span><?= $row['username'] . ' &bullet; ' . $row['email'] ?></div></a>
				<?php } ?>


				<?php } ?>

				<p class="mb-body"><?= nl2br($row['reply']) ?></p>

    <?php if ((isset($_SESSION['id'])) && ($_SESSION['id'] == $row['idr_user'] || ($_SESSION['mode'] == 1 && ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3)))) { ?>
    	<?php if ($_SESSION['admin'] == 1 || ($_SESSION['id'] == $row['idr_user']) || ($_SESSION['admin'] == 3 && $row['admin'] != 1)) { // remember, there's only 1 admin=1 ?>
	      <form id="dr_<?= $i ?>" class="delete-reply">
	        <input type="hidden" name="id-reply" value="<?= $row['id_reply'] ?>">
	        <input type="hidden" name="uid" value="<?= $row['idr_user'] ?>">
	        <a data-id="dr_<?= $i ?>" data-role="delete-reply" class="manage-delete-mb"><div class="tooltip right"><span class="tooltiptext">Delete</span><i class="far fas fa-minus-circle"></i></div></a>
	      </form>
    	<?php } ?>
    <?php } ?>
			</li>

		<?php $i++; } // end while  ?>

		<?php } else { ?>
			<?php /* there's a topic but no replies */ ?>
			<?php mysqli_data_seek($get_replies, 0); ?>
			<li>
				<p class="nry">No replies yet.</p>
			</li>


		<?php } ?>
