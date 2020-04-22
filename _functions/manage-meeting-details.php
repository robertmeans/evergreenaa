<?php

// $mtgID = $row['id_mtg'];
if(!isset($_GET['id'])) {
	header('location: index.php');
}
$id = $_GET['id'];

// if user clicks UPDATE MEETING
if (is_post_request()) {


	$row = [];
	$row['id_mtg'] 			= $_POST['id_mtg'] ?? '';
	$row['sun'] 			= $_POST['sunday'] ?? ''; 
	$row['mon'] 			= $_POST['monday'] ?? ''; 
	$row['tue'] 			= $_POST['tuesday'] ?? ''; 
	$row['wed'] 			= $_POST['wednesday'] ?? ''; 
	$row['thu'] 			= $_POST['thursday'] ?? ''; 
	$row['fri'] 			= $_POST['friday'] ?? ''; 
	$row['sat'] 			= $_POST['saturday'] ?? ''; 
	$row['meet_time'] 		= ($_POST['mtgHour'] . $_POST['mtgMinute']) ?? '';
	$row['am_pm'] 			= $_POST['mtgAMPM'] ?? ''; 
	$row['group_name'] 		= $_POST['groupName'] ?? '';
	$row['meet_phone'] 		= preg_replace('/[^0-9]/', '', $_POST['phone']) ?? '';
	$row['meet_id'] 		= $_POST['idNum'] ?? ''; 
	$row['meet_pswd'] 		= $_POST['meetingPswd'] ?? ''; 
	$row['meet_url'] 		= $_POST['meeturl'] ?? '';  
	$row['dedicated_om'] 	= $_POST['dedicatedOM'] ?? ''; 
	$row['code_b'] 			= $_POST['bookMtg'] ?? ''; 
	$row['code_d'] 			= $_POST['discussionMtg'] ?? ''; 
	$row['code_o'] 			= $_POST['openMtg'] ?? ''; 
	$row['code_w'] 			= $_POST['womensMtg'] ?? ''; 
	$row['code_beg'] 		= $_POST['beginnersMtg'] ?? ''; 
	$row['code_h'] 			= $_POST['handicappedMtg'] ?? ''; 
	$row['code_c'] 			= $_POST['closedMtg'] ?? ''; 
	$row['code_m'] 			= $_POST['mensMtg'] ?? ''; 
	$row['code_ss'] 		= $_POST['stepMtg'] ?? ''; 
	$row['code_sp'] 		= $_POST['speaker'] ?? ''; 
	$row['month_speaker'] 	= $_POST['monthlySpeaker'] ?? ''; 
	$row['potluck'] 		= $_POST['potluckMtg'] ?? ''; 
	$row['add_note'] 		= $_POST['meetNotes'] ?? ''; 


	$errors = validate_row($row);
	if(!empty($errors)) {
		return $errors;
	}

	$sql = "UPDATE meetings SET ";
	$sql .= "group_name='" 		. $row['group_name'] 	. "', ";
	$sql .= "sun='" 			. $row['sun'] 			. "', ";
	$sql .= "mon='" 			. $row['mon'] 			. "', ";
	$sql .= "tue='" 			. $row['tue'] 			. "', ";
	$sql .= "wed='" 			. $row['wed'] 			. "', ";
	$sql .= "thu='" 			. $row['thu'] 			. "', ";
	$sql .= "fri='" 			. $row['fri'] 			. "', ";
	$sql .= "sat='" 			. $row['sat'] 			. "', ";
	$sql .= "meet_time='" 		. $row['meet_time'] 	. "', ";
	$sql .= "am_pm='" 			. $row['am_pm'] 		. "', ";
	$sql .= "meet_phone='" 		. $row['meet_phone'] 	. "', ";
	$sql .= "meet_id='" 		. $row['meet_id'] 		. "', ";
	$sql .= "meet_pswd='" 		. $row['meet_pswd'] 	. "', ";
	$sql .= "meet_url='" 		. $row['meet_url'] 		. "', ";
	$sql .= "dedicated_om='" 	. $row['dedicated_om'] 	. "', ";
	$sql .= "code_b='" 			. $row['code_b'] 		. "', ";
	$sql .= "code_d='" 			. $row['code_d'] 		. "', ";
	$sql .= "code_o='" 			. $row['code_o'] 		. "', ";
	$sql .= "code_w='" 			. $row['code_w'] 		. "', ";
	$sql .= "code_beg='" 		. $row['code_beg'] 		. "', ";
	$sql .= "code_h='" 			. $row['code_h'] 		. "', ";
	$sql .= "code_c='" 			. $row['code_c'] 		. "', ";
	$sql .= "code_m='" 			. $row['code_m'] 		. "', ";
	$sql .= "code_ss='" 		. $row['code_ss'] 		. "', ";
	$sql .= "code_sp='" 		. $row['code_sp']	 	. "', ";
	$sql .= "month_speaker='"	. $row['month_speaker'] . "', ";
	$sql .= "potluck='" 		. $row['potluck'] 		. "', ";
	$sql .= "add_note='" 		. $row['add_note'] 		. "' ";

	$sql .= "WHERE id_mtg='" . $id . "'";
	$sql .= "LIMIT 1";

	$result = mysqli_query($db, $sql);
	// update statements are true/false
	if($result === true) {
		header('location: manage.php');
	} else {
		// update failed
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
	}

}

