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
<?php } else { } ?>	

</body>
</html>
<?php
    db_disconnect($db);
?>