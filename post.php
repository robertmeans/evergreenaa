<?php 
require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

$layout_context = 'post-page';

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
	<h1 class="topic-h">Message Board</h1>
	<div class="new-topic">
		<a href="message-board.php" class="bkpg"><i class="fas fa-backward"></i> Back</a>
	</div>
	<div class="post-content">
		<p class="mp-date"><?= date('g:i A D, M d, \'y', strtotime($row['opened'])) ?> | <?= substr($row['username'], 0, 1) . '... ' ?> Posted:</p>

        <?php if (isset($_SESSION['id']) && ($_SESSION['mode'] == 1 && ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3))) { // admin view of username + email ?>
          <a class="admin-mp-info gtp" href="user_role.php?user=<?= h(u($row['id_user'])); ?>"><div class="tooltip"><span class="tooltiptext">Manage User</span><?= $row['username'] . ' &bullet; ' . $row['email'] ?></div></a>
        <?php } ?>

    <p class="mp-title"><?= $row['mb_header'] ?></p>
		<p class="mb-body"><?= nl2br($row['mb_body']) ?></p>
		<?php mysqli_free_result($get_post); ?>

	</div>

	<div class="replies">
		<ul id="replies"><?php /* magic */ ?></ul>
	</div>

		<div class="mb-reply">
			<a id="toggle-post-reply" class="post-a-reply">Reply</a>
		</div>
    <?php if (isset($_SESSION['id'])) { ?>
  		<div id="reply-spot">
        <div id="post-error"></div>
  			<form id="post-reply" action="" method="post">
  				<textarea id="mb-replyz" name="mb-reply" class="mb-reply" placeholder="Enter your reply here."></textarea>
  				<input type="hidden" name="post-id" value="<?= $row['id_topic'] ?>">
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

</div><!-- #wrap -->

<script>
// const queryString = window.location.search;
// console.log(queryString);
$(document).ready(function() {
	var q = window.location.search;
  $('#replies').load('load-posts.php'+q);
  setInterval(function() {
    $('#replies').load('load-posts.php'+q);
    }, 5553000);

  $(document).on('click', '#toggle-post-reply', function() {
    close_navigation_first();
    var active = $(this);
    var toggle = $('#reply-spot');

    $(toggle).slideToggle();
    if ($(active).hasClass('active')) {
      $(active).removeClass('active');
      setTimeout(function() { // give textarea time to close before clearing
        $('#post-error').html('');
      }, 500);
    } else {
      $(active).addClass('active');
    }
  });

  // user has clicked "Post reply"
  $(document).on('click','#reply', function() { 
    var username = $('#user-posting').val().charAt(0);
    var reply = $('#mb-replyz').val().trim();

    if (reply == '') {
      $('#post-error').html('<p class="post-error">You can\'t submit an empty reply.</p>');
      return;
    }

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
            $('#toggle-post-reply').removeClass('active');
            $('#reply-spot').slideToggle();
            $('#replies').append('<li><p class="mb-date">Just now | '+username+'... Posted:</p><p class="mb-body">'+reply+'</p></li>');
            $('#post-error').html('');

          setTimeout(function() { // give textarea time to close before clearing
            $('#reply-spot').html('<form id="post-reply" action="" method="post"><textarea id="mb-replyz" name="mb-reply" class="mb-reply" placeholder="Enter your reply here."></textarea><input type="hidden" name="post-id" value="<?= $row['id_topic'] ?>"><input type="hidden" id="user-posting" value="<?= $user_posting ?>"><a id="reply">Post reply</a></form>');
          }, 500);

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
