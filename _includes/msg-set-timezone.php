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
				<input type="hidden" name="set-tz">
				<div id="pick-tz"></div>
				<a id="tz-submit" class="btn">OK</a>
				<!-- <input type="submit" name="set-tz" value="OK"> -->
				<a id="hide-tz" class="btn cancel">Cancel</a>
			</form>
		</div>
	</div>
</div>