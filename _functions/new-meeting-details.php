
<div class="meeting-details">

	<form id="manage-mtg" action="" method="post">
		<div class="top-info">
			<p class="days-held">Group name</p>

			<input type="text" class="mtg-update group-name" name="groupname" value="<?= $groupname ?>" placeholder="Group name">

	
			<p class="days-held">Day(s) meeting is held</p>
	<div class="align-days">
	<div>	
		<input type="hidden" name="sun" value="0">	
		<label><input type="checkbox" name="sun" value="1" <?php if (isset($sun) && ($sun != 0)) { echo "checked"; } ?> /> <span>Sunday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="mon" value="0">
		<label><input type="checkbox" name="mon" value="1" <?php if (isset($mon) && ($mon != 0)) { echo "checked"; } ?> /> <span>Monday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="tue" value="0">
		<label><input type="checkbox" name="tue" value="1" <?php if (isset($tue) && ($tue != 0)) { echo "checked"; } ?> /> <span>Tuesday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="wed" value="0">
		<label><input type="checkbox" name="wed" value="1" <?php if (isset($wed) && ($wed != 0)) { echo "checked"; } ?> /> <span>Wednesday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="thu" value="0">
		<label><input type="checkbox" name="thu" value="1" <?php if (isset($thu) && ($thu != 0)) { echo "checked"; } ?> /> <span>Thursday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="fri" value="0">
		<label><input type="checkbox" name="fri" value="1" <?php if (isset($fri) && ($fri != 0)) { echo "checked"; } ?> /> <span>Friday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="sat" value="0">
		<label><input type="checkbox" name="sat" value="1" <?php if (isset($sat) && ($sat != 0)) { echo "checked"; } ?> /> <span>Saturday</span></label>
	</div>
</div><!-- .align-days -->
			<p class="time-held">Time</p>
<div class="mtg-time">			
	<input type="text" name="mtgHour" class="mtg-time" value="<?php if ($time != null) { echo substr(h($time), 0, 2); } ?>" placeholder="12"> : <input type="text" name="mtgMinute" class="mtg-time" value ="<?php if ($time != null) {
		echo substr(h($time), -2); } ?>" placeholder="00">&nbsp;&nbsp; <label><input type="radio" name="ampm" value="0" <?php
	 if (isset($ampm) && ($ampm == 0)) { echo "checked"; } ?>> <span>AM </span></label> &nbsp;|&nbsp; <label><input type="radio" name="ampm" value="1" <?php if (isset($ampm) && ($ampm == 1)) { echo "checked"; } ?>> <span> PM</span></label>
</div>

		</div><!-- .top-info -->
		<div class="details-left">
			<label for="phone">Phone number</label>
			<input type="text" class="mtg-update" name="phone" value="<?php

			if (isset($phone) && ($phone != "")) { 
				echo  "(" .substr(h($phone), 0, 3).") ".substr(h($phone), 3, 3)."-".substr(h($phone),6); } ?>" placeholder="10-digit phone #">

			<label for="idnum">ID number</label>
			<input type="text" class="mtg-update" name="idnum" value="<?= $idnum ?>" placeholder="ID Number">
			<label for="meetingpswd">Password</label>
			<input type="text" class="mtg-update" name="meetingpswd" value="<?= $meetingpswd ?>" placeholder="Password">

			<label for="meeturl">Meeting URL</label>
			<textarea name="meeturl" id="meeturl" placeholder="http://zoom-address-here/"><?php // $meeturl ?></textarea>

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

	<label for="addnotes">Additional notes</label>
	<textarea name="addnotes" class="meetNotes" placeholder="Do you need to add something important to this meeting? If so, put it here. If not, skip this."><?php

	if ($addnotes != "") { echo h($addnotes); } ?></textarea>

	<div class="update-rt">
		<input type="submit" name="create-mtg" class="submit" value="POST MEETING">
	</div>

</form>

</div><!-- .meeting-details -->