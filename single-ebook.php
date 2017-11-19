<?php get_header();

while( have_posts() ) : the_post();

	the_part('content-ebook');

endwhile;

get_footer(); ?>
