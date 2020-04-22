<?php

	// manage-meeting-details.php globals
	$mtgPhone = "";
	$meetIDNum = "";
	$meetingPswd = "";
	$meetingURL = "";
	$meetingNotes = "";
	$openMtg = "";
	$womensMtg = "";
	$mensMtg = "";
	$beginnersMtg = "";
	$discussionMtg = "";
	$closedMtg = "";
	$bookMtg = "";
	$stepMtg = "";
	$speaker = "";
	$monthlySpeaker = "";
	$potluckMtg = "";
	$handicappedMtg = "";
	$monday = "";
	$tuesday = "";
	$wednesday = "";
	$thursday = "";
	$friday = "";
	$saturday = "";
	$sunday = "";
	$mtgHour = "";
	$mtgMinute = "";
	$mtgAMPM = "";



// if user clicks UPDATE MEETING
if (isset($_POST['update-mtg'])) {

	$mtgHour 		= $_POST['mtgHour'];
	$mtgMinute  	= $_POST['mtgMinute'];
	$mtgTime 		= ($_POST['mtgHour'] . $_POST['mtgMinute']);
	$mtgAMPM  		= $_POST['mtgAMPM'];	
	$sunday			= $_POST['sunday'];
	$monday			= $_POST['monday'];
	$tuesday		= $_POST['tuesday'];
	$wednesday		= $_POST['wednesday'];
	$thursday		= $_POST['thursday'];
	$friday			= $_POST['friday'];
	$saturday		= $_POST['saturday'];

	$mtgPhone		= $_POST['phone'];
	$meetIDNum		= $_POST['idNum'];
	$meetingPswd	= $_POST['meetingPswd'];
	$meetingURL		= $_POST['meeturl'];
	$meetingNotes	= $_POST['meetNotes'];
	$openMtg		= $_POST['openMtg'];
	$womensMtg		= $_POST['womensMtg'];
	$mensMtg		= $_POST['mensMtg'];
	$beginnersMtg	= $_POST['beginnersMtg'];
	$discussionMtg	= $_POST['discussionMtg'];
	$closedMtg		= $_POST['closedMtg'];
	$bookMtg		= $_POST['bookMtg'];
	$stepMtg		= $_POST['stepMtg'];
	$speaker	 	= $_POST['speaker'];
	$monthlySpeaker = $_POST['monthlySpeaker'];
	$potluckMtg		= $_POST['potluckMtg'];
	$handicappedMtg = $_POST['handicappedMtg'];




	$sql = "UPDATE meetings SET ";
	$sql .= "mon='" . $monday. "', ";
	$sql .= "mon='" . $monday. "', ";
	$sql .= "mon='" . $tuesday. "', ";
	$sql .= "mon='" . $wednesday. "', ";
	$sql .= "mon='" . $thursday. "', ";
	$sql .= "mon='" . $friday. "', ";
	$sql .= "mon='" . $saturday. "', ";
	$sql .= "mon='" . $sunday. "', ";
	$sql .= "meet_time='" . $meetTime. "' ";
	$sql .= "WHERE id_mtg='" . $meeting_id. "'";
	$sql .= "LIMIT 1";

	$result = mysqli_query($db, $sql);
	// update statements are true/false
	if($result) {
		echo '<script type="text/javascript">';
		echo ' alert("Success!")';  //not showing an alert box.
		echo '</script>';
	} else {
		// update failed
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
	}


}







	$meeting_id = $row['id_mtg'];
	$mon		= $row['mon'];
	$tue		= $row['tue'];
	$wed		= $row['wed'];
	$thu		= $row['thu'];
	$fri		= $row['fri'];
	$sat		= $row['sat'];
	$sun		= $row['sun'];
	$meetTime	= $row['meet_time'];
	$meetHour	= $row['meet_hour'];
	$meetMin	= $row['meet_min'];
	$amPM		= $row['am_pm'];

	// if ($meetTime > 1259) {
	// 	$meetHour = $meetTime - 1200;
	// 	$meetMin  = $meetTime.substr($meetTime, -2);
	// 	$amPM 	  = 1;
	// } else if ($meetTime < 1000) {
	// 	$meetHour = substr($meetTime, 0, 2);
	// 	$meetMin  = $meetTime.substr($meetTime, -2);
	// 	$amPM     = 0;
	// }

	$groupName	= $row['group_name'];
	$meetPhone	= $row['meet_phone'];
	$meetID		= $row['meet_id'];
	$meetPswd	= $row['meet_pswd'];
	$meetURL	= $row['meet_url'];
	$addURL		= $row['address_url'];
	$dedicated	= $row['dedicated_om'];

	$bigBook	= $row['code_b'];
	$discussion	= $row['code_d'];
	$open		= $row['code_o'];
	$womens		= $row['code_w'];
	$beg		= $row['code_beg'];
	$handicap	= $row['code_h'];
	$closed		= $row['code_c'];
	$mens		= $row['code_m'];
	$stepStudy	= $row['code_ss'];
	$speakerMtg = $row['code_sp'];
	$monthSpeak	= $row['month_speaker'];
	$potluck	= $row['potluck'];
	$addNote 	= $row['add_note'];


