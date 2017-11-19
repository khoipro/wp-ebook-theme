<div class="widget widget--main widget--account">
	<div class="widget__inner">
		<?php if( is_user_logged_in() ) :
			$current_user_id = get_current_user_id();
			$current_user = get_userdata( $current_user_id );
		?>
			<h3 class="widget__title"><?php _e('Tài khoản', 'sachkindle'); ?></h3>
			<ul class="widget__info">
				<li>Chào <strong><?php echo $current_user->user_nicename; ?></strong>. Cảm ơn vì đã đăng nhập!</li>
			</ul>
			<ul class="widget__menu">
				<li>
					<a href="<?php echo home_url('/profile/'); ?>">Tài khoản</a>
				</li>
				<li>
					<a href="<?php echo home_url('/submit/'); ?>">Đăng ebook</a>
				</li>
				<?php if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) : ?>
					<li>
						<a href="<?php echo home_url('/cp/'); ?>">Thông báo nội bộ</a>
					</li>
				<?php endif; ?>
				<li>
					<a href="<?php echo wp_logout_url( home_url() ); ?>">Đăng xuất</a>
				</li>
			</ul>
		<?php else : ?>
			<h3 class="widget__title"><?php _e('Đăng nhập', 'sachkindle'); ?></h3>
			<ul>
				<li>
					<a href="<?php echo home_url('/login/'); ?>">Đăng nhập</a>
				</li>
				<li>
					<a href="<?php echo home_url('/register/'); ?>">Đăng ký</a>
				</li>
			</ul>
		<?php endif; ?>
	</div>
</div>
