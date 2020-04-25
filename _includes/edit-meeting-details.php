<?php

/*  We open to this page because it sets all the fields with information already in the db because we're editing a record that already exists. if the user wants to make any changes I'll submit to manage_update.php because that maintains the $_POST values and validation can begin.

*/

?>
<div class="meeting-details">

	<form id="manage-mtg" action="manage_update.php?id=<?= h(u($row['id_mtg'])); ?>" method="post">
		<div class="top-info">
			<p class="days-held">Group name</p>

			<input type="text" class="mtg-update group-name<?php if (isset($errors['group_name'])) { echo " fixerror"; } ?>" name="group_name" value="<?= h($row['group_name']); ?>" placeholder="Group name">

			<p class="days-held">Day(s) meeting is held</p>
	<div class="align-days<?php if (isset($errors['sun'])) {
				echo " fixerror"; } ?>">
	<div>	
		<input type="hidden" name="sun" value="0">	
		<label><input type="checkbox" name="sun" value="1" <?php if ($row['sun'] != 0) { echo "checked"; } ?> /> <span>Sunday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="mon" value="0">
		<label><input type="checkbox" name="mon" value="1" <?php if ($row['mon'] != 0) { echo "checked"; } ?> /> <span>Monday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="tue" value="0">
		<label><input type="checkbox" name="tue" value="1" <?php if ($row['tue'] != 0) { echo "checked"; } ?> /> <span>Tuesday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="wed" value="0">
		<label><input type="checkbox" name="wed" value="1" <?php if ($row['wed'] != 0) { echo "checked"; } ?> /> <span>Wednesday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="thu" value="0">
		<label><input type="checkbox" name="thu" value="1" <?php if ($row['thu'] != 0) { echo "checked"; } ?> /> <span>Thursday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="fri" value="0">
		<label><input type="checkbox" name="fri" value="1" <?php if ($row['fri'] != 0) { echo "checked"; } ?> /> <span>Friday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="sat" value="0">
		<label><input type="checkbox" name="sat" value="1" <?php if ($row['sat'] != 0) { echo "checked"; } ?> /> <span>Saturday</span></label>
	</div>
</div><!-- .align-days -->
<p class="time-held">Time</p>
<div class="mtg-time">			
	<input type="text" name="mtgHour" class="mtg-time" value="<?php if ((isset($row['meet_time']))) { echo substr($row['meet_time'], 0, 2); } ?>"> : 

	<input type="text" name="mtgMinute" class="mtg-time" value ="<?php if ((isset($row['meet_time']))) { echo substr($row['meet_time'], -2); } ?>">&nbsp;&nbsp; 

		<label><input type="radio" name="am_pm" value="0" <?php
		 if (isset($row['am_pm']) && ($row['am_pm'] == 0)) { echo "checked"; } ?>> <span>AM </span></label> &nbsp;|&nbsp; <label><input type="radio" name="am_pm" value="1" <?php if (isset($row['am_pm']) && ($row['am_pm'] == 1)) { echo "checked"; } ?>> <span> PM</span></label>
