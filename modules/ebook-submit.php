<?php if( get_the_content() ) : ?>
    <div class="row mb-4">
        <div class="col-lg-12">
            <?php the_content(); ?>
        </div>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-form-label col-md-2" for="title"><?php _e('Title', 'kindlefan'); ?>*</label>
                    <div class="col-md-10">
                        <input required class="form-control" aria-describedby="<?php _e('Enter a title', 'kindlefan'); ?>" type="text" name="title" id="title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-2" for="author"><?php _e('Author', 'kindlefan'); ?></label>
                    <div class="col-md-10">
                        <input class="form-control" aria-describedby="<?php _e('Enter author name', 'kindlefan'); ?>" type="text" name="author" id="author">
                    </div>
                </div>
                <div class="form-group row">
                    <span class="col-md-2"><?php _e('Posted by', 'kindlefan'); ?></span>
                    <div class="col-md-10">
                        <?php if( is_user_logged_in() ) :
                            $current_user = wp_get_current_user();
                            ?>
                            <span><?php printf(__('Logged in as <a href="%1$s"><strong>%2$s</strong></a>', 'kindlefan'), esc_url( home_url('/profile') ), $current_user->user_login); ?>. <?php _e('Not you?', 'kindlefan'); ?> <a href="<?php echo wp_logout_url( home_url('/login?logout=true') ); ?>">Logout</a></span>
                        <?php else : ?>
                            <span><?php printf( __('Not logged in. Do you want to <a href="%s">register an account</a>?', 'kindlefan'), esc_url( home_url('/register') ) ); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-2" for="content"><?php _e('Description', 'kindlefan'); ?></label>
                    <div class="col-md-10">
                        <textarea class="form-control" id="content" rows="5"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-2" for="term[ebook_category]"><?php _e('Category', 'kindlefan'); ?>*</label>
                    <div class="col-md-10">
                        <?php $categories = kindlefan_ebook_terms();
                        if( !empty($categories) ) : ?>
                            <select class="custom-select" id="term[ebook_category]" required>
                                <?php foreach($categories as $key => $category) : ?>
                                    <option value="<?php echo $category['value']; ?>" <?php selected($key === 0); ?>><?php echo $category['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-2" for="term[file_type]"><?php _e('File Types', 'kindlefan'); ?>*</label>
                    <div class="col-md-10">
                        <?php $types = kindlefan_file_types();
                        if( !empty($types) ) : ?>
                            <select id="term[file_type]" required multiple>
                                <?php foreach($types as $key => $type) : ?>
                                    <option value="<?php echo $type['value']; ?>" <?php selected($key === 0); ?>><?php echo $type['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header">
                <h2 class="h5 mb-1 text-primary"><?php _e('Preferences', 'kindlefan'); ?></h2>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="form-check mb-2 mr-sm-2">
                        <input class="form-check-input" type="checkbox" id="option[posted]"<?php if( !is_user_logged_in() ) : ?> checked disabled<?php endif; ?>>
                        <label class="form-check-label" for="option[posted]"><?php _e('Hide your name in "Posted by" field. It will visible under "Anonymous" name.', 'kindlefan'); ?>
                        <?php if( !is_user_logged_in() ) : ?>
                            <?php printf( __('To enable this option, please <a href="%1$s">login</a> or <a href="%2$s">register an account</a>.', 'kindlefan'), esc_url( home_url('/login') ), esc_url( home_url('/register') ) ); ?>
                        <?php endif; ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header">
                <h2 class="h5 mb-1 text-primary"><?php _e('Terms and Conditions', 'kindlefan'); ?></h2>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="form-check mb-2 mr-sm-2">
                        <input class="form-check-input" type="checkbox" id="option[agree_with_terms]" checked>
                        <label class="form-check-label" for="option[agree_with_terms]"><?php printf(__('I agree with this site\'s <a href="%s">terms</a>.', 'kindlefan'), esc_url( home_url('/terms') )); ?></label>
                    </div>
                    <div class="form-check mb-2 mr-sm-2">
                        <input class="form-check-input" type="checkbox" id="option[permission]" checked>
                        <label class="form-check-label" for="option[permission]"><?php _e('I had a permission to publish this resource to this site.', 'kindlefan'); ?></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4 text-center">
            <a href="#" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-arrow-right"></i>
                    </span>
                <span class="text"><?php _e('Submit your book', 'kindlefan'); ?></span>
            </a>
        </div>
    </div>
</div>
