
<div class="meeting-details">
	<p class="mtg-tz">Your current timezone is set to: <a id="show-tz" class="inline-show-tz"><?php pretty_tz($tz); ?></a>.</p>
	<form id="manage-mtg" action="" method="post" enctype="multipart/form-data">
		<div class="top-info">
			<p class="days-held">Group | Meeting name</p>

			<input type="text" class="mtg-update group-name<?php if (isset($errors['group_name'])) { echo " fixerror"; } ?>" name="group_name" value="<?php if (isset($_POST['group_name'])) { echo $_POST['group_name']; } ?>" placeholder="Highly Sober Society of Potato People">

			<p class="days-held">Day(s) meeting is held</p>
	<div class="align-days<?php if (isset($errors['pick_a_day'])) {
				echo " fixerror"; } ?>">
	<div>	
		<input type="hidden" name="sun" value="0">	
		<label><input type="checkbox" name="sun" value="1" <?php if ((isset($row['sun']) && ($row['sun'])) != 0) { echo "checked"; } ?> /> <span>Sunday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="mon" value="0">
		<label><input type="checkbox" name="mon" value="1" <?php if ((isset($row['mon']) && ($row['mon'])) != 0) { echo "checked"; } ?> /> <span>Monday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="tue" value="0">
		<label><input type="checkbox" name="tue" value="1" <?php if ((isset($row['tue']) && ($row['tue'])) != 0) { echo "checked"; } ?> /> <span>Tuesday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="wed" value="0">
		<label><input type="checkbox" name="wed" value="1" <?php if ((isset($row['wed']) && ($row['wed'])) != 0) { echo "checked"; } ?> /> <span>Wednesday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="thu" value="0">
		<label><input type="checkbox" name="thu" value="1" <?php if ((isset($row['thu']) && ($row['thu'])) != 0) { echo "checked"; } ?> /> <span>Thursday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="fri" value="0">
		<label><input type="checkbox" name="fri" value="1" <?php if ((isset($row['fri']) && ($row['fri'])) != 0) { echo "checked"; } ?> /> <span>Friday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="sat" value="0">
		<label><input type="checkbox" name="sat" value="1" <?php if ((isset($row['sat']) && ($row['sat'])) != 0) { echo "checked"; } ?> /> <span>Saturday</span></label>
	</div>
</div><!-- .align-days -->

<div class="mtg-time-tm">	
  <p class="time-held">Time</p>
	<input name="meet_time" class="timepicker<?php if (isset($errors['meet_time'])) { echo " fixerror"; } ?>" value="<?php if (isset($row['meet_time']) && $row['meet_time'] !== 'nofrickinway') { echo $row['meet_time']; } ?>">
</div>

<div class="mtg-time-tz">  
  <p class="time-held">Timezone</p>
  <?php if (isset($row['mtg_tz'])) { $mtgtz = $row['mtg_tz']; } else { $mtgtz = $tz; } ?>
  <select class="pick-tz<?php if (isset($errors['mtg_tz'])) { echo ' tzerr'; } ?>" name="mtg-tz"><option class="<?php if (isset($errors['mtg_tz'])) { echo 'tzerr'; } ?>" value="empty"><?php echo timezone_select_options($mtgtz); ?></option></select>
</div>

