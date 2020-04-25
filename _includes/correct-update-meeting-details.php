<?php

/* this page is to cycle through vlidation until everything is correct and should therefore use $_POST variables. once it passes it is processed via manage-update.php and redirected to manage_edit_review.php

this page, therefore, needs to retain $_POST variables because information is not leaving here until it passes at which point all $_POST variables will be assigned to $row variables.  */

?>
<div class="meeting-details">

	<form id="manage-mtg" action="" method="post">
		<div class="top-info">
			<p class="days-held">Group name</p>

			<input type="text" class="mtg-update group-name<?php if (isset($errors['group_name'])) { echo " fixerror"; } ?>" name="group_name" value="<?= h($row['group_name']); ?>" placeholder="Group name">

			<p class="days-held">Day(s) meeting is held</p>
	<div class="align-days<?php if (isset($errors['sun'])) {
				echo " fixerror"; } ?>">
	<div>	
		<input type="hidden" name="sun" value="0">	
		<label><input type="checkbox" name="sun" value="1" <?php if ($_POST['sun'] != 0) { echo "checked"; } ?> /> <span>Sunday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="mon" value="0">
		<label><input type="checkbox" name="mon" value="1" <?php if ($_POST['mon'] != 0) { echo "checked"; } ?> /> <span>Monday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="tue" value="0">
		<label><input type="checkbox" name="tue" value="1" <?php if ($_POST['tue'] != 0) { echo "checked"; } ?> /> <span>Tuesday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="wed" value="0">
		<label><input type="checkbox" name="wed" value="1" <?php if ($_POST['wed'] != 0) { echo "checked"; } ?> /> <span>Wednesday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="thu" value="0">
		<label><input type="checkbox" name="thu" value="1" <?php if ($_POST['thu'] != 0) { echo "checked"; } ?> /> <span>Thursday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="fri" value="0">
		<label><input type="checkbox" name="fri" value="1" <?php if ($_POST['fri'] != 0) { echo "checked"; } ?> /> <span>Friday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="sat" value="0">
		<label><input type="checkbox" name="sat" value="1" <?php if ($_POST['sat'] != 0) { echo "checked"; } ?> /> <span>Saturday</span></label>
	</div>
</div><!-- .align-days -->
<p class="time-held">Time</p>
<div class="mtg-time">		







	<?php /* this is where the magic will happen 

	So far, after hitting "edit" we went to > 
	manage-edit.php which populates with >
	edit-meeting-details so that the fields are filled with db values. if a change is made it submits to > 
	manage-update which populates with > 
	correct-update-meeting-details.php so the fields are set to $_POST values now.

	this is where we are now - trying to get meet_time to = 4-digits in military time so we can sort by time...



	*/ ?>
	<input type="text" name="meet_time" value="<?php if (($_POST['am_pm'] == 1) && ($_POST['mtgHour'] < 12)) { $meet_time = (($_POST['mtgHour'] + 12) . $_POST['mtgMinute']); echo $meet_time;  } ?>">








	<input type="text" name="mtgHour" class="mtg-time<?php if (isset($errors['mtgHour'])) { echo " fixerror"; } ?>" value="<?= $_POST['mtgHour']; ?>"> : 

	<input type="text" name="mtgMinute" class="mtg-time <?php if (isset($errors['mtgMinute'])) { echo "fixerror"; } ?>" value ="<?= $_POST['mtgMinute']; ?>">&nbsp;&nbsp; 

	<span class="<?php if (isset($errors['am_pm'])) { echo " fixerror"; } ?>">
		<label><input type="radio" name="am_pm" value="0" <?php
		 if (isset($_POST['am_pm']) && ($_POST['am_pm'] == 0)) { echo "checked"; } ?>> <span>AM </span></label> &nbsp;|&nbsp; <label><input type="radio" name="am_pm" value="1" <?php if (isset($_POST['am_pm']) && ($_POST['am_pm'] == 1)) { echo "checked"; } ?>> <span> PM</span></label>
		</span>
