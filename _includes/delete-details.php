
				<div class="meeting-details">
					<?php // if (isset($_SESSION['id'])) { // show the edit button if they're logged in ?>
					<!-- <a href="edit-meeting.php?mtg=<?php // echo h(u($meeting_id));  ?>"><i class="far fa-edit"></i></a> -->
					<?php // } ?>
					<div class="details-left">
<?php 					if ($row['dedicated_om'] != 0) { ?><p>Dedicated Online Meeting</p><?php } ?>
<?php 					if ($row['meet_phone'] != null) { ?>
						<p class="phone-num01"><i class="fas fa-mobile-alt"></i> <a class="phone" href="tel:<?=  "(" .substr($row['meet_phone'], 0, 3).") ".substr($row['meet_phone'], 3, 3)."-".substr($row['meet_phone'],6); ?>"><?=  "(" .substr($row['meet_phone'], 0, 3).") ".substr($row['meet_phone'], 3, 3)."-".substr($row['meet_phone'],6); ?></a></p><?php } ?>
<?php 					if ($row['meet_id'] != '') { ?>		
						<p class="id-num">ID: <input type="text" value="<?= $row['meet_id']; ?>" class="day-values input-copy" onclick="select();"></p>
						<button type="submit" class="zoom-id btn"><i class="far fa-arrow-alt-circle-up"></i> Copy</button>
<?php } else { ?>
						<p class="id-num">ID: No ID necessary</p>
<?php } ?>
<?php 					if ($row['meet_pswd'] != null) { ?>
						<p class="id-num">Password: <input type="text" value="<?= $row['meet_pswd']; ?>" class="day-values input-copy" onclick="select();"></p>
						<button type="submit" class="zoom-id btn"><i class="far fa-arrow-alt-circle-up"></i> Copy</button>
<?php } ?>
						<p><a href="<?= $row['meet_url']; ?>" class="zoom" target="_blank">JOIN MEETING</a></p>
					</div><!-- .details-left -->
					<div class="details-right">
						<p class="add-info">Additional Information</p>
						<ul>
						<?php
							if ($row['code_w'] != 0) 		{ ?> <li>Women's Meeting</li> 						
						<?php }
							if ($row['code_m'] != 0) 		{ ?> <li>Men's Meeting</li> 						
						<?php }
							if ($row['code_o'] != 0) 		{ ?> <li>Open Meeting: Anyone may attend</li> 		
						<?php }
							if ($row['code_c'] != 0) 		{ ?> <li>Closed Meeting</li> 						
						<?php }
							if ($row['code_beg'] != 0) 			{ ?> <li>Beginner's Meeting</li> 					
						<?php }
							if ($row['code_d'] != 0) 	{ ?> <li>Discussion</li> 							
						<?php }
							if ($row['code_b'] != 0) 		{ ?> <li>Book Study</li> 								
						<?php }
							if ($row['code_ss'] != 0) 	{ ?> <li>Step Study: We discuss the 12 steps</li> 	
						<?php }
							if ($row['code_h'] != 0) 	{ ?> <li>Handicap Accessible</li> 
						<?php }
							if ($row['code_sp'] != 0) 	{ ?> <li>Speaker Meeting</li>					
						<?php }
							if ($row['month_speaker'] != 0) 	{ ?> <li>Speaker Meeting on last Sunday of month</li>
						<?php }
							if ($row['potluck'] != 0) 		{ ?> <li>Potluck</li>						
<?php  }   ?>
						</ul>
					</div><!-- .details-right -->

		<div class="btm-notes">
		<?php if($row['add_note'] != null) { ?><div id="add-note"><p><?= $row['add_note'] ?></p></div><?php } ?>
				
		<div class="update-rt">
		<form action="delete_meeting.php?id=<?= h(u($id)); ?>" method="post">
		<a class="cancel" href="manage.php">CANCEL</a> <input type="submit" name="delete-mtg" class="submit" value="DELETE">		
		</form>
		</div><!-- .update-rt -->

		</div><!-- .btm-notes -->
	</div><!-- .meeting-details -->
