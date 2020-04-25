
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
	<input type="text" name="mtgHour" class="mtg-time<?php if (isset($errors['mtgHour'])) { echo " fixerror"; } ?>" value="<?php if ((isset($_POST['mtgHour'])) && ($_POST['mtgHour'] != 00)) { echo preg_replace('/[^0-9]/', '', str_pad($_POST['mtgHour'], 2, '0', STR_PAD_LEFT)); } ?>"> : 

	<input type="text" name="mtgMinute" class="mtg-time <?php if (isset($errors['mtgMinute'])) { echo "fixerror"; } ?>" value ="<?php if ((isset($_POST['mtgMinute'])) && ($_POST['mtgMinute'] != 00)) { echo preg_replace('/[^0-9]/', '', str_pad($_POST['mtgMinute'], 2, '0', STR_PAD_LEFT)); } ?>">&nbsp;&nbsp; 

	<span class="<?php if (isset($errors['am_pm'])) { echo " fixerror"; } ?>">
		<label><input type="radio" name="am_pm" value="0" <?php
		 if (!isset($row['am_pm']) && ($row['am_pm'] == 0)) { echo "checked"; } ?>> <span>AM </span></label> &nbsp;|&nbsp; <label><input type="radio" name="am_pm" value="1" <?php if (isset($row['am_pm']) && ($row['am_pm'] == 1)) { echo "checked"; } ?>> <span> PM</span></label>
		</span>
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

			<label for="meeturl">Meeting URL</label>
			<textarea name="meeturl" id="meeturl" placeholder="https://zoom-address-here/"><?php // $meeturl ?></textarea>

			</div><!-- .details-left -->
			<div class="details-right">
				<p class="add-info">Select all that apply</p>

	<input type="hidden" name="dedicated_om" value="0">			
	<label><input type="checkbox" name="dedicated_om" <?php if (isset($dedicated_om) && ($dedicated_om != 0)) { echo "checked"; } ?> value="1" /> <span>Dedicated Online Meeting</span></label>
		
	<input type="hidden" name="code_o" value="0">			
	<label><input type="checkbox" name="code_o" class="omw oc" <?php if (isset($code_o) && ($code_o != 0)) { echo "checked"; } ?> value="1" /> <span>Open: Anyone may attend</span></label>

	<input type="hidden" name="code_w" value="0">
	<label><input type="checkbox" name="code_w" class="omw" <?php if (isset($code_w) && ($code_w != 0)) { echo "checked"; } ?> value="1" /> <span>Women's Meeting</span></label>

	<input type="hidden" name="code_m" value="0">
	<label><input type="checkbox" name="code_m" class="omw" <?php if (isset($code_m) && ($code_m != 0)) { echo "checked"; } ?> value="1" /> <span>Men's Meeting</span></label>

	<input type="hidden" name="code_c" value="0">
	<label><input type="checkbox" name="code_c" class="oc" <?php if (isset($code_c) && ($code_c != 0)) { echo "checked"; } ?> value="1" /> <span>Closed Meeting</span></label>

	<input type="hidden" name="code_beg" value="0">
	<label><input type="checkbox" name="code_beg" <?php if (isset($code_beg) && ($code_beg != 0)) { echo "checked"; } ?> value="1" /> <span>Beginner's Meeting</span></label>

	<input type="hidden" name="code_h" value="0">
	<label><input type="checkbox" name="code_h" <?php if (isset($code_h) && ($code_h != 0)) { echo "checked"; } ?> value="1" /> <span>Handicap</span></label>	

	<input type="hidden" name="code_d" value="0">
	<label><input type="checkbox" name="code_d" <?php if (isset($code_d) && ($code_d != 0)) { echo "checked"; } ?> value="1" /> <span>Discussion Meeting</span></label>

	<input type="hidden" name="code_b" value="0">
	<label><input type="checkbox" name="code_b" <?php if (isset($code_b) && ($code_b != 0)) { echo "checked"; } ?> value="1" /> <span>Book Study</span></label>

	<input type="hidden" name="code_ss" value="0">
	<label><input type="checkbox" name="code_ss" <?php if (isset($code_ss) && ($code_ss != 0)) { echo "checked"; } ?> value="1" /> <span>Step Study</span></label>

	<input type="hidden" name="code_sp" value="0">
	<label><input type="checkbox" name="code_sp" <?php if (isset($code_sp) && ($code_sp != 0)) { echo "checked"; } ?> value="1" /> <span>Guest Speaker</span></label>

	<input type="hidden" name="month_speaker" value="0">
	<label><input type="checkbox" name="month_speaker" <?php if (isset($month_speaker) && ($month_speaker != 0)) { echo "checked"; } ?> value="1" /> <span>Monthly Speaker</span></label>

	<input type="hidden" name="potluck" value="0">
	<label><input type="checkbox" name="potluck" <?php if (isset($potluck) && ($potluck != 0)) { echo "checked"; } ?> value="1" /> <span>Potluck</span></label>
			
	</div><!-- .details-right -->
	<div class="btm-notes">
		<label for="add_note">Additional notes</label>
		<textarea name="add_note" class="meetNotes" placeholder="Additional notes"><?= h($row['add_note']); ?></textarea>

		<div class="update-rt">
			<a class="cancel" href="manage.php">CANCEL</a> <input type="submit" name="update-mtg" class="submit" value="UPDATE MEETING">
		</div>
	</div><!-- .btm-notes -->
</form>

</div><!-- .meeting-details -->