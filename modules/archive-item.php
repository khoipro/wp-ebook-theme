<div class="col-md-6 mb-4 d-flex">
    <div class="card flex-md-wrap flex-grow-1 w-100">
        <div class="card-body">
            <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <p class="card-text"><?php echo wp_trim_words(get_the_content(), 25, '...'); ?></p>
            <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php _e('View &amp; Download', 'kindlefan'); ?></a>
        </div>
    </div>
</div>
