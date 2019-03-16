<?php
/**
 * Template Name: Recovery Password
 */
get_header('member');

while( have_posts() ) :

    the_post();

    get_template_part('modules/recovery-password');

endwhile;

get_footer('member');
?>
