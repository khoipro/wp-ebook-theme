<?php

/*
 * Register widgets
 */

function register_widgets() {
	// Sidebars
	register_sidebar(array(
		'name'          => __('Main Sidebar', 'roots'),
		'id'            => 'main',
		'before_widget' => '<div class="widget widget--main %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
	));
	register_sidebar(array(
		'name'          => __('Product Sidebar', 'roots'),
		'id'            => 'product',
		'before_widget' => '<div class="widget widget--product %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
	));
}
add_action('widgets_init', 'register_widgets');

/*
 * Register term widget
 */

// Register and load the widget
function load_custom_widgets() {
	register_widget( 'ebook_cat_menu' );
}

add_action( 'widgets_init', 'load_custom_widgets' );

// Creating the widget
class ebook_cat_menu extends WP_Widget {

	function __construct() {
		parent::__construct(

// Base ID of your widget
			'ebook_cat_menu',

// Widget name will appear in UI
			__('Ebook Categories', 'sackindle'),

// Widget description
			array( 'description' => __( 'Widget to display Ebook Categories as menu', 'sachkindle' ), )
		);
	}

// Creating widget front-end

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$tax_name = !empty( $instance['tax_name'] ) ? $instance['tax_name'] : '';

// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

// This is where you run the code and display the output
		if( !empty( $tax_name ) ) {
			$term_list = get_terms( array(
				'taxonomy' => $tax_name,
				'hide_empty' => false
			) );
			if( $term_list ) {
				echo '<ul class="widget__list">';
				foreach( $term_list as $term ) {
					echo '<li class="widget__list-item">';
					echo '<a href="' . get_term_link( $term ) . '" class="widget__list-link">';
					echo $term->name;
					echo '</a>';
					echo '</li>';
				}
				echo '</ul>';
			}
		}
		echo $args['after_widget'];
	}

// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Term Category', 'sachkindle' );
		}
// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tax_name' ); ?>"><?php _e('Select taxonomy:'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'tax_name' ); ?>" name="<?php echo $this-> get_field_name( 'tax_name' ); ?>">
				<?php $taxonomies = get_taxonomies(); foreach( $taxonomies as $taxonomy ) : ?>
					<option <?php selected( $instance['tax_name'], $taxonomy); ?> value="<?php echo $taxonomy; ?>"><?php echo $taxonomy; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<?php
	}

// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['tax_name'] = ( ! empty( $new_instance['tax_name'] ) ) ? $new_instance['tax_name'] : '';
		return $instance;
	}
}


