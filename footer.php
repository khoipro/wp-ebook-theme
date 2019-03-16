                </div>
            </div>
        </div>
    </div>
    <?php if( is_user_logged_in() ) :
        get_template_part('modules/modal', 'logout');
    endif;
    ?>
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.min.js"></script>
    <?php wp_footer(); ?>
</body>
</html>
