<?php

/*
 * Add WordPress native support
 */

function sachkindle_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	register_nav_menus( array(
		'primary'    => __( 'Primary', 'sachkindle' ),
		'user'       => __('User Menu', 'sachkindle' )
	) );
}
add_action('after_setup_theme', 'sachkindle_setup' );

// Register Custom Post Type
function register_ebook_post_type() {

	$labels = array(
		'name'                  => _x( 'Ebooks', 'Post Type General Name', 'sachkindle' ),
		'singular_name'         => _x( 'Ebook', 'Post Type Singular Name', 'sachkindle' ),
		'menu_name'             => __( 'Ebooks', 'sachkindle' ),
		'name_admin_bar'        => __( 'Ebooks', 'sachkindle' ),
		'archives'              => __( 'Item Archives', 'sachkindle' ),
		'attributes'            => __( 'Item Attributes', 'sachkindle' ),
		'parent_item_colon'     => __( 'Parent Item:', 'sachkindle' ),
		'all_items'             => __( 'All Items', 'sachkindle' ),
		'add_new_item'          => __( 'Add New Item', 'sachkindle' ),
		'add_new'               => __( 'Add New', 'sachkindle' ),
		'new_item'              => __( 'New Item', 'sachkindle' ),
		'edit_item'             => __( 'Edit Item', 'sachkindle' ),
		'update_item'           => __( 'Update Item', 'sachkindle' ),
		'view_item'             => __( 'View Item', 'sachkindle' ),
		'view_items'            => __( 'View Items', 'sachkindle' ),
		'search_items'          => __( 'Search Item', 'sachkindle' ),
		'not_found'             => __( 'Not found', 'sachkindle' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'sachkindle' ),
		'featured_image'        => __( 'Featured Image', 'sachkindle' ),
		'set_featured_image'    => __( 'Set featured image', 'sachkindle' ),
		'remove_featured_image' => __( 'Remove featured image', 'sachkindle' ),
		'use_featured_image'    => __( 'Use as featured image', 'sachkindle' ),
		'insert_into_item'      => __( 'Insert into item', 'sachkindle' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'sachkindle' ),
		'items_list'            => __( 'Items list', 'sachkindle' ),
		'items_list_navigation' => __( 'Items list navigation', 'sachkindle' ),
		'filter_items_list'     => __( 'Filter items list', 'sachkindle' ),
	);
	$args = array(
		'label'                 => __( 'Ebook', 'sachkindle' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'author' ),
		'taxonomies'            => array( 'ebook_category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-book',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'ebook', $args );

}
add_action( 'init', 'register_ebook_post_type', 0 );

// Register Custom Taxonomy Ebook Category
function register_ebook_tax() {

	$labels = array(
		'name'                       => _x( 'Ebook Categories', 'Taxonomy General Name', 'sachkindle' ),
		'singular_name'              => _x( 'Ebook Category', 'Taxonomy Singular Name', 'sachkindle' ),
		'menu_name'                  => __( 'Ebook Category', 'sachkindle' ),
		'all_items'                  => __( 'All Items', 'sachkindle' ),
		'parent_item'                => __( 'Parent Item', 'sachkindle' ),
		'parent_item_colon'          => __( 'Parent Item:', 'sachkindle' ),
		'new_item_name'              => __( 'New Item Name', 'sachkindle' ),
		'add_new_item'               => __( 'Add New Item', 'sachkindle' ),
		'edit_item'                  => __( 'Edit Item', 'sachkindle' ),
		'update_item'                => __( 'Update Item', 'sachkindle' ),
		'view_item'                  => __( 'View Item', 'sachkindle' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'sachkindle' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'sachkindle' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'sachkindle' ),
		'popular_items'              => __( 'Popular Items', 'sachkindle' ),
		'search_items'               => __( 'Search Items', 'sachkindle' ),
		'not_found'                  => __( 'Not Found', 'sachkindle' ),
		'no_terms'                   => __( 'No items', 'sachkindle' ),
		'items_list'                 => __( 'Items list', 'sachkindle' ),
		'items_list_navigation'      => __( 'Items list navigation', 'sachkindle' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'ebook_category', array( 'ebook' ), $args );

}
add_action( 'init', 'register_ebook_tax', 0 );

function allowAuthorEditing() {
	add_post_type_support( 'ebook', 'author' );
}

add_action('init','allowAuthorEditing');

// show admin bar only for admins
if (!current_user_can('manage_options')) {
	add_filter('show_admin_bar', '__return_false');
}

// disable access wp-admin except admin
add_action( 'init', 'blockusers_init' );
function blockusers_init() {
	if ( is_admin() && ! current_user_can( 'administrator' ) &&
		! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		wp_redirect( home_url('/profile/?not-allowed') );
		exit;
	}
}

function add_favicon() { ?>
	<?php $favicon_url = get_template_directory_uri() . '/assets/icon'; ?>
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo $favicon_url; ?>/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $favicon_url; ?>/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $favicon_url; ?>/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $favicon_url; ?>/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo $favicon_url; ?>/apple-touch-icon-60x60.png" />
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo $favicon_url; ?>/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo $favicon_url; ?>/apple-touch-icon-76x76.png" />
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo $favicon_url; ?>/apple-touch-icon-152x152.png" />
	<link rel="icon" type="image/png" href="<?php echo $favicon_url; ?>/favicon-196x196.png" sizes="196x196" />
	<link rel="icon" type="image/png" href="<?php echo $favicon_url; ?>/favicon-96x96.png" sizes="96x96" />
	<link rel="icon" type="image/png" href="<?php echo $favicon_url; ?>/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="<?php echo $favicon_url; ?>/favicon-16x16.png" sizes="16x16" />
	<link rel="icon" type="image/png" href="<?php echo $favicon_url; ?>/favicon-128.png" sizes="128x128" />
	<meta name="application-name" content="&nbsp;"/>
	<meta name="msapplication-TileColor" content="#FFFFFF" />
	<meta name="msapplication-TileImage" content="<?php echo $favicon_url; ?>/mstile-144x144.png" />
	<meta name="msapplication-square70x70logo" content="<?php echo $favicon_url; ?>/mstile-70x70.png" />
	<meta name="msapplication-square150x150logo" content="<?php echo $favicon_url; ?>/mstile-150x150.png" />
	<meta name="msapplication-wide310x150logo" content="<?php echo $favicon_url; ?>/mstile-310x150.png" />
	<meta name="msapplication-square310x310logo" content="<?php echo $favicon_url; ?>/mstile-310x310.png" />
<?php }
add_action( 'wp_head', 'add_favicon' );
