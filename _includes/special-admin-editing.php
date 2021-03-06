<ul class="manage-weekdays">
<?php 
	$any_meetings_for_user = find_meetings_by_id($user_id);
	$result 	= mysqli_num_rows($any_meetings_for_user);
	// find out if user has any meetings they manage
	if ($result > 0) { ?>

<?php // if user has meetings to manage, display on a daily basis
	$users_sunday_meetings = find_meetings_by_id_today($user_id, $sunday);
	$sunday_meetings 	= mysqli_num_rows($users_sunday_meetings);

	if ($sunday_meetings > 0) { ?>
		
		<li class="ctr-day">
			<div class="manage-day-toggle day">Sunday</div>
			<div id="sunday-content" class="day-content">
			<?php include '_includes/collapse-day.php'; ?>

		<?php while ($row = mysqli_fetch_assoc($users_sunday_meetings)) { ?>

			<?php require '_includes/manage-glance.php'; ?>
			<div class="weekday-wrap<?php if ('visible' == 0) { echo ' draft-bkg'; }  ?>">
				<?php require '_includes/meeting-details.php'; ?>
			</div><!-- .weekday-wrap -->

		<?php } mysqli_free_result($users_sunday_meetings); ?>

			</div><!-- #sunday-content .day-content -->
		</li>

	<?php } 

	// if user has meetings to manage, display on a daily basis
	$users_monday_meetings = find_meetings_by_id_today($user_id, $monday);
	$monday_meetings 	= mysqli_num_rows($users_monday_meetings);

	if ($monday_meetings > 0) { ?>
		
		<li class="ctr-day">
			<div class="manage-day-toggle day">Monday</div>
			<div id="sunday-content" class="day-content">
			<?php include '_includes/collapse-day.php'; ?>

		<?php while ($row = mysqli_fetch_assoc($users_monday_meetings)) { ?>

			<?php require '_includes/manage-glance.php'; ?>
			<div class="weekday-wrap<?php if ('visible' == 0) { echo ' draft-bkg'; }  ?>">
				<?php require '_includes/meeting-details.php'; ?>
			</div><!-- .weekday-wrap -->

		<?php } mysqli_free_result($users_monday_meetings); ?>

			</div><!-- #sunday-content .day-content -->
		</li>

	<?php } 

	// if user has meetings to manage, display on a daily basis
	$users_tuesday_meetings = find_meetings_by_id_today($user_id, $tuesday);
	$tuesday_meetings 	= mysqli_num_rows($users_tuesday_meetings);

	if ($tuesday_meetings > 0) { ?>
		
		<li class="ctr-day">
			<div class="manage-day-toggle day">Tuesday</div>
			<div id="sunday-content" class="day-content">
			<?php include '_includes/collapse-day.php'; ?>

		<?php while ($row = mysqli_fetch_assoc($users_tuesday_meetings)) { ?>

			<?php require '_includes/manage-glance.php'; ?>
			<div class="weekday-wrap<?php if ('visible' == 0) { echo ' draft-bkg'; }  ?>">
				<?php require '_includes/meeting-details.php'; ?>
			</div><!-- .weekday-wrap -->

		<?php } mysqli_free_result($users_tuesday_meetings); ?>

			</div><!-- #sunday-content .day-content -->
		</li>

	<?php }

	// if user has meetings to manage, display on a daily basis
	$users_wednesday_meetings = find_meetings_by_id_today($user_id, $wednesday);
	$wednesday_meetings 	= mysqli_num_rows($users_wednesday_meetings);

	if ($wednesday_meetings > 0) { ?>
		
		<li class="ctr-day">
			<div class="manage-day-toggle day">Wednesday</div>
			<div id="sunday-content" class="day-content">
			<?php include '_includes/collapse-day.php'; ?>

		<?php while ($row = mysqli_fetch_assoc($users_wednesday_meetings)) { ?>

			<?php require '_includes/manage-glance.php'; ?>
			<div class="weekday-wrap<?php if ('visible' == 0) { echo ' draft-bkg'; }  ?>">
				<?php require '_includes/meeting-details.php'; ?>
			</div><!-- .weekday-wrap -->

		<?php } mysqli_free_result($users_wednesday_meetings); ?>

			</div><!-- #sunday-content .day-content -->
		</li>

	<?php }

	// if user has meetings to manage, display on a daily basis
	$users_thursday_meetings = find_meetings_by_id_today($user_id, $thursday);
	$thursday_meetings 	= mysqli_num_rows($users_thursday_meetings);

	if ($thursday_meetings > 0) { ?>
		
		<li class="ctr-day">
			<div class="manage-day-toggle day">Thursday</div>
			<div id="sunday-content" class="day-content">
			<?php include '_includes/collapse-day.php'; ?>

		<?php while ($row = mysqli_fetch_assoc($users_thursday_meetings)) { ?>

			<?php require '_includes/manage-glance.php'; ?>
			<div class="weekday-wrap<?php if ('visible' == 0) { echo ' draft-bkg'; }  ?>">
				<?php require '_includes/meeting-details.php'; ?>
			</div><!-- .weekday-wrap -->

		<?php } mysqli_free_result($users_thursday_meetings); ?>

			</div><!-- #sunday-content .day-content -->
		</li>

	<?php }	

	// if user has meetings to manage, display on a daily basis
	$users_friday_meetings = find_meetings_by_id_today($user_id, $friday);
	$friday_meetings 	= mysqli_num_rows($users_friday_meetings);

	if ($friday_meetings > 0) { ?>
		
		<li class="ctr-day">
			<div class="manage-day-toggle day">Friday</div>
			<div id="sunday-content" class="day-content">
			<?php include '_includes/collapse-day.php'; ?>

		<?php while ($row = mysqli_fetch_assoc($users_friday_meetings)) { ?>

			<?php require '_includes/manage-glance.php'; ?>
			<div class="weekday-wrap<?php if ('visible' == 0) { echo ' draft-bkg'; }  ?>">
				<?php require '_includes/meeting-details.php'; ?>
			</div><!-- .weekday-wrap -->

		<?php } mysqli_free_result($users_friday_meetings); ?>

			</div><!-- #sunday-content .day-content -->
		</li>

	<?php }	

	// if user has meetings to manage, display on a daily basis
	$users_saturday_meetings = find_meetings_by_id_today($user_id, $saturday);
	$saturday_meetings 	= mysqli_num_rows($users_saturday_meetings);

	if ($saturday_meetings > 0) { ?>
		
		<li class="ctr-day">
			<div class="manage-day-toggle day">Saturday</div>
			<div id="sunday-content" class="day-content">
			<?php include '_includes/collapse-day.php'; ?>

		<?php while ($row = mysqli_fetch_assoc($users_saturday_meetings)) { ?>

			<?php require '_includes/manage-glance.php'; ?>
			<div class="weekday-wrap<?php if ('visible' == 0) { echo ' draft-bkg'; }  ?>">
				<?php require '_includes/meeting-details.php'; ?>
			</div><!-- .weekday-wrap -->

		<?php } mysqli_free_result($users_saturday_meetings); ?>

			</div><!-- #sunday-content .day-content -->
		</li>

	<?php }

	} else { // user has no meetings to manage
		echo "<p style=\"margin-top:0.5em;padding:0px 1em;\">When you add a meeting it will display here and wherever else you choose. You can make your meetings public or keep them private. Add a new meeting and give it a try.</p>";
	}  mysqli_free_result($any_meetings_for_user); ?>

</ul><!-- .manage-weekdays -->