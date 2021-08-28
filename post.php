<?php 
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

$layout_context = 'post-page';

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

	$post = $_GET['post-id'];
	$get_post = get_this_post($post);
	$row = mysqli_fetch_assoc($get_post);

?>
<div id="mb-wrap">
	<h1 class="topic-h"><?= $row['mb_header'] ?></h1>
	<div class="new-topic">
		<a href="message-board.php" class="bkpg"><i class="fas fa-backward"></i> Back</a>
	</div>
	<div class="post-content">
		<p class="mb-date"><?= date('g:i A D, M d, \'y', strtotime($row['opened'])) ?> | <?= substr($row['username'], 0, 1) . '... ' ?> Posted:</p>
		<p class="mb-body"><?= nl2br($row['mb_body']) ?></p>
		<?php mysqli_free_result($get_post); ?>

	</div>

	<div class="replies">
		<ul id="replies"></ul>
	</div>

		<div class="mb-reply">
			<a id="mb-reply" class="gtp res">Post a reply</a>
		</div>

		<div id="reply-spot">
			<form id="post-reply" action="" method="post">
				<textarea id="mb-replyz" name="mb-reply" class="mb-reply" placeholder="Enter your reply here."></textarea>
				<input type="hidden" name="post-id" value="<?= $row['id_topic'] ?>">
				<a id="reply">Post reply</a>
			</form>
		</div>

</div><!-- #mb-wrap -->

</div><!-- #wrap -->

<script>
// const queryString = window.location.search;
// console.log(queryString);
$(document).ready(function() {
	var q = window.location.search;
  $('#replies').load('load-posts.php'+q);
  setInterval(function() {
    $('#replies').load('load-posts.php'+q);
    }, 5000);

  $(document).on('click', '#mb-reply', function() {
    close_navigation_first();
    var active = $(this);
    var toggle = $('#reply-spot');

    $(toggle).slideToggle();
    if ($(active).hasClass('active')) {
      $(active).removeClass('active');
    } else {
      $(active).addClass('active');
    }
  });

  $(document).on('click','#reply', function() {
    var username = $('#user-posting').val();
    var reply = $('#mb-replyz').val();

    // event.preventDefault();
    $.ajax({
      dataType: "JSON",
      url: "process-mb.php",
      type: "POST",
      data: $('#post-reply').serialize(),
      beforeSend: function(xhr) {
        // $('#emh-contact-msg').html('<span class="sending-msg">Posting - one moment...</span>');
      },
      success: function(response) {
        // console.log(response);
        if(response) {
          console.log(response);
          if(response['signal'] == 'ok') {
            // $('#reply-spot').html('     <form id="post-reply" action="" method="post"><textarea name="mb-reply" class="mb-reply"></textarea><input type="hidden" name="id-topic" value="<?= $row['id_topic'] ?>"><a id="reply">Post reply</a></form>');
            $('#mb-reply').removeClass('active');
            $('#reply-spot').slideToggle();

            $('#replies').append('<li><p class="mb-date">Just now | '+username.charAt(0)+'... Posted:</p><p class="mb-body">'+reply+'</p></li>');

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
  });

  $(document).on('click', 'a[data-role=delete-reply]', function() {

    var id = $(this).data('id');
    var li_id = id.substring(id.indexOf('_') + 1);

    $.ajax({
      dataType: "JSON",
      url: "process-delete-mb-reply.php",
      type: "POST",
      data: $('#'+id).serialize(),
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
