<div class="sidebar" data-module-init="sidebar">
	<div class="sidebar__inner">
		<div class="sidebar__header">
			<h1 class="sidebar__headline"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
		</div>
		<div class="sidebar__content js-content">
			<?php
			if ( is_active_sidebar( 'main' ) ) :
				dynamic_sidebar( 'main' );
			endif;
			the_part('widget-account');
			?>
		</div>
		<div class="sidebar__toggle js-toggle">
			<span class="sidebar__toggle-bar"></span>
			<span class="sidebar__toggle-bar"></span>
			<span class="sidebar__toggle-bar"></span>
		</div>
	</div>
</div>
