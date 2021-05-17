
<div class="meeting-details">

	<form id="manage-mtg" action="manage_update.php?id=<?= h(u($row['id_mtg'])); ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="visible" value="<?= $row['visible']; ?>">
		<div class="top-info">
			<p class="days-held">Group name</p>

			<input type="text" class="mtg-update group-name<?php if (isset($errors['group_name'])) { echo " fixerror"; } ?>" name="group_name" value="<?php if (isset($_POST['group_name'])) { echo $_POST['group_name']; } else { echo $row['group_name']; } ?>" placeholder="Group name">

			<p class="days-held">Day(s) meeting is held</p>
	<div class="align-days<?php if (isset($errors['pick_a_day'])) {
				echo " fixerror"; } ?>">
	<div>	
		<input type="hidden" name="sun" value="0">	
		<label><input type="checkbox" name="sun" value="1" <?php if (isset($_POST['sun']) && $_POST['sun'] != 0) { echo "checked"; } else if (($_POST['sun'] == 0) && ($row['sun'] != 0)) { echo ""; } ?> /> <span>Sunday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="mon" value="0">
		<label><input type="checkbox" name="mon" value="1" <?php if (isset($_POST['mon']) && $_POST['mon'] != 0) { echo "checked"; } else if (($_POST['mon'] == 0) && ($row['mon'] != 0)) { echo ""; } ?> /> <span>Monday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="tue" value="0">
		<label><input type="checkbox" name="tue" value="1" <?php if (isset($_POST['tue']) && $_POST['tue'] != 0) { echo "checked"; } else if (($_POST['tue'] == 0) && ($row['tue'] != 0)) { echo ""; } ?> /> <span>Tuesday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="wed" value="0">
		<label><input type="checkbox" name="wed" value="1" <?php if (isset($_POST['wed']) && $_POST['wed'] != 0) { echo "checked"; } else if (($_POST['wed'] == 0) && ($row['wed'] != 0)) { echo ""; } ?> /> <span>Wednesday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="thu" value="0">
		<label><input type="checkbox" name="thu" value="1" <?php if (isset($_POST['thu']) && $_POST['thu'] != 0) { echo "checked"; } else if (($_POST['thu'] == 0) && ($row['thu'] != 0)) { echo ""; } ?> /> <span>Thursday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="fri" value="0">
		<label><input type="checkbox" name="fri" value="1" <?php if (isset($_POST['fri']) && $_POST['fri'] != 0) { echo "checked"; } else if (($_POST['fri'] == 0) && ($row['fri'] != 0)) { echo ""; } ?> /> <span>Friday</span></label> | 
	</div>
	<div>
		<input type="hidden" name="sat" value="0">
		<label><input type="checkbox" name="sat" value="1" <?php if (isset($_POST['sat']) && $_POST['sat'] != 0) { echo "checked"; } else if (($_POST['sat'] == 0) && ($row['sat'] != 0)) { echo ""; } ?> /> <span>Saturday</span></label>
	</div>
</div><!-- .align-days -->
<p class="time-held">Time</p>
<div class="mtg-time">	

	<?php /* https://timepicker.co/options/ */ ?>
	<input name="meet_time" class="timepicker<?php if (isset($errors['meet_time'])) { echo " fixerror"; } ?>" value="<?php if ($_POST['meet_time'] != $row['meet_time']) { echo date('g:i A', strtotime($_POST['meet_time'])); } else { echo date('g:i A', strtotime($row['meet_time'])); } ?>">

</div>

