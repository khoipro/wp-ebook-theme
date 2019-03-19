<?php

/**
 * Add theme support
 */
function kindlefan_setup() {
    add_theme_support('title-tag');
    add_theme_support( 'post-thumbnails' );
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        )
    );
}
add_action('init', 'kindlefan_setup');

function kindle_assets() {
    // Library
    wp_enqueue_script( 'bootstrap-bundle', get_theme_file_uri( '/assets/js/vendor/bootstrap/bootstrap.bundle.min.js' ), array('jquery'), '3.3.1', true );
    wp_enqueue_script( 'jquery-easing', get_theme_file_uri( '/assets/js/vendor/jquery-easing/jquery.easing.min.js' ), array('jquery'), '1.4.1', true );


    // Main Styles and Scripts
    wp_enqueue_style( 'kindlefan-style', get_theme_file_uri('/assets/css/main.min.css'), array(), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_script( 'kindlefan-scripts', get_theme_file_uri( '/assets/js/main.min.js' ), array('jquery'), wp_get_theme()->get( 'Version' ), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_localize_script( 'kindlefan-scripts', 'wpObj',
        array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' )
        )
    );

}
add_action( 'wp_enqueue_scripts', 'kindle_assets' );

function kindlefan_change_jquery() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', get_theme_file_uri('/assets/js/vendor/jquery/jquery.min.js'), false, '3.3.1');
        wp_enqueue_script('jquery');
    }
}
add_action('init', 'kindlefan_change_jquery');