?>
<div class="meeting-details">

	<form id="manage-mtg" action="manage_edit.php?id=<?= h(u($row['id_mtg'])) ?>" method="post">
		<div class="top-info">
			<p class="days-held">Group name</p>
			<input type="text" class="mtg-update group-name" name="groupName" value="<?php if ($row['group_name'] != "") { echo h($row['group_name']); } ?>" placeholder="Group name">

			<p class="days-held">Day(s) meeting is held</p>
		
	<input type="hidden" name="sunday" value="0">	
	<label><input type="checkbox" name="sunday" value="1" <?php if ($row['sun'] != 0) { echo "checked"; } ?> /> <span>Sunday</span></label> | 

	<input type="hidden" name="monday" value="0">
	<label><input type="checkbox" name="monday" value="1" <?php if ($row['mon'] != 0) { echo "checked"; } ?> /> <span>Monday</span></label> | 

	<input type="hidden" name="tuesday" value="0">
	<label><input type="checkbox" name="tuesday" value="1" <?php if ($row['tue'] != 0) { echo "checked"; } ?> /> <span>Tuesday</span></label> | 

	<input type="hidden" name="wednesday" value="0">
	<label><input type="checkbox" name="wednesday" value="1" <?php if ($row['wed'] != 0) { echo "checked"; } ?> /> <span>Wednesday</span></label> | 

	<input type="hidden" name="thursday" value="0">
	<label><input type="checkbox" name="thursday" value="1" <?php if ($row['thu'] != 0) { echo "checked"; } ?> /> <span>Thursday</span></label> | 

	<input type="hidden" name="friday" value="0">
	<label><input type="checkbox" name="friday" value="1" <?php if ($row['fri'] != 0) { echo "checked"; } ?> /> <span>Friday</span></label> | 

	<input type="hidden" name="saturday" value="0">
	<label><input type="checkbox" name="saturday" value="1" <?php if ($row['sat'] != 0) { echo "checked"; } ?> /> <span>Saturday</span></label>

			<p class="time-held">Time</p>
<div class="mtg-time">			
	<input type="text" name="mtgHour" class="mtg-time" value="<?php if ($row['meet_time'] != null) { echo substr(h($row['meet_time']), 0, 2); } ?>" placeholder="12"> : <input type="text" name="mtgMinute" class="mtg-time" value ="<?php if ($row['meet_time'] != null) {
		echo substr(h($row['meet_time']), -2); } ?>">&nbsp;&nbsp; <label><input type="radio" name="mtgAMPM" value="0" <?php
	 if ($row['am_pm'] == 0) { echo "checked"; } ?>> <span>AM </span></label> &nbsp;|&nbsp; <label><input type="radio" name="mtgAMPM" value="1" <?php if ($row['am_pm'] == 1) { echo "checked"; } ?>> <span> PM</span></label>
