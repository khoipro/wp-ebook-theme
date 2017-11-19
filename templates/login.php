<?php
/* Template Name: Login */
$action = !empty( $_GET['action'] ) && ($_GET['action'] == 'register' || $_GET['action'] == 'forgot' || $_GET['action'] == 'resetpass') ? $_GET['action'] : 'login';
$success = !empty( $_GET['success'] );
$failed = !empty( $_GET['failed'] ) ? $_GET['failed'] : false;
get_header(); ?>

<?php if ( !is_user_logged_in() ) : ?>
	<header class="section__header">
		<h1 class="section__headline"><?php _e('Đăng nhập', 'sachkindle'); ?></h1>
		<p>Chưa có tài khoản? <a href="<?php echo home_url( '/register/' ); ?>">Đăng ký ngay</a>!</p>
	</header>
	<div class="section__content">
		<div class="form">
			<?php wp_login_form(); ?>
		</div>
	</div>
	<footer class="section__footer">
		<p><a href="<?php echo home_url('/'); ?>">Trở lại trang chủ</a></p>
	</footer>
<?php else :
	if( isset($_REQUEST['redirect_to']) ){
		wp_redirect($_REQUEST['redirect_to']);
	} else {
		wp_redirect( home_url('/profile/') );
	}
	exit;
endif; ?>

<?php
get_footer(); ?>
