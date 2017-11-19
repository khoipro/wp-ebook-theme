<?php if( !empty($item) ) : ?>
	<article class="block<?php if( !empty($class) ) : echo ' ' . $class; endif; ?>">
		<div class="block__inner">
			<?php if( !empty($item['image']) ) : ?>
				<a class="block__image" href="<?php echo $item['url']; ?>">
					<figure class="block__figure" style="background-image: url('<?php echo $item['image']; ?>');"></figure>
				</a>
			<?php endif; ?>
			<div class="block__content">
				<h3 class="block__title">
					<a class="block__link" href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a>
				</h3>
				<?php if( !empty($item['content']) ) : ?>
					<div class="block__intro">
						<?php echo $item['content']; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</article>
<?php endif; ?>
