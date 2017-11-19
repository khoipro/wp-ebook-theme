<?php
/* Template Name: Contributors */
get_header();

if ( !is_user_logged_in() ) {
	wp_redirect( home_url('/login/?redirect_to=' . get_permalink()) );
}
global $current_user;
get_currentuserinfo();

?>

<header class="section__header">
	<h1 class="section__headline">Chào <span class="userColor"><?php echo esc_html($current_user->display_name); ?></span>!</h1>
	<p>Cảm ơn vì đã trở thành Cộng tác viên tại <strong><?php bloginfo('name'); ?></strong>.</p>
	<div class="section__header-link">
		<a href="<?php echo wp_logout_url( home_url('/') ); ?>">đăng xuất</a>
	</div>
</header>

<div class="section__content wysiwyg">
	<h2 class="section__title">Thông báo mới nhất</h2>
	<?php
	while( have_posts() ) : the_post();
		the_content();
	endwhile;
	?>
</div>

<?php
get_footer();
?>
