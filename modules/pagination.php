<?php
global $wp_query;
$big = 999999999; // need an unlikely integer

if ($wp_query->max_num_pages > 1) : ?>
    <div class="pagination mt-4 mb-4 text-center">
        <div class="row">
            <div class="col-lg-12">
                <?php echo paginate_links( array(
                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, get_query_var('paged') ),
                    'total' => $wp_query->max_num_pages
                ) );
                ?>
            </div>
        </div>
    </div>
<?php endif; ?>
