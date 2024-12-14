<?php 
$layout_context = 'post-page';
require_once 'config/initialize.php';
// require_once 'config/verify_admin.php';

if (isset($_SESSION['id'])) {
	$user_id = $_SESSION['id'];
	$user_role = $_SESSION['admin'];
  $user_posting = $_SESSION['username'];
} else {
  $user_id = '';
  $user_role = '';
  $user_posting = '';  
}

require '_includes/head.php'; ?>

<body>
<?php preload_config($layout_context); ?>
<?php require '_includes/nav.php'; ?>
<?php require_once '_includes/messages.php'; ?>
<img class="background-image" src="_images/message-board-mobile.jpg" alt="AA Logo">
<div id="wrap">

<?php 

  if (isset($_GET['post-id'])) {
    $post = $_GET['post-id'];
  } else {
    $post = '0';
  }
	$get_post = get_this_post($post);
  $results = mysqli_num_rows($get_post);
	$row = mysqli_fetch_assoc($get_post);

?>

<?php if ($results > 0) { ?>

<div id="mb-wrap">
	<h1>Single Post</h1>
	<div class="new-topic">
		<a href="message-board.php" class="bkpg"><i class="fas fa-backward"></i> Back</a>
	</div>

	<div class="post-content">
    <input type="hidden" id="gtg" value="gtg">
    <div class="pt-wrap">
		<p class="mp-date"><?= date('g:i A D, M d, \'y', strtotime($row['opened'])+3600) ?> | <?= substr($row['username'], 0, 1) . '... ' ?> Posted:</p>

  <?php /* begin delete icon */ ?>
    <?php if (isset($_SESSION['id']) && ($_SESSION['id'] == $row['idt_user'] || ($_SESSION['mode'] == 1 && ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3)))) { ?>

      <form id="delete-post">
        <input type="hidden" name="post-id" value="<?= $row['idt_topic'] ?>">
        <input type="hidden" name="uid" value="<?= $row['idt_user'] ?>">
        <input type="hidden" id="ybcwpb">

      <?php if ($_SESSION['id'] == $row['idt_user']) { ?>
        <a data-id="delete-post" data-role="delete-post" class="manage-delete-mb"><div class="tooltip right"><span class="tooltiptext">Delete your Post</span><i class="far fas fa-minus-circle"></i></div></a>

      <?php } else if ($_SESSION['admin'] != 1 && ($row['admin'] == 1 || $row['admin'] == 3)) { ?>
        <a class="gtp my-stuff"><div class="tooltip right"><span class="tooltiptext">Admin Off Limits</span><i class="far fas fa-minus-circle"></i></div></a>

      <?php } else { ?>
        <a data-id="delete-post" data-role="delete-post" class="manage-delete-mb"><div class="tooltip right"><span class="tooltiptext">Delete their Post</span><i class="far fas fa-minus-circle"></i></div></a>

      <?php } ?>

      </form>
    <?php } ?>
  <?php /* end delete icon */ ?>

  </div><!-- .pt-wrap -->

    <?php if (isset($_SESSION['id']) && ($_SESSION['mode'] == 1 && ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3))) { // admin view of username + email ?>
    <?php if ($_SESSION['id'] == $row['idt_user']) { ?>
      <p class="admin-mp-info">This is your post</p>
    <?php } else if ($_SESSION['admin'] != 1 && ($row['admin'] == 1 || $row['admin'] == 3)) { 
      // remember, there's only 1 ($row['admin'] = 1) ?>
      <p class="admin-mp-info">Admin (off limits)</p>

    <?php } else { ?>
      <a class="admin-mp-info gtp" href="user_role.php?user=<?= h(u($row['idt_user'])); ?>"><div class="tooltip"><span class="tooltiptext">Manage User</span><?= $row['username'] . ' &bullet; ' . $row['email'] ?></div></a>
    <?php } ?>

  <?php } ?>

    <p class="mp-title"><?= $row['mb_header'] ?></p>
		<p class="mb-body"><?= nl2br($row['mb_body']) ?></p>
		<?php mysqli_free_result($get_post); ?>

	</div>

	<div class="replies">
		<ul id="replies"><?php /* magic */ ?></ul>
	</div>

