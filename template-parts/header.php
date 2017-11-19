<header class="header">
	<div class="container header__container">
		<div class="header__block">
			<div class="header__logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo bloginfo('name'); ?></a>
			</div>
			<div class="header__search-form">
				<?php get_search_form(); ?>
			</div>
		</div>
		<?php
		if( has_nav_menu('header') ) :
			wp_nav_menu( array(
				'theme_location' => 'header',
				'container' => 'nav',
				'container_class' => 'header__nav',
				'menu_class' => 'header__menu'
			) );
		endif;
		?>
	</div>
</header>