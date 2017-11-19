<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<main class="main">
		<?php if( !is_landing_page() ) : ?>
			<?php get_sidebar(); ?>
			<div class="section">
				<div class="section__inner">
		<?php else : ?>
			<div class="section-landing">
				<div class="section__inner">
		<?php endif; ?>
