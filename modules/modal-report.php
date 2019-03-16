<!-- Logout Modal-->
<div class="modal fade" id="brokenEbookReportModal" tabindex="-1" role="dialog" aria-labelledby="<?php _e('Report broken ebook modal', 'kindlefan'); ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php _e('Report Ebook', 'kindlefan'); ?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="<?php _e('Close', 'kindlefan'); ?>">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="brokenEbookReport">
                    <?php
                    $report_types = array(
                        array(
                            'value' => 'broken-link',
                            'name' => __('Broken Download Link', 'kindlefan')
                        ),
                        array(
                            'value' => 'broken-image-cover',
                            'name' => __('Broken Image Link', 'kindlefan')
                        ),
                        array(
                            'value' => 'copyright',
                            'name' => __('Copyright Violations', 'kindlefan')
                        ),
                        array(
                            'value' => 'other',
                            'name' => __('Other Reason', 'kindlefan')
                        )
                    );
                    ?>
                    <div class="form-group">
                        <label for="type"><?php _e('Report Type', 'kindlefan'); ?></label>
                        <div class="form-check">
                            <select class="custom-select" id="type" required multiple>
                                <?php foreach($report_types as $key => $type) : ?>
                                    <option value="<?php echo $type['value']; ?>" <?php selected($key === 0); ?>><?php echo $type['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message"><?php _e('Message', 'kindlefan'); ?></label>
                        <p class="mb-2"><small><?php _e('If you wish to provide more detail, please leave it here.', 'kindlefan'); ?></small></p>
                        <textarea class="form-control" id="message" rows="5"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary" href="#" data-dismiss="modal"><?php _e('Cancel', 'kindlefan'); ?></a>
                <button class="btn btn-primary"><?php _e('Submit a report', 'kindlefan'); ?></button>
            </div>
        </div>
    </div>
</div>
