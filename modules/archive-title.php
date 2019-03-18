<header class="page-header mb-4">
    <?php
    if( is_archive() ) :
        the_archive_title( '<h1 class="h2 page-header__title">', '</h1>' );
        the_archive_description( '<div class="page-header__description">', '</div>' );
    elseif( is_search() ) : ?>
        <h1 class="h2 page-header__title"><?php printf( __( 'Search Results for: %s', 'kindlefan' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
    <?php endif; ?>
</header>