?>
<div class="meeting-details">

	<form id="manage-mtg" action="" method="post">
		<div class="top-info">
			<p class="days-held">Day(s) meeting is held</p>
		
	<input type="hidden" name="sunday" value="0">	
	<label><input type="checkbox" name="sunday" value="1" <?php if ($row['sun'] != 0) { echo "checked"; } ?> /> <span>Sunday</span></label> | 

	<input type="hidden" name="monday" value="0">
	<label><input type="checkbox" name="monday" value="1" <?php if ($row['mon'] != 0) { echo "checked"; } ?> /> <span>Monday</span></label> | 

	<input type="hidden" name="tuesday" value="0">
	<label><input type="checkbox" name="tuesday" value="1" <?php if ($row['tue'] != 0) { echo "checked"; } ?> /> <span>Tuesday</span></label> | 

	<input type="hidden" name="wednesday" value="0">
	<label><input type="checkbox" name="wednesday" value="1" <?php if (($wednesday || $wed) != 0) { echo "checked"; } ?> /> <span>Wednesday</span></label> | 

	<input type="hidden" name="thursday" value="0">
	<label><input type="checkbox" name="thursday" value="1" <?php if (($thursday || $thu) != 0) { echo "checked"; } ?> /> <span>Thursday</span></label> | 

	<input type="hidden" name="friday" value="0">
	<label><input type="checkbox" name="friday" value="1" <?php if (($friday || $fri) != 0) { echo "checked"; } ?> /> <span>Friday</span></label> | 

	<input type="hidden" name="saturday" value="0">
	<label><input type="checkbox" name="saturday" value="1" <?php if (($saturday || $sat) != 0) { echo "checked"; } ?> /> <span>Saturday</span></label>

			<p class="time-held">Time</p>
<div class="mtg-time">			
	<input type="text" name="mtgHour" class="mtg-time" value="<?php

	if ($mtgHour != "") { 
		echo $mtgHour; 
	} else if ($meetTime != null) { 
		echo substr($meetTime, 0, 2); 

	} ?>" placeholder="12"> : <input type="text" name="mtgMinute" class="mtg-time" value ="<?php
	if ($mtgMinute != "") {
		echo $mtgMinute;
	} else if ($meetTime != null) {
		echo substr($meetTime, -2);
	}

	 ?>">&nbsp;&nbsp; <label><input type="radio" name="mtgAMPM" value="0" <?php
	 if ($mtgAMPM == 0 || $amPM == 0) {
	 	echo "checked";
	 }
	  ?>> <span>AM </span></label> &nbsp;|&nbsp; <label><input type="radio" name="mtgAMPM" value="1" <?php
	 if ($mtgAMPM == 1 || $amPM == 1) {
	 	echo "checked";
	 }
	   ?>> <span> PM</span></label>
