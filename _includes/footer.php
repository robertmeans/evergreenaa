<?php // error_reporting(0);

?>

<footer>

<div id="toggle-contact-form">comments | questions | suggestions</div>

<div id="email-bob">
    <p class="form-note">Note: Hosts are responsible for the content of their meetings. Contact below for technical issues and feature requests. If you would like to personalize this website <a class="ytv" href="https://youtu.be/CC1HlQcmy6c" target="_blank">please see this</a> short YouTube video. <i class="far fa-smile"></i></p>

    <form id="footer-contact-form">
      
        <ul>
          <li>
            <label class="text" for="name">Name</label>
            <input required name="name" type="text" id="name">
          </li>
          <li>
            <label class="text" for="email" required>Email</label>
            <input name="email" type="email" id="email">
          </li>
          <li>
            <label class="text" for="comments">Message</label>
            <textarea required name="comments" id="comments"></textarea>
            <input type="hidden" name="footercontact" value="footercontact">
          </li>
          <li>
            <div id="msg">
              <ul class="ftr-con"></ul></div>
          </li>
          <li id="send-btn-nope" class="embtn">
            <input id="emailBob" value="Send">
          </li>
        </ul> 

    </form>
    <img src="_images/sending.gif" style="display:none;"><!-- preload -->
</div>

<p class="copyright"><?= ewd_copyright(2020); ?> <a class="eb" href="http://evergreenbob.com" target="_blank">Evergreen Bob</a></p> 
</footer>


<?php if (($layout_context != 'login-page') && ($layout_context != 'message-board')) {  ?>
<!-- Modal -->
<div id="theModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <a class="static closefp"><i class="fas fa-fw fa-times"></i></a>
        <h4 id="msg-title" class="modal-title"></h4>
        <h4 id="mtgname" class="modal-title"></h4>
      </div>
      <div class="modal-body">

      <form id="emh-contact" class="emh-form">
        <input type="hidden" name="tuid" id="tuid">
        <input type="hidden" name="mtgid" id="mtgid">
        <input type="hidden" name="vdt" id="vdt">
        <input type="hidden" name="vtz" id="vtz">
        <input type="hidden" name="mtgname" id="mtgnamez">
        <input type="hidden" name="ri" id="ri">

        <label id="your-name">Your name
        <input name="name" id="emh-name" class="edit-input link-name" type="text" maxlength="30"></label>

        <label id="your-email">Your email
        <input name="email" id="emh-email" class="edit-input link-email" type="email" maxlength="250"></label>

        <label><span id="msg-label"></span>
        <textarea name="emhmsg" id="emh-msg" class="edit-input link-msg" maxlength="2000"></textarea>
        </label>

        <div id="emh-contact-msg"></div>

        <div id="submit-links" class="submit-links"></div><!-- #submit-links -->
      </form>
      <img src="_images/sending.gif" style="display:none;"><!-- preload -->
      </div>
      <div class="modal-footer">
        <h3>&nbsp;</h3>
      </div>
    </div>
  </div>
</div>    
<?php } ?>

<?php if ($layout_context == 'message-board') {  ?>
<!-- Modal -->
<div id="theModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <a class="static closefp"><i class="fas fa-fw fa-times"></i></a>
        <h4 class="modal-title">Start a new topic</h4>
        <h4 id="mtgname" class="modal-title"></h4>
      </div>
      <div class="modal-body">

      <form id="mb" class="emh-form">
        <input type="hidden" name="mtgid" id="mtgid">
        <input type="hidden" name="mtgname" id="mtgnamez">
        <input type="hidden" id="user-posting" value="<?= $_SESSION['username'] ?>">

        <label>Title | Topic | Headline
        <input id="mb-title" name="mb-title" class="edit-input link-name" type="text" maxlength="50"></label>

        <label>Body
        <textarea name="mb-post" id="emh-msg" class="edit-input link-msg" maxlength="250"></textarea>
        </label>

        <div id="emh-contact-msg"></div>

        <div class="submit-links">
          <input type="button" id="mb-new" class="send" value="Post it">
        </div><!-- #submit-links -->
      </form>
      <img src="_images/sending.gif" style="display:none;"><!-- preload -->
      </div>
      <div class="modal-footer">
        <h3>&nbsp;</h3>
      </div>
    </div>
  </div>
</div> 

<?php // require '_includes/msg-message-board-join.php'; /* muted bc not using 10.27.25 */ ?>   
<?php } ?>


<?php
$theme = configure_theme();
if ($theme == '0') {
  switch ($layout_context) {
    case 'home-private'     :   echo "<script type=\"text/javascript\" src=\"js/jquery.backstretch.min.js?"         . time() . "\"></script>";  break;
    case 'home-public'      :   echo "<script type=\"text/javascript\" src=\"js/jquery.backstretch.min.js?"         . time() . "\"></script>";  break;
    case 'message-board'    :   echo "<script type=\"text/javascript\" src=\"js/jquery.backstretch.msg-board.js?"   . time() . "\"></script>";  break;
    case 'post-page'        :   echo "<script type=\"text/javascript\" src=\"js/jquery.backstretch.msg-board.js?"   . time() . "\"></script>";  break;
    default                 :   echo "<script type=\"text/javascript\" src=\"js/jquery.backstretch.landing-pgs.js?" . time() . "\"></script>";  break;
  }
} else {
  switch ($layout_context) {
    case 'home-private'     :   echo "<script type=\"text/javascript\" src=\"js/jquery.backstretch.min.light.js?"         . time() . "\"></script>";  break;
    case 'home-public'      :   echo "<script type=\"text/javascript\" src=\"js/jquery.backstretch.min.light.js?"         . time() . "\"></script>";  break;
    case 'message-board'    :   echo "<script type=\"text/javascript\" src=\"js/jquery.backstretch.msg-board-light.js?"   . time() . "\"></script>";  break;
    case 'post-page'        :   echo "<script type=\"text/javascript\" src=\"js/jquery.backstretch.msg-board-light.js?"   . time() . "\"></script>";  break;
    default                 :   echo "<script type=\"text/javascript\" src=\"js/jquery.backstretch.landing-pgs-light.js?" . time() . "\"></script>";  break;
  }  
}
?>
<script src="js/jquery.timepicker.min.js?<?php echo time(); ?>"></script>
<script src="js/scripts.js?<?php echo time(); ?>"></script>
<?php if (WWW_ROOT == 'http://localhost/evergreenaa') { ?>
<script src="http://localhost:35729/livereload.js"></script>
<?php } ?>	

</body>
</html>
<?php
    db_disconnect($db);
?>