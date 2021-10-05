<div id="tz" class="set-tz">
	<div class="tz-box">
		<h3>Set Timezone</h3>
		<div class="tz-content">
			<!-- <p>Let's set the timezone for this website. I will try to remember your setting on this device. You can always change it in the future from the Menu.</p> -->
			<p class="next-p">Select your timezone:</p>
			<form action="" method="post">
				<select class="pick-tz" name="timezone">
					<option value="empty"><?php echo timezone_select_options($tz); ?></option>
				</select>
				<input type="submit" name="set-tz" value="OK">
				<input type="button" id="hide-tz" value="CANCEL">

			</form>
		</div>
	</div>
</div>