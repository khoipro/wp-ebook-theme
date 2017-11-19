<form name="resetpasswordform" id="resetpasswordform" action="<?php echo site_url('wp-login.php?action=resetpass', 'login_post') ?>" method="post">
	<p class="form-password">
		<label for="pass1">New Password</label>
		<input class="text-input" name="pass1" type="password" id="pass1">
	</p>

	<p class="form-password">
		<label for="pass2">Confirm Password</label>
		<input class="text-input" name="pass2" type="password" id="pass2">
	</p>

	<input type="hidden" name="redirect_to" value="/login/?action=resetpass&amp;success=1">
	<?php
	$rp_key = '';
	$rp_cookie = 'wp-resetpass-' . COOKIEHASH;
	if ( isset( $_COOKIE[ $rp_cookie ] ) && 0 < strpos( $_COOKIE[ $rp_cookie ], ':' ) ) {
		list( $rp_login, $rp_key ) = explode( ':', wp_unslash( $_COOKIE[ $rp_cookie ] ), 2 );
	}
	?>
	<input type="hidden" name="rp_key" value="<?php echo esc_attr( $rp_key ); ?>">
	<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Get New Password" /></p>
</form>