</div>

		</div><!-- .top-info -->
		<div class="details-left">
			<label for="meet_phone">Phone number</label>
			<input type="text" class="mtg-update" name="meet_phone" value="<?php

			if (isset($_POST['meet_phone']) && ($_POST['meet_phone'] != "")) { 
				echo  "(" .substr(h($_POST['meet_phone']), 0, 3).") ".substr(h($_POST['meet_phone']), 3, 3)."-".substr(h($_POST['meet_phone']),6); } ?>" placeholder="10-digit phone #">

			<label for="meet_id">ID number</label>
			<input type="text" class="mtg-update" name="meet_id" value="<?= $_POST['meet_id']; ?>" placeholder="ID Number">
			<label for="meet_pswd">Password</label>
			<input type="text" class="mtg-update" name="meet_pswd" value="<?= $_POST['meet_pswd']; ?>" placeholder="Password">

			<label for="meet_url">Meeting URL</label>
			<textarea name="meet_url" id="meeturl" placeholder="https://zoom-address-here/"><?= $_POST['meet_url']; ?></textarea>

			</div><!-- .details-left -->
			<div class="details-right">
				<p class="add-info">Select all that apply</p>

	<input type="hidden" name="dedicated_om" value="0">			
	<label><input type="checkbox" name="dedicated_om" <?php if (isset($_POST['dedicated_om']) && ($_POST['dedicated_om'] != "0")) { echo "checked"; } ?> value="1" /> <span>Dedicated Online Meeting</span></label>
		
	<input type="hidden" name="code_o" value="0">			
	<label><input type="checkbox" name="code_o" class="omw oc" <?php if (isset($_POST['code_o']) && ($_POST['code_o'] != 0)) { echo "checked"; } ?> value="1" /> <span>Open: Anyone may attend</span></label>

	<input type="hidden" name="code_w" value="0">
	<label><input type="checkbox" name="code_w" class="omw" <?php if (isset($_POST['code_w']) && ($_POST['code_w'] != 0)) { echo "checked"; } ?> value="1" /> <span>Women's Meeting</span></label>

	<input type="hidden" name="code_m" value="0">
	<label><input type="checkbox" name="code_m" class="omw" <?php if (isset($_POST['code_m']) && ($_POST['code_m'] != 0)) { echo "checked"; } ?> value="1" /> <span>Men's Meeting</span></label>

	<input type="hidden" name="code_c" value="0">
	<label><input type="checkbox" name="code_c" class="oc" <?php if (isset($_POST['code_c']) && ($_POST['code_c'] != 0)) { echo "checked"; } ?> value="1" /> <span>Closed Meeting</span></label>

	<input type="hidden" name="code_beg" value="0">
	<label><input type="checkbox" name="code_beg" <?php if (isset($_POST['code_beg']) && ($_POST['code_beg'] != 0)) { echo "checked"; } ?> value="1" /> <span>Beginner's Meeting</span></label>

	<input type="hidden" name="code_h" value="0">
	<label><input type="checkbox" name="code_h" <?php if (isset($_POST['code_h']) && ($_POST['code_h'] != 0)) { echo "checked"; } ?> value="1" /> <span>Handicap</span></label>	

	<input type="hidden" name="code_d" value="0">
	<label><input type="checkbox" name="code_d" <?php if (isset($_POST['code_d']) && ($_POST['code_d'] != 0)) { echo "checked"; } ?> value="1" /> <span>Discussion Meeting</span></label>

	<input type="hidden" name="code_b" value="0">
	<label><input type="checkbox" name="code_b" <?php if (isset($_POST['code_b']) && ($_POST['code_b'] != 0)) { echo "checked"; } ?> value="1" /> <span>Book Study</span></label>

	<input type="hidden" name="code_ss" value="0">
	<label><input type="checkbox" name="code_ss" <?php if (isset($_POST['code_s']) && ($_POST['code_s'] != 0)) { echo "checked"; } ?> value="1" /> <span>Step Study</span></label>

	<input type="hidden" name="code_sp" value="0">
	<label><input type="checkbox" name="code_sp" <?php if (isset($_POST['code_sp']) && ($_POST['code_sp'] != 0)) { echo "checked"; } ?> value="1" /> <span>Guest Speaker</span></label>

	<input type="hidden" name="month_speaker" value="0">
	<label><input type="checkbox" name="month_speaker" <?php if (isset($_POST['month_speaker']) && ($_POST['month_speaker'] != 0)) { echo "checked"; } ?> value="1" /> <span>Monthly Speaker</span></label>

	<input type="hidden" name="potluck" value="0">
	<label><input type="checkbox" name="potluck" <?php if (isset($_POST['potluck']) && ($_POST['potluck'] != 0)) { echo "checked"; } ?> value="1" /> <span>Potluck</span></label>
			
	</div><!-- .details-right -->
	<div class="btm-notes">
		<label for="add_note">Additional notes</label>
		<textarea name="add_note" class="meetNotes"><?= h($_POST['add_note']); ?></textarea>

		<div class="update-rt">
			<a class="cancel" href="manage.php">CANCEL</a> <input type="submit" name="create-mtg" class="submit" value="UPDATE MEETING">
		</div><!-- .update-rt -->
	</div><!-- .btm-notes -->

</form>

</div><!-- .meeting-details -->