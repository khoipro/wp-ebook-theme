<?php
/* Template Name: Register */
$action = !empty( $_GET['action'] ) && ($_GET['action'] == 'register' || $_GET['action'] == 'forgot' || $_GET['action'] == 'resetpass') ? $_GET['action'] : 'login';
$success = !empty( $_GET['success'] );
$failed = !empty( $_GET['failed'] ) ? $_GET['failed'] : false;
get_header(); ?>
<?php if ( !is_user_logged_in() ) : ?>
	<header class="section__header">
		<h1 class="section__headline"><?php _e('Đăng ký tài khoản', 'sachkindle'); ?></h1>
		<p>Đã có tài khoản? <a href="<?php echo home_url( '/login/' ); ?>">Đăng nhập ngay</a>!</p>
	</header>
	<div class="section__content">
		<div class="form">
			<div class="form__header">
				<p>Với tài khoản trên website, bạn có thể đăng ebook và đánh giá ebook.</p>
			</div>
			<?php the_part('form-register'); ?>
		</div>
	</div>
	<footer class="section__footer">
		<p><a href="<?php echo home_url('/'); ?>">Trở lại trang chủ</a></p>
	</footer>
<?php else :
	wp_redirect( home_url('/profile/') );
endif; ?>
<?php get_footer(); ?>
