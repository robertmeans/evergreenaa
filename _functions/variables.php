<?php

	$meeting_id = $row['id'];
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
	$speaker	= $row['code_sp'];
	$closed		= $row['code_c'];
	$mens		= $row['code_m'];
	$stepStudy	= $row['code_ss'];
	$speakerMtg = $row['code_sp'];
	$monthSpeak	= $row['month_speaker'];
	$potluck	= $row['potluck'];
	$addNote 	= $row['add_note'];

?>
				<div class="meeting-details">
					<?php if (isset($_SESSION['id'])) { // show the edit button if they're logged in ?>
					<a href="edit-meeting.php?mtg=<?php echo $meeting_id;  ?>"><i class="far fa-edit"></i></a>
					<?php } ?>
					<div class="details-left">
						<p class="meet-time"> <?= $meetHour . ":" . $meetMin . " "?><?php if($amPM != 0) { ?>PM <?php } else { ?>AM <?php } ?><?= $today ?> <?php
							if ($mens != 0) { ?>| MENS <?php } 
							if ($womens != 0) { ?>| WOMENS <?php } ?></p>
						<p>Group: <?= $groupName; ?></p>
<?php 					if ($dedicated != 0) { ?><p>Dedicated Online Meeting</p><?php } ?>
<?php 					if ($meetPhone != null) { ?>
						<p class="phone-num01"><i class="fas fa-mobile-alt"></i> <a class="phone" href="tel:<?=  "(" .substr($meetPhone, 0, 3).") ".substr($meetPhone, 3, 3)."-".substr($meetPhone,6); ?>"><?=  "(" .substr($meetPhone, 0, 3).") ".substr($meetPhone, 3, 3)."-".substr($meetPhone,6); ?></a></p><?php } ?>
<?php 					if ($meetID != 'No ID Necessary') { ?>		
						<p class="id-num">ID: <input type="text" value="<?= $meetID; ?>" class="day-values input-copy" onclick="select();"></p>
						<button type="submit" class="zoom-id btn"><i class="far fa-arrow-alt-circle-up"></i> Copy</button>
<?php } else { ?>
						<p class="id-num">ID: No ID necessary</p>
<?php } ?>
<?php 					if ($meetPswd != null) { ?>
						<p class="id-num">Password: <input type="text" value="<?= $meetPswd; ?>" class="day-values input-copy" onclick="select();"></p>
						<button type="submit" class="zoom-id btn"><i class="far fa-arrow-alt-circle-up"></i> Copy</button>
<?php } ?>
						<p><a href="<?= $meetURL; ?>" class="zoom" target="_blank">JOIN MEETING</a></p>
					</div><!-- .details-left -->
					<div class="details-right">
						<p class="add-info">Additional Information</p>
						<ul>
						<?php
							if ($womens != 0) 		{ ?> <li>Women's Meeting</li> 						
						<?php }
							if ($mens != 0) 		{ ?> <li>Men's Meeting</li> 						
						<?php }
							if ($open != 0) 		{ ?> <li>Open Meeting: Anyone may attend</li> 		
						<?php }
							if ($closed != 0) 		{ ?> <li>Closed Meeting</li> 						
						<?php }
							if ($beg != 0) 			{ ?> <li>Beginner's Meeting</li> 					
						<?php }
							if ($discussion != 0) 	{ ?> <li>Discussion</li> 							
						<?php }
							if ($bigBook != 0) 		{ ?> <li>Book Study</li> 								
						<?php }
							if ($stepStudy != 0) 	{ ?> <li>Step Study: We discuss the 12 steps</li> 	
						<?php }
							if ($handicap != 0) 	{ ?> <li>Handicap Accessible</li> 
						<?php }
							if ($speakerMtg != 0) 	{ ?> <li>Speaker Meeting</li>					
						<?php }
							if ($monthSpeak != 0) 	{ ?> <li>Speaker Meeting on last Sunday of month</li>
						<?php }
							if ($potluck != 0) 		{ ?> <li>Potluck</li>						
<?php  }   ?>
						</ul>
					</div><!-- .details-right -->
					<?php if($addNote != null) { ?><div id="add-note"><p><?= $addNote ?></p></div><?php } ?>
				</div><!-- .meeting-details -->