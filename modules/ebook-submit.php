<?php if( get_the_content() ) : ?>
    <div class="row mb-4">
        <div class="col-lg-12">
            <?php the_content(); ?>
        </div>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-lg-12">
        <form action="<?php echo admin_url('admin-ajax.php'); ?>" method="POST" id="submitEbook">
            <?php wp_nonce_field( 'ebook_nonce', 'submit_ebook' ); ?>
            <input type="hidden" name="action" value="validate_ebook_submit_form_callback">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-12" for="title"><?php _e('Title', 'kindlefan'); ?>*</label>
                        <div class="col-md-9 col-sm-12">
                            <input required class="form-control" aria-describedby="<?php _e('Enter a title', 'kindlefan'); ?>" type="text" name="title" id="title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-12" for="field[ebook-author]"><?php _e('Author', 'kindlefan'); ?></label>
                        <div class="col-md-9 col-sm-12">
                            <input class="form-control" aria-describedby="<?php _e('Enter author name', 'kindlefan'); ?>" type="text" name="field[ebook-author]" id="field[ebook-author]">
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="col-md-3 col-sm-12"><?php _e('Posted by', 'kindlefan'); ?></span>
                        <div class="col-md-9 col-sm-12">
                            <?php if( is_user_logged_in() ) :
                                $current_user = wp_get_current_user();
                                ?>
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $current_user->ID; ?>" />
                                <span><?php printf(__('Logged in as <a href="%1$s"><strong>%2$s</strong></a>', 'kindlefan'), esc_url( home_url('/profile') ), $current_user->user_login); ?>. <?php _e('Not you?', 'kindlefan'); ?> <a href="<?php echo wp_logout_url( home_url('/login?logout=true') ); ?>">Logout</a></span>
                            <?php else : ?>
                                <input type="hidden" name="user_id" id="user_id" value="-1" />
                                <span><?php printf( __('Not logged in. Do you want to <a href="%s">register an account</a>?', 'kindlefan'), esc_url( home_url('/register') ) ); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-12" for="content"><?php _e('Description', 'kindlefan'); ?></label>
                        <div class="col-md-9 col-sm-12">
                            <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-12" for="field[ebook-link]"><?php _e('Sharing Link', 'kindlefan'); ?></label>
                        <p class="mb-0"></p>
                        <div class="col-md-9 col-sm-12">
                            <input class="form-control" type="text" name="field[ebook-link]" id="field[ebook-link]">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-12" for="term[ebook_category]"><?php _e('Category', 'kindlefan'); ?>*</label>
                        <div class="col-md-9 col-sm-12">
                            <?php $categories = kindlefan_ebook_terms();
                            if( !empty($categories) ) : ?>
                                <select class="custom-select" id="term[ebook_category]" name="term[ebook_category]" required>
                                    <?php foreach($categories as $key => $category) : ?>
                                        <option value="<?php echo $category['id']; ?>"<?php if($key === 0) : ?> checked<?php endif; ?>><?php echo $category['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="term[file_type]"><?php _e('File Types', 'kindlefan'); ?>*</label>
                                <?php $types = kindlefan_file_types();
                                if( !empty($types) ) : ?>
                                    <?php foreach($types as $key => $type) : ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="<?php echo $type['id']; ?>" id="term[file_type][<?php echo $key; ?>]" name="term[file_type][]"<?php if($key === 0) : ?> checked<?php endif; ?>>
                                            <label class="form-check-label" for="term[file_type][<?php echo $key; ?>]"><?php echo $type['name']; ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="term[ebook_language]"><?php _e('Languages', 'kindlefan'); ?>*</label>
                                <?php $languages = kindlefan_ebook_languages();
                                if( !empty($languages) ) : ?>
                                    <?php foreach($languages as $key => $language) : ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="<?php echo $language['id']; ?>" id="term[ebook_language][<?php echo $key; ?>]" name="term[ebook_language][]"<?php if($key === 1) : ?> checked<?php endif; ?>>
                                            <label class="form-check-label" for="term[ebook_language][<?php echo $key; ?>]"><?php echo $language['name']; ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
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
                            <label class="form-check-label" for="option[permission]"><?php _e('I have a permission to publish this resource.', 'kindlefan'); ?></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4 text-center">
                <button type="submit" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text"><?php _e('Submit your book', 'kindlefan'); ?></span>
                </button>
            </div>
        </form>
    </div>
</div>
