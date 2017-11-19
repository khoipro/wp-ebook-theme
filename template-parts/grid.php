<?php if( !empty($list) ) : ?>
<section class="grid">
	<div class="grid__inner">
		<?php if( !empty($headline) ) : ?>
			<h2 class="grid__headline"><?php echo $headline; ?></h2>
		<?php endif; ?>
		<div class="grid__list">
			<?php foreach( $list as $item ) :
				the_part( 'block', array(
					'class' => 'block--grid',
					'item' => $item
				) );
			endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>
