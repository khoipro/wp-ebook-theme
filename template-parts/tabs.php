<?php if( !empty($tabs) ) : ?>
	<div class="tab" data-module-init="tabs">
		<div class="tab__inner">
			<header class="tab-header">
				<ul class="tab-header__list">
					<?php foreach( $tabs as $tab ) : ?>
						<li class="tab-header__item" data-tab-content="#<?php echo sanitize_title($tab['title']); ?>"><?php echo $tab['title']; ?></li>
					<?php endforeach; ?>
				</ul>
			</header>
			<div class="tab-content">
				<?php foreach( $tabs as $tab ) : ?>
					<div class="tab-content__item js-tab-content wysiwyg" id="<?php echo sanitize_title($tab['title']); ?>">
						<?php echo $tab['content']; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php endif; ?>
