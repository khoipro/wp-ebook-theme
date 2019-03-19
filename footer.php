                </div>
                <?php get_template_part('modules/footer', 'copyright'); ?>
                </div>
        </div>
    </div>
    <?php if( is_user_logged_in() ) :
        get_template_part('modules/modal', 'logout');
    endif;
    ?>
    <?php wp_footer(); ?>
</body>
</html>
