<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="<?php _e('Log out modal', 'kindlefan'); ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php _e('Ready to Leave?', 'kindlefan'); ?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="<?php _e('Close', 'kindlefan'); ?>">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"><?php printf(__('Select "%s" below if you are ready to end your current session.', 'kindlefan'), __('Logout', 'kindlefan')); ?></div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php _e('Cancel', 'kindlefan'); ?></button>
                <a class="btn btn-primary" href="<?php echo wp_logout_url( home_url('/') ); ?>"><?php _e('Logout', 'kindlefan'); ?></a>
            </div>
        </div>
    </div>
</div>
