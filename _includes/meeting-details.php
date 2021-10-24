				<?php $emh = rand(10000, 99999);  ?>
				<div class="meeting-details">


<?php /* if (isset($_SESSION['admin']) && $_SESSION['admin'] == "1") { */ ?>

	<div id="<?= $emh . '_' . $row['id_mtg']; ?>" class="email-host <?php if (isset($_SESSION['mode']) && ($_SESSION['mode'] == 1)) { echo ' admin-links'; } ?>">
		
		<span data-target="mtgtime" style="display:none;"><?= date('g:i A', strtotime($row['meet_time'])); ?></span>
		<?php if ($hide_this != 'yep') { ?>
			<span data-target="mtgday" style="display:none;"><?= substr(ucfirst($today), 0,3); ?></span>
		<?php } ?>
		<span data-target="mtgid" style="display:none;"><?= $row['id_mtg']; ?></span>
		<span data-target="tuid" style="display: none;"><?= $user_id ?></span>
		<span data-target="ri" style="display:none;"><?= $row['issues']; ?></span>
		<span data-target="mtgname" style="display:none;">
		<?php if (strlen($row['group_name']) < 22) { 
				echo trim($row['group_name']); 
			} else {
				echo trim(substr($row['group_name'], 0,22)) . '...';
			} 
		?>
		</span>

		<?php if (isset($_SESSION['admin']) && ($_SESSION['mode'] == 1 && ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3))) { ?>
			<a class="emh-link" data-role="emh" data-id="<?= $emh . '_' . $row['id_mtg']; ?>"><i class="far fa-envelope"></i> <?= $row['username'] . ' &bullet; ' . $row['email'] ?></a> <a data-role="<?php if ((isset($row['idi_user'])) && ($row['idi_user'] == $_SESSION['id'])) { echo 'logissued'; } else { echo 'logissue'; } ?>" data-id="<?= $emh . '_' . $row['id_mtg']; ?>" class="emh-link"><i class="fas fa-exclamation-triangle"></i> Log an issue</a>
		<?php } else { ?>
			<a class="emh-link" data-role="emh" data-id="<?= $emh . '_' . $row['id_mtg']; ?>"><i class="far fa-envelope"></i> Email Host</a> <a data-role="<?php if ((isset($row['idi_user'])) && ($row['idi_user'] == $_SESSION['id'])) { echo 'logissued'; } else { echo 'logissue'; } ?>" data-id="<?= $emh . '_' . $row['id_mtg']; ?>" class="emh-link"><i class="fas fa-exclamation-triangle"></i> Log an issue</a>
		<?php } ?>

	</div>

		<?php 
		if ($row['issues'] == 0) { ?>
			<div id="<?= $emh . '_' . $row['id_mtg'] . '_er'; ?>"></div>
		<?php }
		if ($row['issues'] == 1) { ?>
			<div id="<?= $emh . '_' . $row['id_mtg'] . '_er'; ?>" class="errors-reported">Attention: There has been an issue reported with this meeting that the Host has not addressed yet. If you find the meeting abandoned or if any of the links do not work correctly please use the link above, &quot;Log issue&quot; to help keep the information on this site reliable. If 3 issues go unaddressed the meeting will be removed from the site until the necessary corrections are made.</div>
		<?php } 
		if ($row['issues'] > 1) { ?>
			<div id="<?= $emh . '_' . $row['id_mtg'] . '_er'; ?>" class="errors-reported">Attention: There have been <?= $row['issues'] ?> issues reported with this meeting that the Host has not addressed yet. If you find the meeting abandoned or if any of the links do not work correctly please use the link above, &quot;Log issue&quot; to help keep the information on this site reliable. If 3 issues go unaddressed the meeting will be removed from the site until the necessary corrections are made.</div>
		<?php } ?>



<?php /* } */ ?>

