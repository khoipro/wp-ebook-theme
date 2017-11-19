<form name="registerform" id="registerform" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">
	<div class="form__main">
		<p>
			<label for="user_login">Tên tài khoản</label>
			<input type="text" name="user_login" id="user_login" class="input" value="">
			<span class="hint">Vui lòng nhập không dấu, viết liền và không sử dụng kí tự đặc biệt.</span>
		</p>
		<p>
			<label for="user_email">E-mail</label>
			<input type="text" name="user_email" id="user_email" class="input" value="">
		</p>
		<p style="display:none">
			<label for="confirm_email">Please leave this field empty</label>
			<input type="text" name="confirm_email" id="confirm_email" class="input" value="">
		</p>
	</div>
	<div class="form__footer">
		<p class="hint">Mật khẩu sẽ được gửi qua email.</p>
		<input type="hidden" name="redirect_to" value="/login/?action=register&amp;success=1" />
		<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button" value="Đăng ký tài khoản" /></p>
	</div>
</form>