<!-- 		<div class="mb-reply">
			<a id="toggle-post-reply" class="post-a-reply">Reply</a>
		</div> -->
    <?php if (isset($_SESSION['id'])) { ?>
  		<div id="reply-spot">
        <div id="post-error"></div>
  			<form id="post-reply" action="" method="post">
  				<textarea id="mb-replyz" name="mb-reply" class="mb-reply" placeholder="Enter your reply here."></textarea>
  				<input type="hidden" name="post-id" value="<?= $row['idt_topic'] ?>">
          <input type="hidden" id="user-posting" value="<?= $user_posting ?>">
  				<a id="reply">Post your reply</a>
  			</form>
  		</div>
    <?php } else { ?>
      <div id="reply-spot" class="post-visitor">
        <p>You need to be logged in to participate.</p>
        <div class="login-links">
          <a href="login.php">Login</a> <a href="signup.php">Signup</a>
        </div>
      </div>
    <?php } ?>

</div><!-- #mb-wrap -->

<?php } else { ?>
  <div class="post-deleted">
    <div class="pd-msg">
      <h2>Nothin' to see here</h2>
      <p>Whatever used to be here isn't any longer or if there wasn't anything here it still isn't.</p>
      <div class="login-links">
        <a href="message-board.php">Back to<br>Message Board</a>
      </div>
    </div>
  </div>
<?php } ?>

</div><!-- #wrap -->

<script>
// $("#reply-spot").hide();

$(document).ready(function() {
	var q = window.location.search;
  $('#replies').load('load-posts.php'+q);
  setInterval(function() {
    $('#replies').load('load-posts.php'+q);
    }, 3000);



  // user has clicked "Post reply"
  $(document).on('click','#reply', function() { 

    if ($('#ngtg').length == 0) {

    var username = $('#user-posting').val().charAt(0);
    var reply = $('#mb-replyz').val().trim();
    var empty = '';

    var serializedData = $('#post-reply').serialize();
    var customData = { new_message_board_reply: 'key' }; // can make comma separated array here

    if (reply == '') {
      $('#post-error').html('<p class="post-error">You can\'t submit an empty reply.</p>');
      return;
    }

    // event.preventDefault();
    $.ajax({
      dataType: "JSON",
      url: "processing.php",
      type: "POST",
      data: serializedData + '&' + $.param(customData),,
      beforeSend: function(xhr) {
        // $('#emh-contact-msg').html('<span class="sending-msg">Posting - one moment...</span>');
      },
      success: function(response) {
        // console.log(response);
        if(response) {
          console.log(response);
          if(response['signal'] == 'ok') {
            // $('#toggle-post-reply').removeClass('active');
            // $('#reply-spot').slideToggle();
            $('#mb-replyz').val(empty);
            $('#replies').append('<li><p class="mb-date">Just now | '+username+'... Posted:</p><p class="mb-body">'+reply+'</p></li>');
            $('#post-error').html('');


          } else {
            $('#emh-contact-msg').html('<div class="alert alert-warning">' + response['msg'] + '</div>');
          }
        } 
      },
      error: function() {
        $('#emh-contact-msg').html('<div class="alert alert-warning">There was an error between your IP and the server. Please try again later.</div>');
      }, 
      complete: function() {
      }
    })

  } else {
    location.reload();
  }

  });

  $(document).on('click', 'a[data-role=delete-reply]', function() {

    var id = $(this).data('id');
    var li_id = id.substring(id.indexOf('_') + 1);

    var serializedData = $('#'+id).serialize();
    var customData = { delete_message_board_reply: 'key' }; // can make comma separated array here

    $.ajax({
      dataType: "JSON",
      url: "processing.php",
      type: "POST",
      data: serializedData + '&' + $.param(customData),
      beforeSend: function(xhr) {
        // $('#emh-contact-msg').html('<span class="sending-msg">Posting - one moment...</span>');
      },
      success: function(response) {
        // console.log(response);
        if(response) {
          console.log(response);
          if(response['signal'] == 'ok') {

            $('#li_'+li_id).remove();

          } else {
            //$('#li_'+id).html('<div class="alert alert-warning">' + response['msg'] + '</div>');

          }
        } 
      },
      error: function() {
        $('#emh-contact-msg').html('<div class="alert alert-warning">There was an error between your IP and the server. Please try again later.</div>');
      }, 
      complete: function() {

      }
    })
  }); 

});
</script>
<?php require '_includes/footer.php'; ?>
