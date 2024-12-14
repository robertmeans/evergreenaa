<?php if (!isset($layout_context)) { $layout_context = 'foo'; } ?>

<?php /* BEGIN: set timezone */ ?>
<?php 
if ($new_tz == 'member') { ?>
  <div class="set-tz">
    <div class="tz-box">
      <h3>Set Timezone</h3>
      <div class="tz-content">
        <p>Looks like you're logged in but don't have a timezone set for your account. Set it now and I won't forget. You can always change it in the future from the Menu.</p>
        <p class="next-p">Select your timezone:</p>
        <form id="init-set-tz" action="" method="post">
          <select id="init-tz-select" class="pick-tz" name="timezone">
            <option value="empty"><?php echo timezone_select_options(); ?></option>
          </select>
          <input id="tz-url" type="hidden" name="tz-url">
          <input type="hidden" name="set-tz">
          <div id="init-pick-tz"></div>
          <a id="init-tz-submit" class="btn">OK</a>
        </form>
      </div>
    </div>
  </div>
<?php return;
} elseif ($new_tz == 'visitor') { ?>
  <div class="set-tz">
    <div class="tz-box">
      <h3>Set Timezone</h3>
      <div class="tz-content">
        <p>Let's set your timezone for this website. You're not logged in but I will try to remember your setting on this browser. You can always change it in the future from the Menu.</p>
        <p class="next-p">Select your timezone:</p>
        <form id="init-set-tz" action="" method="post">
          <select id="init-tz-select" class="pick-tz" name="timezone">
            <option value="empty"><?php echo timezone_select_options(); ?></option>
          </select>
          <input id="tz-url" type="hidden" name="tz-url">
          <input type="hidden" name="set-tz">
          <div id="init-pick-tz"></div>
          <a id="init-tz-submit" class="btn">OK</a>
        </form>
      </div>
    </div>
  </div>
<?php return; 
} elseif ($new_tz == 'no-cookies') { ?>
  <div class="set-tz">
    <div class="tz-box">
      <h3>Set Timezone</h3>
      <div class="tz-content">
        <p>Looks like you're on a device that won't allow me to save your timezone setting. We'll need to set it on a per visit basis. If you need to change it during this visit you can do so from the Menu.</p>
        <p class="next-p">Select your timezone:</p>
        <form id="init-set-tz" action="" method="post">
          <select id="init-tz-select" class="pick-tz" name="timezone">
            <option value="empty"><?php echo timezone_select_options(); ?></option>
          </select>
          <input id="tz-url" type="hidden" name="tz-url">
          <input type="hidden" name="set-tz">
          <div id="init-pick-tz"></div>
          <a id="init-tz-submit" class="btn">OK</a>
        </form>
      </div>
    </div>
  </div>
<?php return; } ?>

<div id="tz" class="set-tz">
  <div class="tz-box">
    <h3>Set Timezone</h3>
    <div class="tz-content">
      <!-- <p>Let's set the timezone for this website. I will try to remember your setting on this device. You can always change it in the future from the Menu.</p> -->
      <p class="next-p">Change your timezone:</p>
      <form id="tz-form" action="" method="post">
        <select id="tz-select" class="pick-tz" name="timezone">
          <option value="empty"><?php echo timezone_select_options($tz); ?></option>
        </select>
        <input id="tz-url" type="hidden" name="tz-url">
        <input type="hidden" name="set-tz">
        <div id="pick-tz"></div>
        <a id="tz-submit" class="btn">OK</a>
        <!-- <input type="submit" name="set-tz" value="OK"> -->
        <a id="hide-tz" class="btn cancel">Cancel</a>
      </form>
    </div>
  </div>
</div>
<?php /* END: set timezone */ ?>

<?php if ($layout_context === 'home-public' || $layout_context === 'login-page') { ?>
<div id="theme-options">
  <div class="msg-bkg">
    <div class="inside-msg-one">

      <?php if (isset($_SESSION['username'])) { 
        $greeting = ' ' . $_SESSION['username']; 
      } else { $greeting = ''; } ?>

      <i class="far fa-times-circle"></i>
      <h1><i class="far fas fa-lightbulb"></i>&nbsp; Light this sucker up!</h1>

      <p>Hey<?= $greeting ?>, did you know there's a "Bright Theme" option? Just in case the hazy shade of winter leaves you longing for a lively lift - open the Menu and you'll find it at the top. Or...</p>

      <form action="processing.php" method="post">
        <input type="hidden" name="theme" value="1">
        <input type="hidden" name="change-theme" value="key">
        <input type="hidden" id="themepopupurl" name="themeurl">
        <a class="theme-popup-btn" onclick="$(this).closest('form').submit(); closeNav();">Click here to try it now</a>
      </form>

      <?php /* <p class="poprt">I'm doin' my darndest to make sure you only see this message once.</p> */ ?>
    </div><!-- .inside-msg-one -->
  </div><!-- .msg-bkg -->
</div><!-- #msg-two -->
<?php } /* $layout_context === 'home-public' || $layout_context === 'login-page' */ ?>