</div><!-- .top-info -->
<div class="details-left">
	<label for="meet_phone">Phone number</label>
	<input type="text" class="mtg-update<?php if (isset($errors['meet_phone'])) { echo " fixerror"; } ?>" name="meet_phone" <?php

	if ((preg_replace('/[^0-9]/', '', $_POST['meet_phone']) != $row['meet_phone']) && $_POST['meet_phone'] != '') {
		$postphone = preg_replace('/[^0-9]/', '', $_POST['meet_phone']);
		echo  "value=\"(" .substr($postphone, 0, 3).") ".substr($postphone, 3, 3)."-".substr($postphone, 6)."\""; }
		else if ((preg_replace('/[^0-9]/', '', $_POST['meet_phone']) != $row['meet_phone']) && $_POST['meet_phone'] == '') {
			"value=\"\""; } 
		else if (isset($row['meet_phone']) && ($row['meet_phone'] != "")) { 
		echo  "value=\"(" .substr(h($row['meet_phone']), 0, 3).") ".substr(h($row['meet_phone']), 3, 3)."-".substr(h($row['meet_phone']),6)."\""; } 
		?> placeholder="10-digit phone #">

	<label for="meet_id">ID number</label>
	<input type="text" class="mtg-update<?php if (isset($errors['meet_id'])) { echo " fixerror"; } ?>" name="meet_id" value="<?php if (isset($_POST['meet_id'])) { echo $_POST['meet_id']; } else { echo $row['meet_id']; } ?>" placeholder="ID Number">

	<label for="meet_pswd">Password</label>
	<input type="text" class="mtg-update<?php if (isset($errors['meet_pswd'])) { echo " fixerror"; } ?>" name="meet_pswd" value="<?php if (isset($_POST['meet_pswd'])) { echo $_POST['meet_pswd']; } else { echo $row['meet_pswd']; } ?>" placeholder="Password">

	<label for="meet_url">Meeting URL</label>
	<textarea name="meet_url" id="meet_url" class="<?php if (isset($errors['meet_url'])) { echo " fixerror"; } ?>" placeholder="https://zoom-address-here/"><?php if (isset($_POST['meet_url'])) { echo $_POST['meet_url']; } else { echo $row['meet_url']; } ?></textarea>



	<label for="meet_addr">Physical Address | lat°, long° accepted <a id="toggle-lat-long-msg"><i class="far fa-question-circle fa-fw"></i></a></label>
	<textarea name="meet_addr" id="meet_addr" class="<?php if (isset($errors['meet_url']) || isset($errors['meet_addr'])) { echo " fixerror"; } ?>" placeholder="123 Main St, Evergreen, CO"><?php if (isset($_POST['meet_addr'])) { echo $_POST['meet_addr']; } else { echo $row['meet_addr']; } ?></textarea>	

	<label for="meet_desc">Descriptive Location <a id="toggle-descriptive-location"><i class="far fa-question-circle fa-fw"></i></a></label>
	<textarea name="meet_desc" id="meet_desc" placeholder="123 Main St.&#10;Evergreen, CO&#10;Around back, 2nd floor"><?php if (isset($_POST['meet_desc'])) { echo $_POST['meet_desc']; } else { echo $row['meet_desc']; } ?></textarea>



	</div><!-- .details-left -->
	<div class="details-right<?php if (isset($errors['meeting_type'])) { echo " fixerror"; } ?>">
		<p class="add-info<?php if (isset($errors['meeting_type'])) { echo " fixerror"; } ?>">Select all that apply</p>

	<input type="hidden" name="dedicated_om" value="0">			
	<label><input type="checkbox" name="dedicated_om" <?php if (isset($_POST['dedicated_om']) && $_POST['dedicated_om'] != 0) { echo "checked"; } else if (($_POST['dedicated_om'] == 0) && ($row['dedicated_om'] != 0)) { echo ""; } ?> value="1" /> <span>Dedicated Online Meeting</span></label>
		
	<input type="hidden" name="code_o" value="0">			
	<label><input type="checkbox" name="code_o" class="omw oc" <?php if (isset($_POST['code_o']) && $_POST['code_o'] != 0) { echo "checked"; } else if (($_POST['code_o'] == 0) && ($row['code_o'] != 0)) { echo ""; } ?> value="1" /> <span>Open: Anyone may attend</span></label>

	<input type="hidden" name="code_w" value="0">
	<label><input type="checkbox" name="code_w" class="omw" <?php if (isset($_POST['code_w']) && $_POST['code_w'] != 0) { echo "checked"; } else if (($_POST['code_w'] == 0) && ($row['code_w'] != 0)) { echo ""; } ?> value="1" /> <span>Women's Meeting</span></label>

	<input type="hidden" name="code_m" value="0">
	<label><input type="checkbox" name="code_m" class="omw" <?php if (isset($_POST['code_m']) && $_POST['code_m'] != 0) { echo "checked"; } else if (($_POST['code_m'] == 0) && ($row['code_m'] != 0)) { echo ""; } ?> value="1" /> <span>Men's Meeting</span></label>

	<input type="hidden" name="code_c" value="0">
	<label><input type="checkbox" name="code_c" class="oc" <?php if (isset($_POST['code_c']) && $_POST['code_c'] != 0) { echo "checked"; } else if (($_POST['code_c'] == 0) && ($row['code_c'] != 0)) { echo ""; } ?> value="1" /> <span>Closed Meeting</span></label>

	<input type="hidden" name="code_beg" value="0">
	<label><input type="checkbox" name="code_beg" <?php if (isset($_POST['code_beg']) && $_POST['code_beg'] != 0) { echo "checked"; } else if (($_POST['code_beg'] == 0) && ($row['code_beg'] != 0)) { echo ""; } ?> value="1" /> <span>Beginner's Meeting</span></label>

	<input type="hidden" name="code_h" value="0">
	<label><input type="checkbox" name="code_h" <?php if (isset($_POST['code_h']) && $_POST['code_h'] != 0) { echo "checked"; } else if (($_POST['code_h'] == 0) && ($row['code_h'] != 0)) { echo ""; } ?> value="1" /> <span>Handicap</span></label>	

	<input type="hidden" name="code_d" value="0">
	<label><input type="checkbox" name="code_d" <?php if (isset($_POST['code_d']) && $_POST['code_d'] != 0) { echo "checked"; } else if (($_POST['code_d'] == 0) && ($row['code_d'] != 0)) { echo ""; } ?> value="1" /> <span>Discussion Meeting</span></label>

	<input type="hidden" name="code_b" value="0">
	<label><input type="checkbox" name="code_b" <?php if (isset($_POST['code_b']) && $_POST['code_b'] != 0) { echo "checked"; } else if (($_POST['code_b'] == 0) && ($row['code_b'] != 0)) { echo ""; } ?> value="1" /> <span>Book Study</span></label>

	<input type="hidden" name="code_ss" value="0">
	<label><input type="checkbox" name="code_ss" <?php if (isset($_POST['code_ss']) && $_POST['code_ss'] != 0) { echo "checked"; } else if (($_POST['code_ss'] == 0) && ($row['code_ss'] != 0)) { echo ""; } ?> value="1" /> <span>Step Study</span></label>

	<input type="hidden" name="code_sp" value="0">
	<label><input type="checkbox" name="code_sp" <?php if (isset($_POST['code_sp']) && $_POST['code_sp'] != 0) { echo "checked"; } else if (($_POST['code_sp'] == 0) && ($row['code_sp'] != 0)) { echo ""; } ?> value="1" /> <span>Speaker Meeting</span></label>

	<input type="hidden" name="month_speaker" value="0">
	<label><input type="checkbox" name="month_speaker" <?php if (isset($_POST['month_speaker']) && $_POST['month_speaker'] != 0) { echo "checked"; } else if (($_POST['month_speaker'] == 0) && ($row['month_speaker'] != 0)) { echo ""; } ?> value="1" /> <span>Speaker Meeting on last Sunday of month</span></label>

	<input type="hidden" name="potluck" value="0">
	<label><input type="checkbox" name="potluck" <?php if (isset($_POST['potluck']) && $_POST['potluck'] != 0) { echo "checked"; } else if (($_POST['potluck'] == 0) && ($row['potluck'] != 0)) { echo ""; } ?> value="1" /> <span>Potluck</span></label>
			
	</div><!-- .details-right -->
	<div class="btm-notes">





