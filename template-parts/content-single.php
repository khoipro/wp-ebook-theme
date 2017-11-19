<article class="article">
	<div class="article__inner">
		<?php if( has_post_thumbnail() ) : ?>
			<div class="article__thumbnail">
				<img class="article__image" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
			</div>
		<?php endif; ?>
		<div class="article__content">
			<h1 class="article__headline"><?php the_title(); ?></h1>
			<div class="wysiwyg article__intro">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</article>