<?php if ($layout_context === 'forgot-password' || $layout_context === 'home-public' || $layout_context === 'login-page' || $layout_context === 'message-board' || $layout_context === 'post-page') { ?>
<div id="why-join">
  <div class="msg-bkg">
    <div class="inside-msg-one">
      <i class="far fa-times-circle"></i>
      <h1>Why join?</h1>

      <p>This site offers a way to share, find and organize meeting information.</p>

      <p>Opening an account allows you post on this site. You can publish meeting information and make it available to everyone who visits this site, to only other members of EvergreenAA.com or keep it private - for your eyes only. You can manage the information you put here (create, edit, delete) via mobile, tablet or desktop).</p>

    </div><!-- .inside-msg-one -->
  </div><!-- .msg-bkg -->
</div><!-- #msg-two -->
<?php } /* $layout_context === 'home-public' || $layout_context === 'login-page' */ ?>

<?php if (is_visitor()) { ?>
<div id="role-key">
  <div class="msg-bkg">
    <div class="inside-msg-one">
      <i class="far fa-times-circle"></i>
      <h1>Visitor</h1>

      <p>Thanks for visiting! If a single person finds a single meeting on this site that starts them towards a better life, the effort to prepare it will have been worthwhile.</p>

    </div><!-- .inside-msg-one -->
  </div><!-- .msg-bkg -->
</div><!-- #msg-two -->
<?php } else if (is_president()) { ?>
<div id="role-key">
  <div class="msg-bkg">
    <div class="inside-msg-one">
      <i class="far fa-times-circle"></i>
      <h1>Website President</h1>

      <p>You can do anything you want here while in Admin Mode including:</p>
      <ul>
        <li>Assign or revoke Top Tier Admin privileges</li>
        <li>Suspend or unsuspend anyone</li>
        <li>See other's private meetings + edit, transfer or delete them</li>
        <li>Edit, Transfer or Delete any meeting anywhere</li>
        <li>See username + email address of meeting host when viewing a meeting on the homepage</li>
        <li>Access Email Everyone page in order to BCC all members. *Note: At the moment it works best to just copy addresses to clipboard and use your own email client ( <em>use BCC!</em> ). Going through website is at the mercy of GoDaddy servers and they're unpredictible.</li>
      </ul>

    </div><!-- .inside-msg-one -->
  </div><!-- .msg-bkg -->
</div><!-- #msg-two -->
<?php } else if (declare_executive()) { ?>  
<div id="role-key">
  <div class="msg-bkg">
    <div class="inside-msg-one">
      <i class="far fa-times-circle"></i>
      <h1>Executive privileges</h1>
      <p>While in Admin Mode you can:</p>
      <ul>
        <li>Edit any meeting (except other Executive's)</li>
        <li>Transfer any meeting (except other Executive's)</li>
        <li>Delete any meeting (except other Executive's)</li>
        <li>Assign or revoke Admin, Manager or Member privileges</li>
        <li>Suspend or unsuspend users</li>
        <li>See username + email address of meeting host when viewing a meeting on the homepage</li>
      </ul>

    </div><!-- .inside-msg-one -->
  </div><!-- .msg-bkg -->
</div><!-- #msg-two -->
<?php } else if (declare_admin()) { ?>
<div id="role-key">
  <div class="msg-bkg">
    <div class="inside-msg-one">
      <i class="far fa-times-circle"></i>
      <h1>Administrator privileges</h1>
      <p>While in Admin Mode you can:</p>
      <ul>
        <li>Edit any meeting (except other Admins) - You can change other meetings to Draft or Private thereby effectively removing them from view but you cannot delete any meetings other than your own.</li>
        <li>Transfer any meeting (except other Admins)</li>
        <li>See username + email address of meeting host when viewing a meeting on the homepage</li>
      </ul>

    </div><!-- .inside-msg-one -->
  </div><!-- .msg-bkg -->
</div><!-- #msg-two -->
<?php } else if (declare_manager()) { ?>
<div id="role-key">
  <div class="msg-bkg">
    <div class="inside-msg-one">
      <i class="far fa-times-circle"></i>
      <h1>Manager privileges</h1>
      <ul>
        <li>Edit Member's meetings (except other Admins) - You can change other meetings to Draft or Private thereby effectively removing them from view but you cannot delete any meetings other than your own.</li>
        <li>Transfer any meeting (except other Admins)</li>
        <li>See username + email address of meeting host when viewing a meeting on the homepage</li>
      </ul>

    </div><!-- .inside-msg-one -->
  </div><!-- .msg-bkg -->
</div><!-- #msg-two -->
<?php } else { //                                 Member ?>   
<div id="role-key">
  <div class="msg-bkg">
    <div class="inside-msg-one">
      <i class="far fa-times-circle"></i>
      <h1>Member privileges</h1>
      <ul>
        <li>Add meetings</li>
        <li>Edit your meetings</li>
        <li>Transfer your meetings</li>
        <li>Delete your meetings</li>
      </ul>

    </div><!-- .inside-msg-one -->
  </div><!-- .msg-bkg -->
</div><!-- #msg-two -->
<?php } ?>

<?php if ($layout_context === 'alt-manage') { ?>
  <div id="desc-loc">
    <div class="msg-bkg">
      <div class="inside-msg-one">
        <i class="far fa-times-circle"></i>
        <h1>Descriptive Location</h1>
        <p>This can be useful if your meeting is, say, &quot;Behind the 2nd building on the right, 3rd floor, 4th room on left.&quot;</p>

        <p>Use this field if you want to provide descriptive information about the location.</p>
      </div><!-- .inside-msg-one -->
    </div><!-- .msg-bkg -->
  </div><!-- #lat-long -->

  <div id="lat-long">
    <div class="msg-bkg">
      <div class="inside-msg-one">
        <i class="far fa-times-circle"></i>
        <h1>Physical Address</h1>
        <p>Put either coordinates* or a physical address in this field.</p>

        <p>*To get coordinates go to <a href="https://www.google.com/maps" id="gmaps" target="_blank">Google Maps</a> and search for your location. Put your cursor where you want the directions to point and right click (or [Cmd + click] on a Macintosh), copy the coordinates and paste them here.</p>
      </div><!-- .inside-msg-one -->
    </div><!-- .msg-bkg -->
  </div><!-- #lat-long -->

  <div id="one-tap">
    <div class="msg-bkg">
      <div class="inside-msg-one">
        <i class="far fa-times-circle"></i>
        <h1>One Tap Mobile Number</h1>
        <p>This is a specific string of numbers &amp; characters that Zoom provides so mobile users only have to press 1 link to dial the whole set of instructions to join a Zoom meeting. It looks something like this:</p>
        <p>13122326799,,85589390399##,,,,*963889#</p>
        <p>If you're unsure whether you've got it entered correctly give it a test run once it's on the site.</p>
      </div><!-- .inside-msg-one -->
    </div><!-- .msg-bkg -->
  </div><!-- #one-tap -->

  <div id="yer-phone-num">
    <div class="msg-bkg">
      <div class="inside-msg-one">
        <i class="far fa-times-circle"></i>
        <h1>Phone Number</h1>
        <p>This is not Zoom-related. This would be your phone number if you were so inclined to field phone calls about this meeting.</p>
      </div><!-- .inside-msg-one -->
    </div><!-- .msg-bkg -->
  </div><!-- #one-tap -->

  <div id="link-label">
    <div class="msg-bkg">
      <div class="inside-msg-one">
        <i class="far fa-times-circle"></i>
        <h1>Link Label</h1>
        <p>This is what your visitors will see so they know what they're clicking. 25 character limit.</p>
      </div><!-- .inside-msg-one -->
    </div><!-- .msg-bkg -->
  </div><!-- #lat-long -->

  <div id="pdf-upload">
    <div class="msg-bkg">
      <div class="inside-msg-one">
        <i class="far fa-times-circle"></i>
        <h1>PDF Uploads</h1>
        <p>Files must be in PDF format. 2 MB (2,048 KB) limit per file. I know that's not big. If it poses a problem please scroll to the bottom of any page and let me know in the &quot;comments | questions | suggestions&quot; area.</p>

        <p>If you need to convert your files into PDF you can do it <a class="extras pdf" href="https://www.adobe.com/acrobat/online/convert-pdf.html" target="_blank">here</a> or <a class="extras pdf" href="https://cloudconvert.com/pdf-converter" target="_blank">here.</a></p>
      </div><!-- .inside-msg-one -->
    </div><!-- .msg-bkg -->
  </div><!-- #lat-long -->

<?php } /* $layout_context === 'alt-manage' */ ?>

<?php if ($layout_context === 'analytics') { ?>
  <div id="total-interactions">
    <div class="msg-bkg">
      <div class="inside-msg-one">
        <i class="far fa-times-circle"></i>
        <h1>Total Interactions</h1>

        <p>This is the most basic, raw, cleanest and best information here.</p>

        <p>It means that from the <span id="msg-uni-ip"></span> unique IP's there were <span id="msg-tot-in"></span> interactions. These interactions only include opening individual meetings (for now). In other words, someone had to specifically click on a meeting in order to register in this count.</p>

      </div><!-- .inside-msg-one -->
    </div><!-- .msg-bkg -->
  </div><!-- #msg-two -->

  <div id="unique-ip">
    <div class="msg-bkg">
      <div class="inside-msg-one">
        <i class="far fa-times-circle"></i>
        <h1>Unique IP's</h1>

        <p id="msg-uni-ipz"></p>

      </div><!-- .inside-msg-one -->
    </div><!-- .msg-bkg -->
  </div><!-- #msg-two -->

  <div id="individual-interactions">
    <div class="msg-bkg">
      <div class="inside-msg-one">
        <i class="far fa-times-circle"></i>
        <h1>Individual Interactions</h1>

        <p>The sum of these numbers (<span id="msgb-tot-in-int"></span>) is larger than the "<span id="msgb-tot-in"></span> Interactions" at the top because it includes clicking on days in addition to meetings.</p>

      </div><!-- .inside-msg-one -->
    </div><!-- .msg-bkg -->
  </div><!-- #msg-two -->

  <div id="clean-up-ips">
    <div class="msg-bkg">
      <div class="inside-msg-one">
        <i class="far fa-times-circle"></i>
        <h1>Unique IP</h1>

        <p>This one's tricky for the moment because, since this whole thing started mid-stream, there were people already logged in and so it only shows their IP one time but they may have done something like opened a day which is an action worth keeping. I put this message here so I can use it if I want once I get this thing working correct.</p>

      </div><!-- .inside-msg-one -->
    </div><!-- .msg-bkg -->
  </div><!-- #msg-two -->
<?php } /* $layout_context === 'analytics' */ ?>

<?php if ($layout_context === 'message-board' || $layout_context === 'post-page') { ?>
  <div id="mb-notes">
    <div class="msg-bkg">
      <div class="inside-msg-one">
        <i class="far fa-times-circle"></i>
        <h1>Privacy &amp; Decorum</h1>

        <p>1. Only the first character of a User's username will be used to distinguish who is communicating. Please observe all interpretations, perceptions and sensitivities of the concept, &quot;anonymous.&quot;</p>

        <p>2. Big fat meany weenies will be 86'd outta here faster than you should have been that time you did that stupid thing that you now mildly or perhaps, deeply, regret.</p>

      </div><!-- .inside-msg-one -->
    </div><!-- .msg-bkg -->
  </div><!-- #msg-two -->

  <div id="gottajoin">
    <div class="msg-bkg">
      <div class="inside-msg-one">
        <i class="far fa-times-circle"></i>
        <h1>Gotta join to participate</h1>

        <p>If just any random Internet surfer were let loose to post can you imagine the chaos? The mayhem? The bedlam, the fracas AND the discombobulation?!</p>

        <p>No sir (or ma'am). You need to be logged in to bring that kind of heat. You can look at the menu, but you just can't eat. You can feel the cushions, but you can't have a seat...</p>

        <p class="info-links"> 
          <a class="extras" href="login.php">Login</a>
          <a class="extras" href="signup.php">Join</a>
        </p>

      </div><!-- .inside-msg-one -->
    </div><!-- .msg-bkg -->
  </div><!-- #msg-two -->

<?php } /* $layout_context === 'message-board' || $layout_context === 'post-page' */ ?>

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