</div>

		</div><!-- .top-info -->
		<div class="details-left">
			<label for="phone">Phone number</label>
			<input type="text" class="mtg-update" name="phone" value="<?php

			if ($mtgPhone != "") { 
				echo $mtgPhone; 
				} else if ($meetPhone != null) { echo  "(" .substr($meetPhone, 0, 3).") ".substr($meetPhone, 3, 3)."-".substr($meetPhone,6); } ?>" placeholder="10-digit phone #">

			<label for="idNum">ID number</label>
			<input type="text" class="mtg-update" name="idNum" value="<?php

			if ($meetIDNum != "") { 
				echo $meetIDNum; 
				} else if ($meetID != null) { echo  $meetID; } ?>" placeholder="ID Number">

			<label for="password">Password</label>
			<input type="text" class="mtg-update" name="meetingPswd" value="<?php

			if ($meetingPswd != "") { 
				echo $meetingPswd; 
				} else if ($meetPswd != null) { echo  $meetPswd; } ?>" placeholder="Password">

			<label for="meeturl">Meeting URL</label>
			<textarea name="meeturl" id="meeturl" placeholder="http://zoom-address-here/"><?php

			if ($meetingURL != "") { 
				echo $meetingURL; 
				} else if ($meetURL != null) { echo  $meetURL; } ?></textarea>

			</div><!-- .details-left -->
			<div class="details-right">
				<p class="add-info">Select all that apply</p>
		
	<input type="hidden" name="openMtg" value="0">			
	<label><input type="checkbox" name="openMtg" class="omw oc" <?php if (($openMtg || $open) != 0) { echo "checked"; } ?> value="1" /> <span>Open: Anyone may attend</span></label>

	<input type="hidden" name="womensMtg" value="0">
	<label><input type="checkbox" name="womensMtg" class="omw" <?php if (($womensMtg || $womens) != 0) { echo "checked"; } ?> value="1" /> <span>Women's Meeting</span></label>

	<input type="hidden" name="mensMtg" value="0">
	<label><input type="checkbox" name="mensMtg" class="omw" <?php if (($mensMtg || $mens) != 0) { echo "checked"; } ?> value="1" /> <span>Men's Meeting</span></label>

	<input type="hidden" name="closedMtg" value="0">
	<label><input type="checkbox" name="closedMtg" class="oc" <?php if (($closedMtg || $closed) != 0) { echo "checked"; } ?> value="1" /> <span>Closed Meeting</span></label>

	<input type="hidden" name="beginnersMtg" value="0">
	<label><input type="checkbox" name="beginnersMtg" <?php if (($beginnersMtg || $beg) != 0) { echo "checked"; } ?> value="1" /> <span>Beginner's Meeting</span></label>

	<input type="hidden" name="discussionMtg" value="0">
	<label><input type="checkbox" name="discussionMtg" <?php if (($discussionMtg || $discussion) != 0) { echo "checked"; } ?> value="1" /> <span>Discussion Meeting</span></label>

	<input type="hidden" name="bookMtg" value="0">
	<label><input type="checkbox" name="bookMtg" <?php if (($bookMtg || $bigBook) != 0) { echo "checked"; } ?> value="1" /> <span>Book Study</span></label>

	<input type="hidden" name="stepMtg" value="0">
	<label><input type="checkbox" name="stepMtg" <?php if (($stepMtg || $stepStudy) != 0) { echo "checked"; } ?> value="1" /> <span>Step Study</span></label>

	<input type="hidden" name="speaker" value="0">
	<label><input type="checkbox" name="speaker" <?php if (($speaker || $speakerMtg) != 0) { echo "checked"; } ?> value="1" /> <span>Guest Speaker</span></label>

	<input type="hidden" name="monthlySpeaker" value="0">
	<label><input type="checkbox" name="monthlySpeaker" <?php if (($monthlySpeaker || $monthSpeak) != 0) { echo "checked"; } ?> value="1" /> <span>Monthly Speaker</span></label>

	<input type="hidden" name="potluckMtg" value="0">
	<label><input type="checkbox" name="potluckMtg" <?php if (($potluckMtg || $potluck) != 0) { echo "checked"; } ?> value="1" /> <span>Potluck</span></label>

	<input type="hidden" name="handicappedMtg" value="0">
	<label><input type="checkbox" name="handicappedMtg" <?php if (($handicappedMtg || $handicap) != 0) { echo "checked"; } ?> value="1" /> <span>Handicap</span></label>
			
	</div><!-- .details-right -->

	<label for="meeturl">Additional notes</label>
	<textarea name="meetNotes" id="meetNotes" placeholder="Do you need to add something important to this meeting? If so, put it here. If not, skip this."><?php

	if ($meetingNotes != "") { 
		echo $meetingNotes; 
		} else if ($addNote != null) { echo  $addNote; } ?></textarea>

	<div class="update-rt">
		<input type="submit" name="update-mtg" class="submit" value="UPDATE MEETING">
	</div>

</form>

</div><!-- .meeting-details -->