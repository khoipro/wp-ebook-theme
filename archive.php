<?php get_header();

echo '<div class="archive">';

if( have_posts() && !is_tax() ) {
	echo '<header class="archive__header">';
	the_archive_title( '<h1 class="archive__headline">', '</h1>' );
	echo '</header>';
}

if( is_tax('ebook_category') ) :

	the_part('grid', array(
		'headline' => get_the_archive_title( '<h1 class="archive__headline">', '</h1>' ),
		'list' => get_ebook_archive_list( get_queried_object()->term_id )
	));

endif;

echo '</div>';

get_footer(); ?>
