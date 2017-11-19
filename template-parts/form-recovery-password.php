<form name="lostpasswordform" id="lostpasswordform" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" method="post">
	<p>
		<label for="user_login">Username or E-mail:</label>
		<input type="text" name="user_login" id="user_login" class="input" value="">
	</p>

	<input type="hidden" name="redirect_to" value="/login/?action=forgot&amp;success=1">
	<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Get New Password" /></p>
</form>
