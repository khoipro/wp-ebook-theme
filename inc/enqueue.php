<?php

function register_jquery() {
	if (!is_admin()) {
		wp_deregister_script('jquery-core');
		wp_register_script('jquery-core', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', true, '3.2.1');
		wp_enqueue_script('jquery-core');
		wp_deregister_script('jquery-migrate');
	}
}
add_action( 'wp_enqueue_scripts', 'register_jquery' );

function register_scripts() {
	wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.min.css', array(), '1.0' );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery-core'), '1.0', true );
	// Register AJAX
	wp_localize_script( 'main', 'EBOOK_SUBMIT', array(
			'root' => esc_url_raw( rest_url() ),
			'nonce' => wp_create_nonce( 'wp_rest' ),
			'success' => __( 'Cảm ơn vì đã gửi ebook!', 'sachkindle' ),
			'failure' => __( 'Xin lỗi, gặp vấn đề khi gửi ebook lên hệ thống.', 'sachkindle' ),
			'current_user_id' => get_current_user_id()
		)
	);
}
add_action( 'wp_enqueue_scripts', 'register_scripts' );

function dequeue_oembed() {
	wp_dequeue_script('wp-embed');
}
add_action('wp_footer', 'dequeue_oembed');