</div>

		</div><!-- .top-info -->
		<div class="details-left">
			<label for="phone">Phone number</label>
			<input type="text" class="mtg-update" name="phone" value="<?php

			if ($row['meet_phone'] != "") { 
				echo  "(" .substr(h($row['meet_phone']), 0, 3).") ".substr(h($row['meet_phone']), 3, 3)."-".substr(h($row['meet_phone']),6); } ?>" placeholder="10-digit phone #">

			<label for="idNum">ID number</label>
			<input type="text" class="mtg-update" name="idNum" value="<?php if ($row['meet_id'] != "") { echo h($row['meet_id']); } ?>" placeholder="ID Number">
			<label for="password">Password</label>
			<input type="text" class="mtg-update" name="meetingPswd" value="<?php if ($row['meet_pswd'] != "") { echo h($row['meet_pswd']); } ?>" placeholder="Password">

			<label for="meeturl">Meeting URL</label>
			<textarea name="meeturl" id="meeturl" placeholder="http://zoom-address-here/"><?php if ($row['meet_url'] != "") { echo h($row['meet_url']); } ?></textarea>

			</div><!-- .details-left -->
			<div class="details-right">
				<p class="add-info">Select all that apply</p>

	<input type="hidden" name="dedicatedOM" value="0">			
	<label><input type="checkbox" name="dedicatedOM" <?php if ($row['dedicated_om'] != 0) { echo "checked"; } ?> value="1" /> <span>Dedicated Online Meeting</span></label>
		
	<input type="hidden" name="openMtg" value="0">			
	<label><input type="checkbox" name="openMtg" class="omw oc" <?php if ($row['code_o'] != 0) { echo "checked"; } ?> value="1" /> <span>Open: Anyone may attend</span></label>

	<input type="hidden" name="womensMtg" value="0">
	<label><input type="checkbox" name="womensMtg" class="omw" <?php if ($row['code_w'] != 0) { echo "checked"; } ?> value="1" /> <span>Women's Meeting</span></label>

	<input type="hidden" name="mensMtg" value="0">
	<label><input type="checkbox" name="mensMtg" class="omw" <?php if ($row['code_m'] != 0) { echo "checked"; } ?> value="1" /> <span>Men's Meeting</span></label>

	<input type="hidden" name="closedMtg" value="0">
	<label><input type="checkbox" name="closedMtg" class="oc" <?php if ($row['code_c'] != 0) { echo "checked"; } ?> value="1" /> <span>Closed Meeting</span></label>

	<input type="hidden" name="beginnersMtg" value="0">
	<label><input type="checkbox" name="beginnersMtg" <?php if ($row['code_beg'] != 0) { echo "checked"; } ?> value="1" /> <span>Beginner's Meeting</span></label>

	<input type="hidden" name="handicappedMtg" value="0">
	<label><input type="checkbox" name="handicappedMtg" <?php if ($row['code_h'] != 0) { echo "checked"; } ?> value="1" /> <span>Handicap</span></label>	

	<input type="hidden" name="discussionMtg" value="0">
	<label><input type="checkbox" name="discussionMtg" <?php if ($row['code_d'] != 0) { echo "checked"; } ?> value="1" /> <span>Discussion Meeting</span></label>

	<input type="hidden" name="bookMtg" value="0">
	<label><input type="checkbox" name="bookMtg" <?php if ($row['code_b'] != 0) { echo "checked"; } ?> value="1" /> <span>Book Study</span></label>

	<input type="hidden" name="stepMtg" value="0">
	<label><input type="checkbox" name="stepMtg" <?php if ($row['code_ss'] != 0) { echo "checked"; } ?> value="1" /> <span>Step Study</span></label>

	<input type="hidden" name="speaker" value="0">
	<label><input type="checkbox" name="speaker" <?php if ($row['code_sp'] != 0) { echo "checked"; } ?> value="1" /> <span>Guest Speaker</span></label>

	<input type="hidden" name="monthlySpeaker" value="0">
	<label><input type="checkbox" name="monthlySpeaker" <?php if ($row['month_speaker'] != 0) { echo "checked"; } ?> value="1" /> <span>Monthly Speaker</span></label>

	<input type="hidden" name="potluckMtg" value="0">
	<label><input type="checkbox" name="potluckMtg" <?php if ($row['potluck'] != 0) { echo "checked"; } ?> value="1" /> <span>Potluck</span></label>
			
	</div><!-- .details-right -->

	<label for="meeturl">Additional notes</label>
	<textarea name="meetNotes" class="meetNotes" placeholder="Do you need to add something important to this meeting? If so, put it here. If not, skip this."><?php

	if ($row['add_note'] != "") { echo h($row['add_note']); } ?></textarea>

	<div class="update-rt">
		<input type="submit" name="update-mtg" class="submit" value="UPDATE MEETING">
	</div>

</form>

</div><!-- .meeting-details -->