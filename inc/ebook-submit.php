<?php
/**
 * These functions to process ebook submit
 */

add_action('wp_ajax_validate_ebook_submit_form_callback', 'validate_ebook_submit_form_callback');
add_action('wp_ajax_nopriv_validate_ebook_submit_form_callback', 'validate_ebook_submit_form_callback');

function validate_ebook_submit_form_callback() {
    if (
        ! isset( $_POST['submit_ebook'] )
        || ! wp_verify_nonce( $_POST['submit_ebook'], 'ebook_nonce')
    ) {
        wp_send_json_error();
        exit;
    } else {

        $post_title = $_POST['title'];
        $post_description = $_POST['content'];
        $post_posted_id = $_POST['user_id'];
        $post_categories = $_POST['term'];
        $post_custom_fields = $_POST['field']; // Access demo: $_POST['field']['ebook-author']
        $allowed_taxes = ['ebook_category', 'file_type', 'ebook_language'];
        $allowed_custom_fields = ['ebook-link', 'ebook-author', 'ebook-cover-image', 'ebook-filetype'];

        $post_options = array(
            'post_type' => 'ebook',
            'post_status' => 'pending'
        );

        if( !empty($post_description) ) {
            $post_options['post_content_filtered'] = wp_strip_all_tags($post_description);
        }

        if( !empty($post_posted_id) && $post_posted_id !== '-1' ) {
            $post_options['post_author'] = $post_posted_id;
        }

        if( !empty($post_categories) ) {
            foreach($post_categories as $key => $category) {
                if (in_array($key, $allowed_taxes) ) {
                    if( $post_options['tax_input'][$key] !== '' ) {
                        $post_options['tax_input'][$key] = array($category);
                    } else {
                        array_push($post_options['tax_input'][$key], $category);
                    }
                }
            }
        }

        if( !empty($post_custom_fields) ) {
            foreach($post_custom_fields as $key => $custom_field) {
                if( in_array($key, $allowed_custom_fields) ) {
                    $post_options['meta_input'][$key] = $custom_field;
                }
            }
        }

        if( !empty($post_title) && !empty($post_custom_fields['ebook-link'])) {

            $post_options['post_title'] = wp_strip_all_tags($post_title);

            // Register a new post
            $post_id = wp_insert_post($post_options);
            if( !is_wp_error($post_id) ) {

                wp_send_json_success(array('post_id' => $post_id), 200);

            } else {

                wp_send_json_error($post_id->get_error_message());

            }
        }

        die();

//         echo json_encode($_POST);
//         die();
    }
}
