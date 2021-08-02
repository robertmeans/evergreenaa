<?php error_reporting(0);
    function ewd_copyright($startYear) {
        $currentYear = date('Y');
        if ($startYear < $currentYear) {
            $currentYear = date('y');
            // return "<i class=\"fas fa-peace\"></i> $startYear&ndash;$currentYear";
            return "<i class=\"far fa-heart\"></i> $startYear&ndash;$currentYear";
        } else {
            // return "<i class=\"fas fa-peace\"></i> $startYear";
            return "<i class=\"far fa-heart\"></i> $startYear";
        }
    }
?>

<footer>

<button id="toggle-contact-form"><i class="fa fa-star" aria-hidden="true"></i><span class="tiny-mobile">&nbsp;&nbsp;</span> comments | questions | suggestions <span class="tiny-mobile">&nbsp;&nbsp;</span><i class="fa fa-star" aria-hidden="true"></i></button>

<div id="email-bob">
    <p class="form-note">Note: Hosts are responsible for the content of their meetings. Contact below for technical issues and feature requests. If you would like to personalize this website <a class="ytv" href="https://youtu.be/CC1HlQcmy6c" target="_blank">please see this</a> short YouTube video. <i class="far fa-smile"></i></p>

    <form id="contactForm">
      
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
          </li>
          <li>
            <div id="msg"></div>
          </li>
          <li>
            <input id="emailBob" value="Send">
          </li>
        </ul> 

    </form>

</div>

<p class="copyright"><?= ewd_copyright(2020); ?> <a class="eb" href="http://evergreenbob.com" target="_blank">Evergreen Bob</a></p> 
</footer>


<?php /* if (($layout_context) == 'home-private') { */ ?>
<!-- Modal -->
<div id="theModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <a class="static closefp"><i class="fas fa-times-circle"></i></a>
        <h4 class="modal-title">Message the Host of:</h4>
        <h4 id="mtgname" class="modal-title"></h4>
      </div>
      <div class="modal-body">

      <form id="emh-contact" class="emh-form">
        <input type="hidden" name="mtgid" id="mtgid">
        <input type="hidden" name="mtgname" id="mtgnamez">

        <label>Your name
        <input name="name" id="emh-name" class="edit-input link-name" type="text" maxlength="30"></label>

        <label>Your email
        <input name="email" id="emh-email" class="edit-input link-email" type="email" maxlength="250"></label>

        <label>Message
        <textarea name="emhmsg" id="emh-msg" class="edit-input link-msg" maxlength="2000"></textarea>
        </label>

        <div id="emh-contact-msg"></div>

        <div class="submit-links">
          <input type="button" id="emh-btn" class="send" value="Send">
        </div><!-- #submit-links -->
      </form>
      </div>
      <div class="modal-footer">
        <h3>&nbsp;</h3>
      </div>
    </div>
  </div>
</div>    
<?php /* } */ ?>


<?php
switch ($layout_context) {
    case 'home-private'     :   echo "<script type=\"text/javascript\" src=\"js/jquery.backstretch.min.js?"         . time() . "\"></script>";  break;
    case 'home-public'      :   echo "<script type=\"text/javascript\" src=\"js/jquery.backstretch.min.js?"         . time() . "\"></script>";  break;
    default                 :   echo "<script type=\"text/javascript\" src=\"js/jquery.backstretch.landing-pgs.js?" . time() . "\"></script>";  break;
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