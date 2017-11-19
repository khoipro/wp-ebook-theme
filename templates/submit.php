<?php
/* Template Name: Submit Ebook */
get_header();

if ( !is_page('login') && !is_user_logged_in() ){
	wp_redirect( home_url('/login/?redirect_to=' . get_permalink()) );
}

if ( is_admin() ) {
	$status = 'publish';
} else {
	$status = 'pending';
}

if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == "ebook") {
	$args = array(
		'post_title' => $_POST['post-submission-title'],
		'post_content' => $_POST['post-submission-content'],
		'post_status' => $status,
		'post_type' => $_POST['action'],
		'ebook_category' => $_POST['post-submission-ebook-category']
	);
	$pid = wp_insert_post( $args );
	if(!is_wp_error($pid) ) {
		add_post_meta($pid, 'ebook-link', $_POST['post-submission-ebook-link'], true);
		add_post_meta($pid, 'ebook-cover-image', $_POST['post-submission-ebook-cover-image'], true);
		add_post_meta($pid, 'ebook-filetype', $_POST['post-submission-ebook-filetype']);
		wp_set_object_terms( $pid, $_POST['post-submission-ebook-category'], 'ebook_category', false );
		echo '<div class="message-box message-success">Chúc mừng, bạn đã đăng ebook thành công. Chúng tôi sẽ duyệt và đăng ebook trong 24 giờ tới. Xin cảm ơn bạn!</div>';
	} else {
		echo '<div class="message-box message-error">Có lỗi xảy ra, vui lòng thông báo cho admin.</div>';
	}
}


while( have_posts() ) : the_post(); ?>

<header class="section__header">
	<h1 class="section__headline"><?php _e('Đăng ebook', 'sachkindle'); ?></h1>
</header>
<div class="section__content">
	<?php the_content(); ?>
</div>
<?php
endwhile;
get_footer(); ?>
