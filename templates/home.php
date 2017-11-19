<?php
/* Template Name: Home */
get_header();

the_part('grid', array(
	'headline' => __('Sách mới nhất'),
	'list' => get_latest_ebooks()
));

get_footer(); ?>