</div>

		</div><!-- .top-info -->
		<div class="details-left">
			<label for="meet_phone">Phone number</label>
			<input type="text" class="mtg-update" name="meet_phone" value="<?php

			if (isset($row['meet_phone']) && ($row['meet_phone'] != "")) { 
				echo  "(" .substr(h($row['meet_phone']), 0, 3).") ".substr(h($row['meet_phone']), 3, 3)."-".substr(h($row['meet_phone']),6); } ?>" placeholder="10-digit phone #">

			<label for="meet_id">ID number</label>
			<input type="text" class="mtg-update" name="meet_id" value="<?= $row['meet_id']; ?>" placeholder="ID Number">
			<label for="meet_pswd">Password</label>
			<input type="text" class="mtg-update" name="meet_pswd" value="<?= $row['meet_pswd']; ?>" placeholder="Password">

			<label for="meet_url">Meeting URL</label>
			<textarea name="meet_url" id="meeturl" placeholder="https://zoom-address-here/"><?= $row['meet_url']; ?></textarea>

			</div><!-- .details-left -->
			<div class="details-right">
				<p class="add-info">Select all that apply</p>

	<input type="hidden" name="dedicated_om" value="0">			
	<label><input type="checkbox" name="dedicated_om" <?php if (isset($row['dedicated_om']) && ($row['dedicated_om'] != 0)) { echo "checked"; } ?> value="1" /> <span>Dedicated Online Meeting</span></label>
		
	<input type="hidden" name="code_o" value="0">			
	<label><input type="checkbox" name="code_o" class="omw oc" <?php if (isset($row['code_o']) && ($row['code_o'] != 0)) { echo "checked"; } ?> value="1" /> <span>Open: Anyone may attend</span></label>

	<input type="hidden" name="code_w" value="0">
	<label><input type="checkbox" name="code_w" class="omw" <?php if (isset($row['code_w']) && ($row['code_w'] != 0)) { echo "checked"; } ?> value="1" /> <span>Women's Meeting</span></label>

	<input type="hidden" name="code_m" value="0">
	<label><input type="checkbox" name="code_m" class="omw" <?php if (isset($row['code_m']) && ($row['code_m'] != 0)) { echo "checked"; } ?> value="1" /> <span>Men's Meeting</span></label>

	<input type="hidden" name="code_c" value="0">
	<label><input type="checkbox" name="code_c" class="oc" <?php if (isset($row['code_c']) && ($row['code_c'] != 0)) { echo "checked"; } ?> value="1" /> <span>Closed Meeting</span></label>

	<input type="hidden" name="code_beg" value="0">
	<label><input type="checkbox" name="code_beg" <?php if (isset($row['code_beg']) && ($row['code_beg'] != 0)) { echo "checked"; } ?> value="1" /> <span>Beginner's Meeting</span></label>

	<input type="hidden" name="code_h" value="0">
	<label><input type="checkbox" name="code_h" <?php if (isset($row['code_h']) && ($row['code_h'] != 0)) { echo "checked"; } ?> value="1" /> <span>Handicap</span></label>	

	<input type="hidden" name="code_d" value="0">
	<label><input type="checkbox" name="code_d" <?php if (isset($row['code_d']) && ($row['code_d'] != 0)) { echo "checked"; } ?> value="1" /> <span>Discussion Meeting</span></label>

	<input type="hidden" name="code_b" value="0">
	<label><input type="checkbox" name="code_b" <?php if (isset($row['code_b']) && ($row['code_b'] != 0)) { echo "checked"; } ?> value="1" /> <span>Book Study</span></label>

	<input type="hidden" name="code_ss" value="0">
	<label><input type="checkbox" name="code_ss" <?php if (isset($row['code_ss']) && ($row['code_ss'] != 0)) { echo "checked"; } ?> value="1" /> <span>Step Study</span></label>

	<input type="hidden" name="code_sp" value="0">
	<label><input type="checkbox" name="code_sp" <?php if (isset($row['code_sp']) && ($row['code_sp'] != 0)) { echo "checked"; } ?> value="1" /> <span>Guest Speaker</span></label>

	<input type="hidden" name="month_speaker" value="0">
	<label><input type="checkbox" name="month_speaker" <?php if (isset($row['month_speaker']) && ($row['month_speaker'] != 0)) { echo "checked"; } ?> value="1" /> <span>Monthly Speaker</span></label>

	<input type="hidden" name="potluck" value="0">
	<label><input type="checkbox" name="potluck" <?php if (isset($row['potluck']) && ($row['potluck'] != 0)) { echo "checked"; } ?> value="1" /> <span>Potluck</span></label>
			
	</div><!-- .details-right -->
	<div class="btm-notes">
		<label for="add_note">Additional notes</label>
		<textarea name="add_note" class="meetNotes"><?= h($row['add_note']); ?></textarea>

		<div class="update-rt">
			<a class="cancel" href="manage.php">CANCEL</a> <input type="submit" name="update-mtg" class="submit" value="UPDATE MEETING">
		</div>
	</div><!-- .btm-notes -->
</form>

</div><!-- .meeting-details -->