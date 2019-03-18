<?php

/**
 * Load all terms by taxonomy and return array with 'link', 'value' and 'name' of each term
 * @param $tax
 * @return array|bool
 */
function kindlefan_load_terms($tax) {
    if( empty($tax) ) {
        return false;
    }

    $terms = get_terms(array(
        'taxonomy' => $tax,
        'hide_empty' => false
    ));
    $results = array();
    if( !empty($terms) && !is_wp_error($terms) ) {
        foreach($terms as $term) {
            $results[] = array(
                'value' => $term->slug,
                'name' => $term->name,
                'link' => esc_url( get_term_link($term) )
            );
        }
    }
    return $results;
}

function kindlefan_ebook_terms() {
    return kindlefan_load_terms('ebook_category');
}

function kindlefan_file_types() {
    return kindlefan_load_terms('file_type');
}

/**
 * Find a `name` by `value` from all terms of `file_type` taxonomy
 * @param $value
 * @return bool
 */
function kindle_get_file_type_name($value) {
    if( empty($value) ) {
        return false;
    }

    $options = kindlefan_file_types();

    $results = array_filter($options, function($obj) use ($value) {
        return $obj['value'] === $value;
    });

    if (!empty($results) ) {
        return $results[0]['name'];
    }

    return false;
}

function kindlefan_setup() {
    add_theme_support('title-tag');
}
add_action('init', 'kindlefan_setup');


function kindlefan_homepage_post_query( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->query_vars['post_type'] = 'ebook';
    }
}
add_action( 'pre_get_posts', 'kindlefan_homepage_post_query' );
