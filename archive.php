<?php
/**
 * Template: Archive
 */
get_header(); ?>

<section id="primary">
    <main id="main">
        <?php
        get_template_part('modules/archive', 'title');
        get_template_part('modules/archive', 'list');
        get_template_part('modules/pagination');
        ?>
    </main>
</section>

<?php get_footer(); ?>