<div class="file-uploads">
	<p>Upload PDF Files <a id="toggle-pdf-info"><i class="far fa-question-circle fa-fw"></i></a></p>

	<div id="pdf1" class="pdf-wrap pdf1<?php if (isset($errors['name_link1'])) { echo " fixerror"; } ?>">
		<div class="pdf-row">
			<input type="hidden" name="hid_f1" value="<?= $row['file1']; ?>">
			<input type="file" class="pdf1_name" id="file1" name="file1" accept=".pdf"> <label class="pdf-label">Link 1 label <input type="text" class="pdf1_name" name="link1" value="<?php if (isset($_POST['link1'])) { echo trim($_POST['link1']); } else { echo trim(h($row['link1'])); } ?>" maxlength="25"> <a id="toggle-link-label"><i class="far fa-question-circle fa-fw"></i></a></label>
		</div>
		<div class="pdf-remove">
			<a class="pdf-remove pdf-remove-1">Remove</a>
		</div>
	</div>

	<div id="pdf2" class="pdf-wrap pdf2<?php if (isset($errors['name_link2'])) { echo " fixerror"; } ?>">
		<div class="pdf-row">
			<input type="hidden" name="hid_f2" value="<?= $row['file2']; ?>">
			<input type="file" class="pdf2_name" id="file2" name="file2" accept=".pdf"> <label class="pdf-label">Link 2 label <input type="text" class="pdf2_name" name="link2" value="<?php if (isset($_POST['link2'])) { echo trim($_POST['link2']); } else { echo trim(h($row['link2'])); } ?>" maxlength="25"></label>
		</div>
		<div class="pdf-remove">
			<a class="pdf-remove pdf-remove-2">Remove</a>
		</div>
	</div>		

	<div id="pdf3" class="pdf-wrap pdf3<?php if (isset($errors['name_link3'])) { echo " fixerror"; } ?>">
		<div class="pdf-row">
			<input type="hidden" name="hid_f3" value="<?= $row['file3']; ?>">
			<input type="file" class="pdf3_name" id="file3" name="file3" accept=".pdf"> <label class="pdf-label">Link 3 label <input type="text" class="pdf3_name" name="link3" value="<?php if (isset($_POST['link3'])) { echo trim($_POST['link3']); } else { echo trim(h($row['link3'])); } ?>" maxlength="25"></label>
		</div>
		<div class="pdf-remove">
			<a class="pdf-remove pdf-remove-3">Remove</a>
		</div>
	</div>		

	<div id="pdf4" class="pdf-wrap pdf4<?php if (isset($errors['name_link4'])) { echo " fixerror"; } ?>">
		<div class="pdf-row">
			<input type="hidden" name="hid_f4" value="<?= $row['file4']; ?>">
			<input type="file" class="pdf4_name" id="file4" name="file4" accept=".pdf"> <label class="pdf-label">Link 4 label <input type="text" class="pdf4_name" name="link4" value="<?php if (isset($_POST['link4'])) { echo trim($_POST['link4']); } else { echo trim(h($row['link4'])); } ?>" maxlength="25"></label>
		</div>
		<div class="pdf-remove">
			<a class="pdf-remove pdf-remove-4">Remove</a>
		</div>
	</div>

	<a id="file-upload"><i class="far fa-plus-square fa-fw"></i> Add a PDF | 4 Total</a>

