	<input type="text" name="mtgMinute" class="mtg-time <?php if (isset($errors['mtgMinute'])) { echo "fixerror"; } ?>" value ="





	<?php if ((isset($_POST['mtgMinute'])) && ($_POST['mtgMinute'] != 00)) { echo preg_replace('/[^0-9]/', '', str_pad($_POST['mtgMinute'], 2, '0', STR_PAD_LEFT)); return; } else if ($row['meet_time'] != null) { echo substr(h($row['meet_time']), 0, 2); } ?>



	">&nbsp;&nbsp;

	// this is what I was trying below...

<p class="time-held">Time</p>
<div class="mtg-time">			
	<input type="text" name="mtgHour" class="mtg-time<?php if (isset($errors['mtgHour'])) { echo " fixerror"; } ?>" value="<?php if ($row['meet_time'] != null) { echo substr(h($row['meet_time']), 0, 2); } else if ((isset($_POST['mtgHour'])) && ($_POST['mtgHour'] != 00)) { echo preg_replace('/[^0-9]/', '', str_pad($_POST['mtgHour'], 2, '0', STR_PAD_LEFT)); } ?>"> : 

	<input type="text" name="mtgMinute" class="mtg-time <?php if (isset($errors['mtgMinute'])) { echo "fixerror"; } ?>" value ="<?php if ((isset($_POST['mtgMinute'])) && ($_POST['mtgMinute'] != 00)) { echo preg_replace('/[^0-9]/', '', str_pad($_POST['mtgMinute'], 2, '0', STR_PAD_LEFT)); } else if ($row['meet_time'] != null) { echo substr(h($row['meet_time']), 0, 2); } ?>">&nbsp;&nbsp; 

	<span class="<?php if (isset($errors['am_pm'])) { echo " fixerror"; } ?>">
		<label><input type="radio" name="am_pm" value="0" <?php
		 if (!isset($row['am_pm']) && ($row['am_pm'] == 0)) { echo "checked"; } ?>> <span>AM </span></label> &nbsp;|&nbsp; <label><input type="radio" name="am_pm" value="1" <?php if (isset($row['am_pm']) && ($row['am_pm'] == 1)) { echo "checked"; } ?>> <span> PM</span></label>
		</span>
</div>
	