</div><!-- .top-info -->
<div class="details-left">
	<label for="meet_phone">Phone number <a id="toggle-yer-phone-num"><i class="far fa-question-circle fa-fw"></i></a></label>
	<input type="text" class="mtg-update<?php if (isset($errors['meet_phone'])) { echo " fixerror"; } ?>" name="meet_phone" value="<?php

	if (isset($row['meet_phone']) && ($row['meet_phone'] != "")) { 
		echo  "(" .substr(h($row['meet_phone']), 0, 3).") ".substr(h($row['meet_phone']), 3, 3)."-".substr(h($row['meet_phone']),6); } ?>" placeholder="10-digit phone #">

	<label for="one_tap">One Tap Mobile <a id="toggle-one-tap-msg"><i class="far fa-question-circle fa-fw"></i></a></label>
	<input type="text" class="mtg-update<?php if (isset($errors['one_tap'])) { echo " fixerror"; } ?>" name="one_tap" value="<?php if (isset($row['one_tap'])) { echo h($row['one_tap']); } ?>" placeholder="One Tap Mobile #">

	<label for="meet_id">ID number</label>
	<input type="text" class="mtg-update<?php if (isset($errors['meet_id'])) { echo " fixerror"; } ?>" name="meet_id" value="<?php if (isset($row['meet_id'])) { echo h($row['meet_id']); } ?>" placeholder="ID Number">

	<label for="meet_pswd">Password</label>
	<input type="text" class="mtg-update<?php if (isset($errors['meet_pswd'])) { echo " fixerror"; } ?>" name="meet_pswd" value="<?php if (isset($row['meet_pswd'])) { echo h($row['meet_pswd']); } ?>" placeholder="Password">

	<label for="meet_url">Online URL</label>
	<textarea name="meet_url" id="meet_url" class="<?php if (isset($errors['meet_url'])) { echo " fixerror"; } ?>" placeholder="https://zoom-address-here/"><?php if (isset($row['meet_url'])) { echo h($row['meet_url']); } ?></textarea>

	<label for="meet_addr">Physical Address | lat°, long° accepted <a id="toggle-lat-long-msg"><i class="far fa-question-circle fa-fw"></i></a></label>
	<textarea name="meet_addr" id="meet_addr" class="<?php if (isset($errors['meet_url']) || isset($errors['url_and_phy'])) { echo " fixerror"; } ?>" placeholder="123 Main St, Evergreen, CO"><?php if (isset($row['meet_addr'])) { echo h($row['meet_addr']); } ?></textarea>

	<label for="meet_desc">Descriptive Location <a id="toggle-descriptive-location"><i class="far fa-question-circle fa-fw"></i></a></label>
	<textarea name="meet_desc" id="meet_desc" placeholder="123 Main St.&#10;Evergreen, CO&#10;Around back, 2nd floor"><?php if (isset($row['meet_desc'])) { h($row['meet_desc']); } ?></textarea>

	</div><!-- .details-left -->
	<div class="details-right<?php if (isset($errors['meeting_type']) || isset($errors['url_or_phy'])) { echo " fixerror"; } ?>">
		<p class="add-info<?php if (isset($errors['meeting_type']) || isset($errors['url_or_phy']) || isset($errors['url_and_phy'])) { echo " fixerror"; } ?>">Select all that apply</p>

	<input type="hidden" name="dedicated_om" value="0">			
	<label><input type="checkbox" name="dedicated_om" <?php if (isset($row['dedicated_om']) && $row['dedicated_om'] == "1") { echo "checked"; } ?> value="1" /> <span>Dedicated Online Meeting</span></label>
		
	<input type="hidden" name="code_o" value="0">			
	<label><input type="checkbox" name="code_o" class="omw oc" <?php if (isset($row['code_o']) && $row['code_o'] == "1") { echo "checked"; } ?> value="1" /> <span>Open: Anyone may attend</span></label>

	<input type="hidden" name="code_w" value="0">
	<label><input type="checkbox" name="code_w" class="omw" <?php if (isset($row['code_w']) && $row['code_w'] == "1") { echo "checked"; } ?> value="1" /> <span>Women's Meeting</span></label>

	<input type="hidden" name="code_m" value="0">
	<label><input type="checkbox" name="code_m" class="omw" <?php if (isset($row['code_m']) && $row['code_m'] == "1") { echo "checked"; } ?> value="1" /> <span>Men's Meeting</span></label>

	<input type="hidden" name="code_c" value="0">
	<label><input type="checkbox" name="code_c" class="oc" <?php if (isset($row['code_c']) && $row['code_c'] == "1") { echo "checked"; } ?> value="1" /> <span>Closed Meeting</span></label>

	<input type="hidden" name="code_beg" value="0">
	<label><input type="checkbox" name="code_beg" <?php if (isset($row['code_beg']) && $row['code_beg'] == "1") { echo "checked"; } ?> value="1" /> <span>Beginner's Meeting</span></label>

	<input type="hidden" name="code_h" value="0">
	<label><input type="checkbox" name="code_h" <?php if (isset($row['code_h']) && $row['code_h'] == "1") { echo "checked"; } ?> value="1" /> <span>Handicap</span></label>	

	<input type="hidden" name="code_d" value="0">
	<label><input type="checkbox" name="code_d" <?php if (isset($row['code_d']) && $row['code_d'] == "1") { echo "checked"; } ?> value="1" /> <span>Discussion Meeting</span></label>

	<input type="hidden" name="code_b" value="0">
	<label><input type="checkbox" name="code_b" <?php if (isset($row['code_b']) && $row['code_b'] == "1") { echo "checked"; } ?> value="1" /> <span>Book Study</span></label>

	<input type="hidden" name="code_ss" value="0">
	<label><input type="checkbox" name="code_ss" <?php if (isset($row['code_ss']) && $row['code_ss'] == "1") { echo "checked"; } ?> value="1" /> <span>Step Study</span></label>

	<input type="hidden" name="code_sp" value="0">
	<label><input type="checkbox" name="code_sp" <?php if (isset($row['code_sp']) && $row['code_sp'] == "1") { echo "checked"; } ?> value="1" /> <span>Speaker Meeting</span></label>

	<input type="hidden" name="month_speaker" value="0">
	<label><input type="checkbox" name="month_speaker" <?php if (isset($row['month_speaker']) && $row['month_speaker'] == "1") { echo "checked"; } ?> value="1" /> <span>Speaker Meeting on last Sunday of month</span></label>

	<input type="hidden" name="potluck" value="0">
	<label><input type="checkbox" name="potluck" <?php if (isset($row['potluck']) && $row['potluck'] == "1") { echo "checked"; } ?> value="1" /> <span>Potluck</span></label>
			
	</div><!-- .details-right -->
	<div class="btm-notes">



