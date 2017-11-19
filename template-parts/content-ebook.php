<?php
/*
 * Get thumbnail
 */
$ebook_cover_image = get_post_meta(get_the_ID(), 'ebook-cover-image');
if( has_post_thumbnail() ) {
	$image = get_the_post_thumbnail_url();
} elseif( !empty($ebook_cover_image) ) {
	$image = $ebook_cover_image[0];
}
?>

<article class="article article--ebook">
	<div class="article__inner">
		<?php if( !empty($image) ) : ?>
			<div class="article__thumbnail">
				<img class="article__image" src="<?php echo $image; ?>" alt="<?php the_title(); ?>">
			</div>
		<?php endif; ?>
		<div class="article__content">
			<div class="article__header">
				<h1 class="article__headline"><?php the_title(); ?></h1>
				<p class="article__author"><?php _e('Người đăng:', 'sachkindle'); echo ' ' . get_the_author() ?></p>
			</div>
			<div class="tab">
				<?php if( is_singular('ebook') ) : ?>
					<!-- Integrate Facebook comment -->
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
							var js, fjs = d.getElementsByTagName(s)[0];
							if (d.getElementById(id)) return;
							js = d.createElement(s); js.id = id;
							js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=469454783437402";
							fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
				<?php endif; ?>
				<?php the_part('tabs', array(
					'tabs' => array(
						array(
							'title' => __('Giới thiệu', 'sachkindle'),
							'content' => get_the_full_content()
						),
						array(
							'title' => __('Tải về máy', 'sachkindle'),
							'content' => get_ebook_download( get_the_ID() )
						),
						array(
							'title' => __('Đánh giá <span>(Mới)</span>', 'sachkindle'),
							'content' => '<div class="fb-comments" data-href="' . get_the_permalink() .'" data-width="100%" data-numposts="20"></div>'
						)
					)
				)); ?>
			</div>
		</div>
	</div>
</article>
