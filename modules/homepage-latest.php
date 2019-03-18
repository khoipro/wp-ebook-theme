<div class="homepage-latest">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="h2"><?php _e('Latest Ebooks', 'kindlefan'); ?></h2>
        </div>
    </div>
    <div class="row">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                // Your loop code
                get_template_part('modules/archive', 'item');
            endwhile;
        else : ?>
            <p>
                <?php _e('Sorry, no posts were found.', 'kindlefan'); ?>
            </p>
        <?php endif;
        ?>
    </div>
</div>