<div class="file-uploads">
	<p>Upload PDF Files <a id="toggle-pdf-info"><i class="far fa-question-circle fa-fw"></i></a></p>

	<div id="pdf1" class="pdf-wrap pdf1<?php if (isset($errors['name_link1'])) { echo " fixerror"; } ?>">
		<div class="pdf-row">
			<input type="file" class="pdf1_name" id="file1" name="file1" accept=".pdf"> <label class="pdf-label">Link 1 label <input type="text" class="pdf1_name" name="link1" value="<?php if (isset($row['link1'])) { echo trim(h($row['link1']) ?? ''); } ?>" maxlength="25"> <a id="toggle-link-label"><i class="far fa-question-circle fa-fw"></i></a></label>
		</div>
		<div class="pdf-remove">
			<a class="pdf-remove pdf-remove-1">Remove</a>
		</div>
	</div>

	<div id="pdf2" class="pdf-wrap pdf2<?php if (isset($errors['name_link2'])) { echo " fixerror"; } ?>">
		<div class="pdf-row">
			<input type="file" class="pdf2_name" id="file2" name="file2" accept=".pdf"> <label class="pdf-label">Link 2 label <input type="text" class="pdf2_name" name="link2" value="<?php if (isset($row['link2'])) { echo trim(h($row['link2']) ?? ''); } ?>" maxlength="25"></label>
		</div>
		<div class="pdf-remove">
			<a class="pdf-remove pdf-remove-2">Remove</a>
		</div>
	</div>		

	<div id="pdf3" class="pdf-wrap pdf3<?php if (isset($errors['name_link3'])) { echo " fixerror"; } ?>">
		<div class="pdf-row">
			<input type="file" class="pdf3_name" id="file3" name="file3" accept=".pdf"> <label class="pdf-label">Link 3 label <input type="text" class="pdf3_name" name="link3" value="<?php if (isset($row['link3'])) { echo trim(h($row['link3']) ?? ''); } ?>" maxlength="25"></label>
		</div>
		<div class="pdf-remove">
			<a class="pdf-remove pdf-remove-3">Remove</a>
		</div>
	</div>		

	<div id="pdf4" class="pdf-wrap pdf4<?php if (isset($errors['name_link4'])) { echo " fixerror"; } ?>">
		<div class="pdf-row">
			<input type="file" class="pdf4_name" id="file4" name="file4" accept=".pdf"> <label class="pdf-label">Link 4 label <input type="text" class="pdf4_name" name="link4" value="<?php if (isset($row['link4'])) { echo trim(h($row['link4']) ?? ''); } ?>" maxlength="25"></label>
		</div>
		<div class="pdf-remove">
			<a class="pdf-remove pdf-remove-4">Remove</a>
		</div>
	</div>

	<a id="file-upload"><i class="far fa-plus-square fa-fw"></i> Add a PDF | 4 Total</a>

</div>

		<label for="add_note">Additional notes</label>
		<textarea name="add_note" class="meetNotes<?php if (isset($errors['add_note'])) { echo " fixerror"; } ?>" placeholder="Text only. 1,000 characters or less. All formatting will be stripped."><?php if (isset($row['add_note']) && $row['add_note'] != '') { echo nl2br(h($row['add_note'])); } ?></textarea>

    <input type="hidden" id="ctpg-hf" name="ctpg-hf" value="notset">
    <input type="hidden" id="themeurl" name="themeurl">
		<div class="update-rt">
			<a class="cancel" href="manage.php">CANCEL</a> <input type="submit" id="review-mtg" name="review-mtg" class="submit" value="REVIEW">
		</div><!-- .update-rt -->
	</div><!-- .btm-notes -->

</form>

</div><!-- .meeting-details -->
