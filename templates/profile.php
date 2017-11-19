<?php
/*
 * Template Name: Profile
 */

if ( !is_user_logged_in() ){
	wp_redirect( home_url('/login/?redirect_to=' . get_permalink()) );
}

global $current_user;
get_currentuserinfo();
if ( !empty($_POST) && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {
	/* Update user password */
	if ( !empty($_POST['current_pass']) && !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
		if ( !wp_check_password( $_POST['current_pass'], $current_user->user_pass, $current_user->ID) ) {
			$error = 'Mật khẩu hiên tại của bạn không đúng. Vui lòng thử lại!';
		} elseif ( $_POST['pass1'] != $_POST['pass2'] ) {
			$error = 'Mật khẩu mới nhập không trùng nhau. Vui lòng thử lại!';
		} elseif ( strlen($_POST['pass1']) < 4 ) {
			$error = 'Mật khẩu quá ngắn, vui lòng nhập tối thiểu 8 kí tự';
		} elseif ( false !== strpos( wp_unslash($_POST['pass1']), "\\" ) ) {
			$error = 'Mật khẩu không thể chứa kí tự "\\" (backslash).';
		} else {
			$error = wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
			if ( !is_int($error) ) {
				$error = 'Có lỗi xảy ra, vui lòng thử lại hoặc liên hệ admin.';
			} else {
				$error = false;
			}
		}
		if ( empty($error) ) {
			do_action('edit_user_profile_update', $current_user->ID);
			wp_redirect( site_url('/profile/') . '?success=1' );
			exit;
		}
	}
}
?>

<?php get_header(); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="page-<?php the_ID(); ?>" class="meta-box hentry">
					<div class="post-content cf">

						<?php if ( !empty($_GET['success']) ): ?>
							<div class="message-box message-success">
								<span class="icon-thumbs-up"></span>
								Chúc mừng, bạn đã cập nhật thành công tài khoản!
							</div>
						<?php elseif ( !empty($error) ): ?>
							<div class="message-box message-error">
								<span class="icon-thumbs-up"></span>
								<?php echo $error; ?>
							</div>
						<?php endif; ?>

						<header class="section__header">
							<h1 class="section__headline">Chào <span class="userColor"><?php echo esc_html($current_user->display_name); ?></span>!</h1>
							<p>Bạn có thể thực hiện các thao tác thay đổi tài khoản tại đây.</p>
							<div class="section__header-link">
								<a href="<?php echo wp_logout_url( home_url('/') ); ?>">đăng xuất</a>
							</div>
						</header>

						<div class="section__content">
							<h2>Đổi mật khẩu</h2>
							<form method="post" class="form" id="adduser" action="/profile/">
								<div class="form__row">
									<label for="current_pass">Mật khẩu hiện tại</label>
									<input class="text-input" name="current_pass" type="password" id="current_pass" required aria-required="true">
								</div>
								<div class="form__row">
									<label for="pass1">Mật khẩu mới</label>
									<input class="text-input" name="pass1" type="password" id="pass1">
								</div>
								<div class="form__row">
									<label for="pass2">Xác nhận mật khẩu mới</label>
									<input class="text-input" name="pass2" type="password" id="pass2">
								</div>
								<?php
								do_action('edit_user_profile', $current_user);
								?>
								<div class="form__row form__footer">
									<button name="updateuser" id="updateuser" class="button"><?php _e('Cập nhật', 'sachkindle'); ?></button>
									<input name="action" type="hidden" id="action" value="update-user">
								</div>
							</form>
						</div>
					</div>
				</article>

			<?php endwhile; ?>

		</div><!-- .main-column -->

		<?php get_sidebar(); ?>
	</main><!-- #main -->

<?php get_footer(); ?>
