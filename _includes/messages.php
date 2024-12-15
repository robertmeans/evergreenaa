<?php if (!isset($layout_context)) { $layout_context = 'foo'; } 

function msgTopTZ() {
  echo "<div class=\"set-tz\">\n";
  echo "<div class=\"tz-box\">\n";
  echo "<h3>Set Timezone</h3>\n";
  echo "<div class=\"tz-content\">\n";
}
function msgBtmTZ() {
  echo "<p class=\"next-p\">Select your timezone:</p>\n";
  echo "<form id=\"init-set-tz\" action=\"\" method=\"post\">\n";
  echo "<select id=\"init-tz-select\" class=\"pick-tz\" name=\"timezone\">\n";
  echo "<option value=\"empty\">" . timezone_select_options(). "</option>\n";
  echo "</select>\n";
  echo "<input id=\"tz-url\" type=\"hidden\" name=\"tz-url\">\n";
  echo "<input type=\"hidden\" name=\"set-tz\">\n";
  echo "<div id=\"init-pick-tz\"></div>\n";
  echo "<a id=\"init-tz-submit\" class=\"btn\">OK</a>\n";
  echo "</form></div></div></div>";
} 
function msgTopStd($id, $h1) {
  echo "<div id=\"$id\">\n";
  echo "<div class=\"msg-bkg\">\n";
  echo "<div class=\"inside-msg-one\">\n";
  echo "<i class=\"far fa-times-circle\"></i>\n";
  echo "<h1>$h1</h1>\n";
}
function msgBtmStd() {
  echo "</div></div></div>";
}

/* BEGIN: set timezone */
if ($new_tz == 'member') { 
  msgTopTZ(); ?>
    <p>Looks like you're logged in but don't have a timezone set for your account. Set it now and I won't forget. You can always change it in the future from the Menu.</p>
<?php
  msgBtmTZ(); return;
} elseif ($new_tz == 'visitor') { 
  msgTopTZ(); ?>
    <p>Let's set your timezone for this website. You're not logged in but I will try to remember your setting on this browser. You can always change it in the future from the Menu.</p>
<?php
  msgBtmTZ(); return; 
} elseif ($new_tz == 'no-cookies') { 
  msgTopTZ(); ?>
    <p>Looks like you're on a device that won't allow me to save your timezone setting. We'll need to set it on a per visit basis. If you need to change it during this visit you can do so from the Menu.</p>
<?php
  msgBtmTZ(); return; } 
/* this one's unique - leave it alone. */ ?>
<div id="tz" class="set-tz">
  <div class="tz-box">
    <h3>Set Timezone</h3>
    <div class="tz-content">
      <p class="next-p">Change your timezone:</p>
      <form id="tz-form" action="" method="post">
        <select id="tz-select" class="pick-tz" name="timezone">
          <option value="empty"><?php echo timezone_select_options($tz); ?></option>
        </select>
        <input id="tz-url" type="hidden" name="tz-url">
        <input type="hidden" name="set-tz">
        <div id="pick-tz"></div>
        <a id="tz-submit" class="btn">OK</a>
        <a id="hide-tz" class="btn cancel">Cancel</a>
      </form>
<?php msgBtmStd(); /* END: set timezone */ 

if ($layout_context === 'home' || $layout_context === 'login-page') { 
  msgTopStd('theme-options', '<i class="far fas fa-lightbulb"></i>&nbsp; Light this sucker up!'); ?>
    <p>Hey<?= $greeting ?>, did you know there's a "Bright Theme" option? Just in case the hazy shade of winter leaves you longing for a lively lift - open the Menu and you'll find it at the top. Or...</p>

    <form action="processing.php" method="post">
      <input type="hidden" name="theme" value="1">
      <input type="hidden" name="change-theme" value="key">
      <input type="hidden" id="themepopupurl" name="themeurl">
      <a class="theme-popup-btn" onclick="$(this).closest('form').submit(); closeNav();">Click here to try it now</a>
    </form>
<?php msgBtmStd(); } 

if (is_visitor()) { /* stand alone - do not consolidate */
  msgTopStd('why-join', 'Why join?'); ?>

    <p>This site offers a way to share, find and organize meeting information.</p>

    <p>Opening an account allows you post on this site. You can publish meeting information and make it available to everyone who visits this site, to only other members of EvergreenAA.com or keep it private - for your eyes only. You can manage the information you put here (create, edit, delete) via mobile, tablet or desktop).</p>
<?php msgBtmStd(); } 

