<?php
/**
 * Template Name: Register
 */
get_header('member');

while( have_posts() ) :

    the_post();

    get_template_part('modules/register');

endwhile;

get_footer('member');
?>
