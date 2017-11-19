<?php

/**
 * Theme URI
 * @internal for theme path, use TEMPLATEPATH constant
 */
if ( !defined( 'THEME_URI' ) ) {
	define( 'THEME_URI', get_template_directory_uri() );
}

/**
 * Components PATH
 */
if ( !defined( 'COMPONENTS_DIR' ) ) {
	define( 'COMPONENTS_DIR', TEMPLATEPATH . '/components' );
}

/**
 * Uploads PATH and URI
 */
$upload_dir = wp_upload_dir();
if ( !defined('UPLOADS_DIR')) {
	define( 'UPLOADS_DIR', $upload_dir['basedir'] );
}

if ( !defined('UPLOADS_URI')){
	define( 'UPLOADS_URI', $upload_dir['baseurl'] );
}

if ( ! function_exists( '_wp_render_title_tag' ) ) :
	/**
	 * Wordpress 4.4 deprecates wp_title(), but this may change.
	 * @link https://make.wordpress.org/core/2015/10/20/document-title-in-4-4/
	 */
	function theme_slug_render_title() {
		echo '<title>';
		wp_title( '|', true, 'right' );
		echo '</title>';
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
endif;

error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
//error_reporting(0);