if (is_visitor()) { /* begin role descriptions */
  msgTopStd('role-key', 'Visitor') ?>
    <p>Thanks for visiting! If a single person finds a single meeting on this site that starts them towards a better life, the effort to prepare it will have been worthwhile.</p>

<?php msgBtmStd(); } else if (is_president()) { 
  msgTopStd('role-key', 'Website President'); ?>
      <p>You can do anything you want here while in Admin Mode including:</p>
      <ul>
        <li>Assign or revoke Top Tier Admin privileges</li>
        <li>Suspend or unsuspend anyone</li>
        <li>See other's private meetings + edit, transfer or delete them</li>
        <li>Edit, Transfer or Delete any meeting anywhere</li>
        <li>See username + email address of meeting host when viewing a meeting on the homepage</li>
        <li>Access Email Everyone page in order to BCC all members. *Note: At the moment it works best to just copy addresses to clipboard and use your own email client ( <em>use BCC!</em> ). Going through website is at the mercy of GoDaddy servers and they're unpredictible.</li>
      </ul>

<?php msgBtmStd(); } else if (declare_executive()) { 
  msgTopStd('role-key', 'Executive privileges'); ?>  
    <p>While in Admin Mode you can:</p>
    <ul>
      <li>Edit any meeting*</li>
      <li>Transfer any meeting*</li>
      <li>Delete any meeting*</li>
      <li>Assign or revoke Admin, Manager or Member privileges</li>
      <li>Suspend or unsuspend users</li>
      <li>See username + email address of meeting host when viewing a meeting on the homepage</li>
    </ul>
    <p>*Excluding those belonging to other management</p>

<?php msgBtmStd(); } else if (declare_admin()) { 
  msgTopStd('role-key', 'Administrator privileges'); ?>
    <p>While in Admin Mode you can:</p>
    <ul>
      <li>Edit any meeting (except other Admins) - You can change other meetings to Draft or Private thereby effectively removing them from view but you cannot delete any meetings other than your own.</li>
      <li>Transfer any meeting (except other Admins)</li>
      <li>See username + email address of meeting host when viewing a meeting on the homepage</li>
    </ul>

<?php msgBtmStd(); } else if (declare_manager()) { 
  msgTopStd('role-key', 'Manager privileges'); ?>
    <ul>
      <li>Edit Member's meetings (except other Admins) - You can change other meetings to Draft or Private thereby effectively removing them from view but you cannot delete any meetings other than your own.</li>
      <li>Transfer any meeting (except other Admins)</li>
      <li>See username + email address of meeting host when viewing a meeting on the homepage</li>
    </ul>

<?php msgBtmStd(); } else { // Member
  msgTopStd('role-key', 'Member privileges'); ?>   
    <ul>
      <li>Add meetings</li>
      <li>Edit your meetings</li>
      <li>Transfer your meetings</li>
      <li>Delete your meetings</li>
    </ul>

<?php msgBtmStd(); } /* end role descriptions */

if ($layout_context === 'alt-manage') { 
  msgTopStd('desc-loc', 'Descriptive Location'); ?>
    <p>This can be useful if your meeting is, say, &quot;Behind the 2nd building on the right, 3rd floor, 4th room on left.&quot;</p>
    <p>Use this field if you want to provide descriptive information about the location.</p>
  <?php msgBtmStd();  ?>

  <?php msgTopStd('lat-long', 'Physical Address'); ?>
    <p>Put either coordinates* or a physical address in this field.</p>
    <p>*To get coordinates go to <a href="https://www.google.com/maps" id="gmaps" target="_blank">Google Maps</a> and search for your location. Put your cursor where you want the directions to point and right click (or [Cmd + click] on a Macintosh), copy the coordinates and paste them here.</p>
  <?php msgBtmStd(); ?>

  <?php msgTopStd('one-tap', 'One Tap Mobile Number'); ?>
    <p>This is a specific string of numbers &amp; characters that Zoom provides so mobile users only have to press 1 link to dial the whole set of instructions to join a Zoom meeting. It looks something like this:</p>
    <p>13122326799,,85589390399##,,,,*963889#</p>
    <p>If you're unsure whether you've got it entered correctly give it a test run once it's on the site.</p>
  <?php msgBtmStd(); ?>

  <?php msgTopStd('yer-phone-num', 'Phone Number'); ?>
    <p>This is not Zoom-related. This would be your phone number if you were so inclined to field phone calls about this meeting.</p>
  <?php msgBtmStd(); ?>

  <?php msgTopStd('link-label', 'Link Label'); ?>
    <p>This is what your visitors will see so they know what they're clicking. 25 character limit.</p>
  <?php msgBtmStd(); ?>

  <?php msgTopStd('pdf-upload', 'PDF Uploads'); ?>
    <p>Files must be in PDF format. 2 MB (2,048 KB) limit per file. I know that's not big. If it poses a problem please scroll to the bottom of any page and let me know in the &quot;comments | questions | suggestions&quot; area.</p>
    <p>If you need to convert your files into PDF you can do it <a class="extras pdf" href="https://www.adobe.com/acrobat/online/convert-pdf.html" target="_blank">here</a> or <a class="extras pdf" href="https://cloudconvert.com/pdf-converter" target="_blank">here.</a></p>
  <?php msgBtmStd(); ?>

<?php } /* $layout_context === 'alt-manage' */ ?>

