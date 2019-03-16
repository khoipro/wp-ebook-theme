<?php
global $post;
// Author
$author = $post->post_author;
// Category
$ebook_categories = get_the_terms($post, 'ebook_category');
$ebook_category = !empty($ebook_categories) && !is_wp_error($ebook_categories) ? $ebook_categories[0] : '';
$ebook_category_name = !empty($ebook_category) ? $ebook_category->name : '';
$ebook_category_link = !empty($ebook_category) ? esc_url( get_term_link($ebook_category, 'ebook_category') ) : '';
// Download Link
$download_link = get_post_meta($post->ID, 'ebook-link', true);
// File Types
$file_type = get_post_meta($post->ID, 'ebook-filetype', true);
$file_type_name = kindle_get_file_type_name($file_type);
?>
<div class="row mb-4">
    <div class="col-lg-3 col-sm-6">
        <div class="card shadow mb-2">
            <div class="card-header"><?php _e('Contributor', 'kindlefan'); ?></div>
            <div class="card-body"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID', $author)); ?>" title="<?php _e('View all ebooks by this author', 'kindlefan'); ?>"><?php echo get_the_author_meta('display_name', $author); ?></a></div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card shadow mb-2">
            <div class="card-header"><?php _e('Submitted Date', 'kindlefan'); ?></div>
            <div class="card-body"><?php the_date(); ?></div>
        </div>
    </div>
    <?php if( !empty($ebook_category_name) && !empty($ebook_category_link) ) : ?>
        <div class="col-lg-6 col-sm-12">
            <div class="card shadow mb-2">
                <div class="card-header"><?php _e('Category', 'kindlefan'); ?></div>
                <div class="card-body">
                    <a href="<?php echo $ebook_category_link; ?>"><?php echo $ebook_category_name; ?></a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<div class="row">
    <div class="col-lg-4 col-sm-6 col-xs-12">
        <div class="card mb-4 border-left-primary">
            <div class="card-body">
                <?php if( !empty($download_link) ) : ?>
                <p><a href="<?php echo $download_link; ?>" class="btn btn-primary btn-icon-split" target="_blank">
                    <span class="icon text-white-50">
                      <i class="fas fa-file-download"></i>
                    </span>
                        <span class="text"><?php _e('Download', 'kindlefan'); ?></span>
                    </a></p>
                <p><strong><?php _e('Available File Types', 'kindlefan'); ?>:</strong> <?php echo $file_type_name; ?></p>
                <p class="mb-0"><?php printf(__('Broken link? You can <a href="%s" data-toggle="modal" data-target="#brokenEbookReportModal">report to us</a>.', 'kindlefan'), '#report'); ?></p>
                <?php else : ?>
                    <p class="mb-0"><?php _e('A download link is not available.', 'kindlefan'); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php
        // TODO: Change coming features
        ?>
        <div class="card mb-4 border-left-secondary">
            <div class="card-header">
                <p class="mb-0 h5"><?php _e('Coming Soon', 'kindlefan'); ?></p>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item text-gray-500">Send to your Kindle</li>
                    <li class="list-group-item text-gray-500">Rate a book</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-sm-6 col-xs-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php _e('Description', 'kindlefan'); ?></h6>
            </div>
            <div class="card-body"><?php the_content(); ?></div>
        </div>
    </div>
</div>
