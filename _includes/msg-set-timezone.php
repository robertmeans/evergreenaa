<?php 
if ($new_tz == 'member') { ?>
	<div class="set-tz">
		<div class="tz-box">
			<h3>Set Timezone</h3>
			<div class="tz-content">
				<p>Looks like you're logged in but don't have a timezone set for your account. Set it now and I won't forget. You can always change it in the future from the Menu.</p>
				<p class="next-p">Select your timezone:</p>
				<form id="init-set-tz" action="" method="post">
					<select id="init-tz-select" class="pick-tz" name="timezone">
						<option value="empty"><?php echo timezone_select_options(); ?></option>
					</select>
					<input id="tz-url" type="hidden" name="tz-url">
					<input type="hidden" name="set-tz">
					<div id="init-pick-tz"></div>
					<a id="init-tz-submit" class="btn">OK</a>
				</form>
			</div>
		</div>
	</div>
<?php return;
} elseif ($new_tz == 'visitor') { ?>
	<div class="set-tz">
		<div class="tz-box">
			<h3>Set Timezone</h3>
			<div class="tz-content">
				<p>Let's set your timezone for this website. You're not logged in but I will try to remember your setting on this browser. You can always change it in the future from the Menu.</p>
				<p class="next-p">Select your timezone:</p>
				<form id="init-set-tz" action="" method="post">
					<select id="init-tz-select" class="pick-tz" name="timezone">
						<option value="empty"><?php echo timezone_select_options(); ?></option>
					</select>
					<input id="tz-url" type="hidden" name="tz-url">
					<input type="hidden" name="set-tz">
					<div id="init-pick-tz"></div>
					<a id="init-tz-submit" class="btn">OK</a>
				</form>
			</div>
		</div>
	</div>
<?php return; 
} elseif ($new_tz == 'no-cookies') { ?>
	<div class="set-tz">
		<div class="tz-box">
			<h3>Set Timezone</h3>
			<div class="tz-content">
				<p>Looks like you're on a device that won't allow me to save your timezone setting. We'll need to set it on a per visit basis. If you need to change it during this visit you can do so from the Menu.</p>
				<p class="next-p">Select your timezone:</p>
				<form id="init-set-tz" action="" method="post">
					<select id="init-tz-select" class="pick-tz" name="timezone">
						<option value="empty"><?php echo timezone_select_options(); ?></option>
					</select>
					<input id="tz-url" type="hidden" name="tz-url">
					<input type="hidden" name="set-tz">
					<div id="init-pick-tz"></div>
					<a id="init-tz-submit" class="btn">OK</a>
				</form>
			</div>
		</div>
	</div>
<?php return; } ?>

<div id="tz" class="set-tz">
	<div class="tz-box">
		<h3>Set Timezone</h3>
		<div class="tz-content">
			<!-- <p>Let's set the timezone for this website. I will try to remember your setting on this device. You can always change it in the future from the Menu.</p> -->
			<p class="next-p">Change your timezone:</p>
			<form id="tz-form" action="" method="post">
				<select id="tz-select" class="pick-tz" name="timezone">
					<option value="empty"><?php echo timezone_select_options($tz); ?></option>
				</select>
				<input id="tz-url" type="hidden" name="tz-url">
				<input type="hidden" name="set-tz">
				<div id="pick-tz"></div>
				<a id="tz-submit" class="btn">OK</a>
				<!-- <input type="submit" name="set-tz" value="OK"> -->
				<a id="hide-tz" class="btn cancel">Cancel</a>
			</form>
		</div>
	</div>
</div>
