<?php

function the_part( $module_name, $args = array() ) {
	if ( empty( $module_name ) ) {
		return;
	}
	extract( $args, EXTR_SKIP );
	include( TEMPLATEPATH . "/template-parts/$module_name.php" );
}

// Get Latest Ebook

function get_latest_ebooks() {
	global $post;
	$list = array();
	$args = array(
		'post_type' => 'ebook',
		'post_status' => 'publish',
		'posts_per_page' => 24
	);
	$post_list = get_posts( $args );
	if( $post_list ) {
		foreach( $post_list as $post ) {
			setup_postdata( $post );
			$ebook_cover_image = get_post_meta(get_the_ID(), 'ebook-cover-image');
			$item['title'] = get_the_title();
			$item['url']   = get_the_permalink();
			if( has_post_thumbnail() ) {
				$item['image'] = get_the_post_thumbnail_url();
			} elseif( !empty($ebook_cover_image) ) {
				$item['image'] = $ebook_cover_image[0];
			}
			$list[] = $item;
		}
		wp_reset_postdata();
	}
	return $list;
}


function get_ebook_download( $post_id ) {
	if( empty($post_id) ) {
		return;
	}
	$result = '<div class="wysiwyg download-link">';
	$result .= '<p>Liên kết được cung cấp bởi người sử dụng chia sẻ. Chúng tôi không lưu trữ bất kỳ ebook nào trên website.</p>';
	$ebook_link = get_post_meta($post_id, 'ebook-link');
	$ebook_image = get_post_meta($post_id, 'ebook-cover-image');
	$ebook_filetype = get_post_meta($post_id, 'ebook-filetype');
	if( !empty($ebook_link) ) {
		$result .= '<p><a href="' . $ebook_link[0] . '" class="button download-link__link" target="_blank" rel="nofollow">Tải về máy</a></p>';
	} else {
		$result .= '<p class="error">Chưa có liên kết tải về cho ebook này.</p>';
	}
	if( !empty($ebook_filetype) ) {
		$result .= '<p>Định dạng: ' . $ebook_filetype[0] . '</p>';
	}
	$result .= '<p>Nếu không tải được hoặc liên kết không chính xác, hãy <button class="button" data-modal-content="book-report">thông báo cho chúng tôi</button>. Chỉ mất <strong>5 giây</strong> để làm điều đó thôi!</p>';
	$result .= '</div>';
	return $result;
}

/*
 * Get ebook archive list
 */

function get_ebook_archive_list( $term_id ) {
	if( empty( $term_id ) ) {
		return;
	}
	global $post;
	$list = array();
	$args = array(
		'post_type' => 'ebook',
		'posts_per_page' => 12,
		'post_status' => 'publish',
		'tax_query' => array(
			array(
				'taxonomy' => 'ebook_category',
				'field' => 'id',
				'terms' => $term_id
			)
		)
	);
	$post_list = get_posts( $args );
	if( $post_list ) {
		foreach( $post_list as $post ) : setup_postdata( $post );
			setup_postdata( $post );
			$ebook_cover_image = get_post_meta(get_the_ID(), 'ebook-cover-image');
			$item['title'] = get_the_title();
			$item['url']   = get_the_permalink();
			if( has_post_thumbnail() ) {
				$item['image'] = get_the_post_thumbnail_url();
			} elseif( !empty($ebook_cover_image) ) {
				$item['image'] = $ebook_cover_image[0];
			}
			$list[] = $item;
		endforeach;
		wp_reset_postdata();
	}
	return $list;
}

/*
 * Replace get_the_content with full format
 */

function get_the_full_content ($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
	$content = get_the_content($more_link_text, $stripteaser, $more_file);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}

/*
 * Check login, register page
 */

function is_landing_page() {
	if( is_page_template('templates/login.php') || is_page_template('templates/register.php') ) {
		return true;
	} else {
		return false;
	}
}
