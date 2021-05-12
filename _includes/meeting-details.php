
				<div class="meeting-details">

<?php if ($row['dedicated_om'] == 0 && $row['meet_phone'] == null && $row['meet_id'] == 0 && $row['meet_pswd'] == null && $row['meet_url'] == null) {  } else { ?>
					<div class="details-left">
<?php 					if ($row['dedicated_om'] != 0) { ?><p>Dedicated Online Meeting</p><?php } ?>
<?php 					if ($row['meet_phone'] != null) { ?>
						<p class="phone-num01"><i class="fas fa-mobile-alt"></i> <a class="phone" href="tel:<?=  "(" .substr($row['meet_phone'], 0, 3).") ".substr($row['meet_phone'], 3, 3)."-".substr($row['meet_phone'],6); ?>"><?=  "(" .substr($row['meet_phone'], 0, 3).") ".substr($row['meet_phone'], 3, 3)."-".substr($row['meet_phone'],6); ?></a></p><?php } ?>
<?php 					if ($row['meet_id'] != '') { ?>		
						<p class="id-num">ID: <input type="text" value="<?= h($row['meet_id']); ?>" class="day-values input-copy" onclick="select();"></p>
						<button type="submit" class="zoom-id btn"><i class="far fa-arrow-alt-circle-up"></i> Copy</button>
<?php } ?>

<?php 					if ($row['meet_pswd'] != null) { ?>
						<p class="id-num">Password: <input type="text" value="<?= h($row['meet_pswd']); ?>" class="day-values input-copy" onclick="select();"></p>
						<button type="submit" class="zoom-id btn"><i class="far fa-arrow-alt-circle-up"></i> Copy</button>
<?php } ?>
<?php 					if ($row['meet_url'] != null) { ?>
						<p><a href="<?= h($row['meet_url']); ?>" class="zoom" target="_blank">JOIN ZOOM MEETING</a></p>
<?php } ?>
					</div><!-- .details-left -->
<?php } ?>
					<div class="details-right" <?php if ($row['dedicated_om'] == 0 && $row['meet_phone'] == null && $row['meet_id'] == 0 && $row['meet_pswd'] == null && $row['meet_url'] == null) { echo "style=\"width:100%;\""; } ?>>

<?php 				if ($row['meet_addr'] != null) { ?>

						<div id="map">
							<iframe
							  width="100%"
							  height="180"
							  style="border:0"
							  loading="lazy"
							  allowfullscreen
							  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAVGjPB87QSFceli6EMwlRlLxvmewIA1P0
							    &q=<?= preg_replace( "/\r|\n/", " ", h($row['meet_addr'])); ?>">
							</iframe>
						</div>
						<p><?= nl2br($row['meet_addr']); ?></p>
						<a class="map-dir" href="https://maps.apple.com/?q=<?= preg_replace( "/\r|\n/", " ", h($row['meet_addr'])); ?>" target="_blank">Directions</a>

<?php } ?>

						<p class="add-info">Additional Information</p>
						<ul>
						<?php
							if ($row['dedicated_om'] != 0) 		{ ?> <li>Dedicated Online Meeting</li> 						
						<?php }	
							if ($row['code_o'] != 0) 		{ ?> <li>Open Meeting: Anyone may attend</li> 		
						<?php }
							if ($row['code_w'] != 0) 		{ ?> <li>Women's Meeting</li> 						
						<?php }
							if ($row['code_m'] != 0) 		{ ?> <li>Men's Meeting</li> 						
						<?php }
							if ($row['code_c'] != 0) 		{ ?> <li>Closed Meeting</li> 						
						<?php }
							if ($row['code_beg'] != 0) 			{ ?> <li>Beginner's Meeting</li> 					
						<?php }
							if ($row['code_h'] != 0) 	{ ?> <li>Handicap Accessible</li> 
						<?php }
							if ($row['code_d'] != 0) 	{ ?> <li>Discussion</li> 							
						<?php }
							if ($row['code_b'] != 0) 		{ ?> <li>Book Study</li> 								
						<?php }
							if ($row['code_ss'] != 0) 	{ ?> <li>Step Study: We discuss the 12 steps</li> 	
						<?php }
							if ($row['code_sp'] != 0) 	{ ?> <li>Speaker Meeting</li>					
						<?php }
							if ($row['month_speaker'] != 0) 	{ ?> <li>Speaker Meeting on last Sunday of month</li>
						<?php }
							if ($row['potluck'] != 0) 		{ ?> <li>Potluck</li>						
<?php  }   ?>
						</ul>
					</div><!-- .details-right -->
					<?php if($row['add_note'] != null) { ?><div id="add-note"><p><?= nl2br(h($row['add_note'])) ?></p></div><?php } ?>
				</div><!-- .meeting-details -->