<?php if ($layout_context === 'analytics') { 
  msgTopStd('total-interactions', 'Total Interactions'); ?>
    <p>This is the most basic, raw, cleanest and best information here.</p>
    <p>It means that from the <span id="msg-uni-ip"></span> unique IP's there were <span id="msg-tot-in"></span> interactions. These interactions only include opening individual meetings (for now). In other words, someone had to specifically click on a meeting in order to register in this count.</p>
  <?php msgBtmStd(); 

  msgTopStd('unique-ip', 'Unique IP\'s'); ?>
    <p id="msg-uni-ipz"></p>
  <?php msgBtmStd(); 




  msgTopStd('days-opened', 'Days Opened'); ?>
    <p>This represents the number of times people expanded a specific day in order to see what meetings were available.</p>
  <?php msgBtmStd();





  msgTopStd('individual-interactions', 'Individual Interactions'); ?>
    <p>The sum of these numbers (<span id="msgb-tot-in-int"></span>) is larger than the "<span id="msgb-tot-in"></span> Interactions" at the top because it includes clicking on days in addition to meetings.</p>
  <?php msgBtmStd();

  msgTopStd('clean-up-ips', 'Unique IP'); ?>
    <p>This one's tricky for the moment because, since this whole thing started mid-stream, there were people already logged in and so it only shows their IP one time but they may have done something like opened a day which is an action worth keeping. I put this message here so I can use it if I want once I get this thing working correct.</p>
  <?php msgBtmStd();
} /* $layout_context === 'analytics' */ 

if ($layout_context === 'message-board' || $layout_context === 'post-page') { 
  msgTopStd('mb-notes', 'Privacy &amp; Decorum'); ?>
    <p>1. Only the first character of a User's username will be used to distinguish who is communicating. Please observe all interpretations, perceptions and sensitivities of the concept, &quot;anonymous.&quot;</p>
    <p>2. Big fat meany weenies will be 86'd outta here faster than you should have been that time you did that stupid thing that you now mildly or perhaps, deeply, regret.</p>
  <?php msgBtmStd();

  msgTopStd('gottajoin', 'Gotta join to participate'); ?>
    <p>If just any random Internet surfer were let loose to post can you imagine the chaos? The mayhem? The bedlam, the fracas AND the discombobulation?!</p>
    <p>No sir (or ma'am). You need to be logged in to bring that kind of heat. You can look at the menu, but you just can't eat. You can feel the cushions, but you can't have a seat...</p>
    <p class="info-links"> 
      <a class="extras" href="login.php">Login</a>
      <a class="extras" href="signup.php">Join</a>
    </p>
  <?php msgBtmStd();

} /* $layout_context === 'message-board' || $layout_context === 'post-page' */ ?>

<div id="msg-one">
  <div class="msg-bkg">
    <div class="inside-msg-one">
      <i class="far fa-times-circle"></i>
      <p>Hello<?php if (isset($_SESSION['username'])) { echo ' ' . h($_SESSION['username']) . ','; } else { echo ','; } ?></p>

      <p>Thank you for joining. If you host an online AA meeting you can post it here (go to Dashboard) or you can use this site as your own private meeting organizer.</p>
      <p>If something needs attention here please email at the bottom of any page.</p>

      <p class="info-links"> 
        <a id="preamble" class="extras" href="https://www.aa.org/assets/en_US/smf-92_en.pdf" target="_blank">AA Preamble</a>

        <a id="twelvesteps" class="extras" href="https://www.aa.org/assets/en_US/smf-121_en.pdf" target="_blank">12 Steps</a>

        <a id="traditions" class="extras" href="https://www.aa.org/assets/en_US/smf-122_en.pdf" target="_blank">12 Traditions</a>

        <a id="topics" class="extras" href="_images/Meeting-Starters.pdf" target="_blank">101 Meeting Starters</a>
      </p>
      <!-- <p class="daccaa-ctr"><a id="daccaa" class="daccaa" href="http://www.daccaa.org" target="_blank">DACCAA Website</a></p> -->
    </div><!-- .inside-msg-one -->
  </div><!-- .msg-bkg -->
</div><!-- #msg-one -->