<?php if (($row['dedicated_om'] == '0') && (trim($row['meet_phone']) == '') && (trim($row['meet_id']) == '') && (trim($row['meet_pswd']) == '') && (trim($row['meet_url']) == '')) { $full_width = 'true'; } else { $full_width = 'false'; ?>
					<div class="details-left<?php if (trim($row['meet_url']) != '') { echo " l-stacked"; } ?>">
<?php /* if ($row['dedicated_om'] != 0) { ?><p class="dd-meet">Dedicated Online Meeting</p> } */ ?>
<?php 					if (trim($row['meet_phone']) != '') { ?>
						<p class="phone-num01"><i class="fas fa-mobile-alt"></i> <a class="phone" href="tel:<?=  "(" .substr($row['meet_phone'], 0, 3).") ".substr($row['meet_phone'], 3, 3)."-".substr($row['meet_phone'],6); ?>"><?=  "(" .substr($row['meet_phone'], 0, 3).") ".substr($row['meet_phone'], 3, 3)."-".substr($row['meet_phone'],6); ?></a></p><?php } ?>


<?php 		if (trim($row['meet_url']) != '') { ?>
						<p class="zoom-info">Zoom Information</p>
<?php } ?>


<?php 		if (($row['meet_id'] != '') && ($row['meet_id'] != 'No ID Necessary')) { ?>
						<p class="id-num">ID: <input id="<?php if (!isset($ic)) { echo "ic"; } else { echo $ic; } ?>" type="text" value="<?php echo $row['meet_id']; ?>" class="day-values input-copy"></p>

						<a data-role="ic" data-id="<?php if (!isset($ic)) { echo "ic"; } else { echo $ic; } ?>" class="zoom-id"><i class="far fa-arrow-alt-circle-up"></i> Copy ID</a>

<?php } ?>
<?php 		if (trim($row['meet_pswd']) != '') { ?>
						<p class="id-num">Password: <input id="<?php if (!isset($ic)) { echo "pc"; } else { echo $pc; } ?>" type="text" value="<?php echo $row['meet_pswd']; ?>" class="day-values input-copyz"></p>

						<a data-role="pc" data-id="<?php if (!isset($ic)) { echo "pc"; } else { echo $pc; } ?>" class="zoom-id"><i class="far fa-arrow-alt-circle-up"></i> Copy Password</a>

<?php } ?>


<?php 					if (trim($row['meet_url']) != '') { ?>
						<p><a href="<?= h($row['meet_url']); ?>" class="zoom" target="_blank">JOIN ZOOM MEETING</a></p>
<?php } ?>
					</div><!-- .details-left -->
<?php } ?>
					<div class="details-right<?php if (trim($row['meet_url']) != '') { echo " rt-stacked"; } ?>" <?php if ($full_width == 'true') { echo " style=\"width:100%;\""; } ?>>

<?php 				if (trim($row['meet_addr']) != '') { ?>

						<div id="map">
							<iframe
							  width="100%"
							  height="180"
							  style="border:0"
							  loading="lazy"
							  allowfullscreen
							  src="https://www.google.com/maps/embed/v1/place?key=<?= MAP_KEY ?>
							    &q=<?= preg_replace( "/\r|\n/", " ", h($row['meet_addr'])); ?>">
							</iframe>
						</div>

<?php 			if ((trim($row['meet_addr']) != '') && (trim($row['meet_desc']) != '')) { ?>
						<p style="text-align:center;margin-bottom:1em;"><?= nl2br($row['meet_desc']); ?></p>
					<?php } else { ?>
						<p style="text-align:center;margin-bottom:1em;"><?= nl2br($row['meet_addr']); ?></p>
					<?php } ?>

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
							if ($row['code_beg'] != 0) 	{ ?> <li>Beginner's Meeting</li> 					
						<?php }
							if ($row['code_h'] != 0) 		{ ?> <li>Handicap Accessible</li> 
						<?php }
							if ($row['code_d'] != 0) 		{ ?> <li>Discussion</li> 							
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

					<?php if ($row['link1'] != '' || $row['link2'] != '' || $row['link3'] != '' || $row['link4'] != '') { ?>
						<div id="upload-links">
							<p class="mtg-files">Meeting files</p>
							<?php if ($row['link1'] != '') { ?><a href="<?= WWW_ROOT ?>/uploads/<?= h(($row['file1'])) ?>" class="mtg-links" target="_blank"><?= h(($row['link1'])) ?></a><?php } ?>

							<?php if ($row['link2'] != '') { ?><a href="<?= WWW_ROOT ?>/uploads/<?= h(($row['file2'])) ?>" class="mtg-links" target="_blank"><?= h(($row['link2'])) ?></a><?php } ?>

							<?php if ($row['link3'] != '') { ?><a href="<?= WWW_ROOT ?>/uploads/<?= h(($row['file3'])) ?>" class="mtg-links" target="_blank"><?= h(($row['link3'])) ?></a><?php } ?>

							<?php if ($row['link4'] != '') { ?><a href="<?= WWW_ROOT ?>/uploads/<?= h(($row['file4'])) ?>" class="mtg-links" target="_blank"><?= h(($row['link4'])) ?></a><?php } ?>
						</div>
					<?php } ?>

					<?php if(trim($row['add_note']) != '') { ?><div id="add-note"><p><?= nl2br(h($row['add_note'])) ?></p></div><?php } ?>
				</div><!-- .meeting-details -->