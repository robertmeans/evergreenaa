
<div class="meeting-details">

	<form id="manage-mtg" action="" method="post">
		<div class="top-info">
			<p class="days-held">Group name</p>

			<input type="text" class="mtg-update group-name<?php if (isset($errors['group_name'])) { echo " fixerror"; } ?>" name="group_name" value="<?= h($row['group_name']); ?>" placeholder="Group name">

			<p class="days-held">Day(s) meeting is held</p>
	<div class="align-days<?php if (isset($errors['pick_a_day'])) {
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

	<?php /* https://timepicker.co/options/ */ ?>
	<input name="meet_time" class="timepicker<?php if (isset($errors['meet_time'])) { echo " fixerror"; } ?>" value="<?= $row['meet_time'] ?>">

</div>

</div><!-- .top-info -->
<div class="details-left">
	<label for="meet_phone">Phone number</label>
	<input type="text" class="mtg-update<?php if (isset($errors['meet_phone'])) { echo " fixerror"; } ?>" name="meet_phone" value="<?php

	if (isset($row['meet_phone']) && ($row['meet_phone'] != "")) { 
		echo  "(" .substr(h($row['meet_phone']), 0, 3).") ".substr(h($row['meet_phone']), 3, 3)."-".substr(h($row['meet_phone']),6); } ?>" placeholder="10-digit phone #">

	<label for="meet_id">ID number</label>
	<input type="text" class="mtg-update<?php if (isset($errors['meet_id'])) { echo " fixerror"; } ?>" name="meet_id" value="<?= $row['meet_id']; ?>" value="<?= h($row['meet_id']); ?>" placeholder="ID Number">

	<label for="meet_pswd">Password</label>
	<input type="text" class="mtg-update<?php if (isset($errors['meet_pswd'])) { echo " fixerror"; } ?>" name="meet_pswd" value="<?= h($row['meet_pswd']); ?>" placeholder="Password">

	<label for="meet_url">Meeting URL</label>
	<textarea name="meet_url" id="meet_url" class="<?php if (isset($errors['meet_url'])) { echo " fixerror"; } ?>" placeholder="https://zoom-address-here/"><?= h($row['meet_url']); ?></textarea>

	</div><!-- .details-left -->
	<div class="details-right<?php if (isset($errors['meeting_type'])) { echo " fixerror"; } ?>">
		<p class="add-info<?php if (isset($errors['meeting_type'])) { echo " fixerror"; } ?>">Select all that apply</p>

	<input type="hidden" name="dedicated_om" value="0">			
	<label><input type="checkbox" name="dedicated_om" <?php if ($row['dedicated_om'] == "1") { echo "checked"; } ?> value="1" /> <span>Dedicated Online Meeting</span></label>
		
	<input type="hidden" name="code_o" value="0">			
	<label><input type="checkbox" name="code_o" class="omw oc" <?php if ($row['code_o'] == "1") { echo "checked"; } ?> value="1" /> <span>Open: Anyone may attend</span></label>

	<input type="hidden" name="code_w" value="0">
	<label><input type="checkbox" name="code_w" class="omw" <?php if ($row['code_w'] == "1") { echo "checked"; } ?> value="1" /> <span>Women's Meeting</span></label>

	<input type="hidden" name="code_m" value="0">
	<label><input type="checkbox" name="code_m" class="omw" <?php if ($row['code_m'] == "1") { echo "checked"; } ?> value="1" /> <span>Men's Meeting</span></label>

	<input type="hidden" name="code_c" value="0">
	<label><input type="checkbox" name="code_c" class="oc" <?php if ($row['code_c'] == "1") { echo "checked"; } ?> value="1" /> <span>Closed Meeting</span></label>

	<input type="hidden" name="code_beg" value="0">
	<label><input type="checkbox" name="code_beg" <?php if ($row['code_beg'] == "1") { echo "checked"; } ?> value="1" /> <span>Beginner's Meeting</span></label>

	<input type="hidden" name="code_h" value="0">
	<label><input type="checkbox" name="code_h" <?php if ($row['code_h'] == "1") { echo "checked"; } ?> value="1" /> <span>Handicap</span></label>	

	<input type="hidden" name="code_d" value="0">
	<label><input type="checkbox" name="code_d" <?php if ($row['code_d'] == "1") { echo "checked"; } ?> value="1" /> <span>Discussion Meeting</span></label>

	<input type="hidden" name="code_b" value="0">
	<label><input type="checkbox" name="code_b" <?php if ($row['code_b'] == "1") { echo "checked"; } ?> value="1" /> <span>Book Study</span></label>

	<input type="hidden" name="code_ss" value="0">
	<label><input type="checkbox" name="code_ss" <?php if ($row['code_ss'] == "1") { echo "checked"; } ?> value="1" /> <span>Step Study</span></label>

	<input type="hidden" name="code_sp" value="0">
	<label><input type="checkbox" name="code_sp" <?php if ($row['code_sp'] == "1") { echo "checked"; } ?> value="1" /> <span>Guest Speaker</span></label>

	<input type="hidden" name="month_speaker" value="0">
	<label><input type="checkbox" name="month_speaker" <?php if ($row['month_speaker'] == "1") { echo "checked"; } ?> value="1" /> <span>Monthly Speaker</span></label>

	<input type="hidden" name="potluck" value="0">
	<label><input type="checkbox" name="potluck" <?php if ($row['potluck'] == "1") { echo "checked"; } ?> value="1" /> <span>Potluck</span></label>
			
	</div><!-- .details-right -->
	<div class="btm-notes">
		<label for="add_note">Additional notes</label>
		<textarea name="add_note" class="meetNotes" placeholder="Text only. 255 characters or less. All formatting will be stripped."><?= h(str_replace('\r\n', '', $row['add_note'])); ?></textarea>

		<div class="update-rt">
			<a class="cancel" href="manage.php">CANCEL</a> <input type="submit" name="create-mtg" class="submit" value="POST MEETING">
		</div><!-- .update-rt -->
	</div><!-- .btm-notes -->

</form>

</div><!-- .meeting-details -->
