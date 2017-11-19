<?php

add_filter( 'the_content', function( $content ) {
	if ( is_page_template( 'templates/submit.php' ) ) {
		//only show to logged in users who can edit posts
		if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) {
			ob_start();?>

			<div class="section__box">
				<form class="form" id="post-submission-form" method="post">
					<div class="form__row">
						<label for="post-submission-title">
							<?php _e( 'Tên sách', 'sachkindle' ); ?>*
						</label>
						<input type="text" name="post-submission-title" id="post-submission-title" required aria-required="true" placeholder="Tên sách - Tên tác giả">
					</div>
					<div class="form__row">
						<label for="post-submission-content">
							<?php _e( 'Nội dung tóm tắt', 'sachkindle' ); ?>*
						</label>
						<textarea rows="10" cols="20" name="post-submission-content" id="post-submission-content" required aria-required="true"></textarea>
					</div>
					<div class="form__row">
						<label for="post-submission-ebook-link">
							<?php _e('Link Ebook', 'sachkindle'); ?>*
						</label>
						<input type="text" name="post-submission-ebook-link" id="post-submission-ebook-link" required aria-required="true" placeholder="Link từ Google Drive, Dropbox hoặc MediaFire">
					</div>
					<div class="form__row">
						<label for="post-submission-ebook-cover-image">
							<?php _e('Ảnh bìa Ebook', 'sachkindle'); ?>
						</label>
						<input type="text" name="post-submission-ebook-cover-image" id="post-submission-ebook-cover-image" placeholder="Link từ imgur.com hoặc postimage.org">
					</div>
					<div class="form__row">
						<label for="post-submission-ebook-category">
							<?php _e('Thể loại', 'sachkindle'); ?>
						</label>
						<div class="select-field">
							<select name="post-submission-ebook-category" id="post-submission-ebook-category">
								<?php
								$terms = get_terms(array(
									'taxonomy' => 'ebook_category',
									'hide_empty' => false
								));
								if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
									foreach ($terms as $term) :
										echo '<option value="' . $term->name . '">' . $term->name . '</option>';
									endforeach;
								}
								?>
							</select>
						</div>
					</div>
					<div class="form__row">
						<label for="post-submission-ebook-filetype">
							<?php _e('Định dạng file'); ?>
						</label>
						<div class="select-field">
							<select name="post-submission-ebook-filetype" id="post-submission-ebook-filetype">
								<?php
								$options = array(
									array(
										'value' => 'azw3',
										'name' => 'Amazon (.azw3) (Recommend)'
									),
									array(
										'value' => 'pdf',
										'name' => 'PDF'
									),
									array(
										'value' => 'mobi',
										'name' => 'Mobipocket (.MOBI, .PRC)'
									),
									array(
										'value' => 'doc',
										'name' => 'Microsoft Word (.doc, .docx)'
									),
									array(
										'value' => 'rtf',
										'name' => 'Rich Text Format (.rtf)'
									)
								);
								foreach( $options as $option ) : ?>
									<option value="<?php echo $option['value']; ?>"<?php if( $option['value'] === 'chua-phan-loai' ): ?> selected<?php endif; ?>><?php echo $option['name']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form__row form__footer">
						<input type="hidden" name="action" value="ebook" />
						<input type="hidden" name="redirect_to" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
						<button class="button" type="submit"><?php esc_attr_e( 'Đăng ebook', 'sachkindle'); ?></button>
					</div>
				</form>
			</div>
			<?php
			$content .= ob_get_clean();
		} else {
			$content .=  sprintf( '<a href="%1s">%2s</a>', esc_url( wp_login_url() ), __( 'Click để đăng nhập', 'sachkindle' ) );
		}
	}

	return $content;
});
