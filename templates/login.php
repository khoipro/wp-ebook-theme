<?php
/**
 * Template Name: Login
 */
get_header('member');

while( have_posts() ) :

    the_post();

    get_template_part('modules/login');

endwhile;

get_footer('member');
?>
