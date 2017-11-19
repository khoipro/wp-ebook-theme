<?php

function ebook_metabox_markup( $object ) {
	wp_nonce_field(basename(__FILE__), 'ebook-nonce');
	$current_image = get_post_meta($object->ID, 'ebook-cover-image', true);
	$current_link = get_post_meta($object->ID, 'ebook-link', true);
	$current_file_type = get_post_meta($object->ID, 'ebook-filetype', true);
	?>
	<div>
		<p>
			<label for="ebook-cover-image"><strong><?php _e('Ebook Cover Image', 'sachkindle'); ?></strong></label>
		</p>
		<p>
			<input class="widefat" placeholder="http://i.imgur.com or http://postimage.org link" pattern="https?://.+" name="ebook-cover-image" type="text" value="<?php echo $current_image; ?>">
		</p>
		<p>
			<label for="ebook-link"><strong><?php _e('Ebook Sharing Link', 'sachkindle'); ?></strong> (<?php _e('Google Drive, Dropbox hoặc Box', 'sachkindle'); ?>)</label>
		</p>
		<p>
			<input class="widefat" placeholder="https://drive.google.com or https://app.box.com or https://www.dropbox.com/s/..." pattern="https?://.+" name="ebook-link" type="text" value="<?php echo $current_link; ?>" required>
		</p>
		<p>
			<label for="ebook-filetype"><strong><?php _e('Ebook File Type', 'sachkindle'); ?></strong></label>
		</p>
		<p>
			<select name="ebook-filetype">
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
					<option value="<?php echo $option['value']; ?>"<?php if( $option['value'] == $current_file_type ) : echo ' selected'; endif; ?>><?php echo $option['name']; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p><?php echo _e('Việc nhập các thông tin bên trên xác nhận bạn cho phép website đăng tải các thông tin về ebook này lên website.', 'sachkindle'); ?></p>
	</div>
<?php }

function ebook_metabox() {
	add_meta_box('ebook-metabox', __('Ebook Detail', 'sachkindle'), 'ebook_metabox_markup', 'ebook', 'normal', 'high', null);
}

add_action("add_meta_boxes", "ebook_metabox");

function save_ebook_detail( $post_id, $post, $update ) {
	if (!isset($_POST["ebook-nonce"]) || !wp_verify_nonce($_POST["ebook-nonce"], basename(__FILE__))) {
		return $post_id;
	}
	if(!current_user_can("edit_post", $post_id)) {
		return $post_id;
	}
	if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
		return $post_id;
	}
	$slug = "ebook";
	if( $slug != $post->post_type ) {
		return $post_id;
	}
	$ebook_link_value = '';
	$ebook_filetype_value = '';
	if( isset( $_POST['ebook-cover-image'] ) ) {
		$ebook_cover_image_value = $_POST['ebook-cover-image'];
	}
	update_post_meta($post_id, 'ebook-cover-image', $ebook_cover_image_value);
	if( isset( $_POST['ebook-link'] ) ) {
		$ebook_link_value = $_POST['ebook-link'];
	}
	update_post_meta($post_id, 'ebook-link', $ebook_link_value);
	if( isset( $_POST['ebook-filetype'] ) ) {
		$ebook_filetype_value = $_POST['ebook-filetype'];
	}
	update_post_meta($post_id, 'ebook-filetype', $ebook_filetype_value);
}

add_action('save_post', 'save_ebook_detail', 10, 3);