</div>

	
		<label for="add_note">Additional notes</label>
		<textarea name="add_note" class="meetNotes" placeholder="Text only. 255 characters or less. All formatting will be stripped."><?php if (isset($_POST['add_note'])) { echo $_POST['add_note']; } else { echo $row['add_note']; } ?></textarea>


		<div class="visible">

			<h1><i class="fas fa-users" style="margin-right:1em;"></i> Select your audience</h1>
			<div class="radio-group">
				<div class='radio<?php if (isset($_POST['visible']) && (($_POST['visible'] != $row['visible']) && $_POST['visible'] == "0")) { echo " selected"; } else if (isset($_POST['visible']) && (($_POST['visible'] != $row['visible']) && $_POST['visible'] != "0")) { echo ""; } else if ($row['visible'] == "0") { echo " selected"; } ?>' value="0">
					Draft | Save for later.
				</div>

				<div class='radio<?php if (isset($_POST['visible']) && (($_POST['visible'] != $row['visible']) && $_POST['visible'] == "1")) { echo " selected"; } else if (isset($_POST['visible']) && (($_POST['visible'] != $row['visible']) && $_POST['visible'] != "1")) { echo ""; } else if ($row['visible'] == "1") { echo " selected"; } ?>' value="1">
					Private | Only you will see this.
				</div>

				<div class='radio<?php if (isset($_POST['visible']) && (($_POST['visible'] != $row['visible']) && $_POST['visible'] == "2")) { echo " selected"; } else if (isset($_POST['visible']) && (($_POST['visible'] != $row['visible']) && $_POST['visible'] != "2")) { echo ""; } else if ($row['visible'] == "2") { echo " selected"; } ?>' value="2">
					Members Only | Only members of EvergreenAA.com.</div>

				<div class='radio<?php if (isset($_POST['visible']) && (($_POST['visible'] != $row['visible']) && $_POST['visible'] == "3")) { echo " selected"; } else if (isset($_POST['visible']) && (($_POST['visible'] != $row['visible']) && $_POST['visible'] != "3")) { echo ""; } else if ($row['visible'] == "3") { echo " selected"; } ?>' value="3">
					Public | Share with everyone. No membership required.
				</div>

	<?php /* 	grab value and put it into hidden field to submit 
				this is also in _includes/manage_new_review */		?>
				<input type="hidden" name="visible" value="<?php 

				if ($_POST['visible'] != $row['visible']) {
					echo $_POST['visible'];
				} else {

					if ($row['visible'] == "0") { echo "0"; } // Draft 
					if ($row['visible'] == "1") { echo "1"; } // Private
					if ($row['visible'] == "2") { echo "2"; } // Members Only
					if ($row['visible'] == "3") { echo "3"; } // Public
				}

				?>" />
			 </div>

		</div><!-- .visible -->



		<div class="update-rt">
			<a class="cancel" href="manage.php">CANCEL</a> <input type="submit" id="update-mtg" name="update-mtg" class="submit" value="UPDATE">
		</div><!-- .update-rt -->
	</div><!-- .btm-notes -->

</form>

</div><!-- .meeting-details -->
