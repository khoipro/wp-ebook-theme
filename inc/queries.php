<?php

/**
 * Modify current homepage query
 * @param $query
 */
function kindlefan_homepage_post_query( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->query_vars['post_type'] = 'ebook';
    }
}
add_action( 'pre_get_posts', 'kindlefan_homepage_post_query' );
