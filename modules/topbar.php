<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="input-group">
            <input name="s" id="s" type="text" class="form-control bg-light border-0 small" placeholder="<?php _e('Enter your book name', 'kindlefan'); ?>" aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" aria-label="<?php _e('Search button', 'kindlefan'); ?>">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="input-group">
                        <input type="text" name="s" id="s" class="form-control bg-light border-0 small" placeholder="<?php _e('Enter a book name', 'kindlefan'); ?>" aria-label="<?php _e('Search', 'kindlefan'); ?>" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" aria-label="<?php _e('Search button', 'kindlefan'); ?>">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="far fa-newspaper"></i>
            </a>
            <?php
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 3,
                'category_name' => 'dev'
            );
            $dev_posts = new WP_Query($args);
            ?>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Developer Notes
                </h6>
                <?php
                if( $dev_posts-> have_posts() ) :
                    while( $dev_posts->have_posts() ) :
                        $dev_posts->the_post();
                        ?>
                        <a class="dropdown-item d-flex align-items-center" href="<?php the_permalink(); ?>">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500"><?php the_date(); ?></div>
                                <span class="font-weight-bold"><?php the_title(); ?></span>
                            </div>
                        </a>
                    <?php endwhile;
                    wp_reset_postdata();
                    $category = get_term_by('slug', 'dev', 'category');
                    if (!empty($category) ) :
                    ?>
                        <a class="dropdown-item text-center small text-gray-500" href="<?php echo get_category_link($category->term_id); ?>"><?php _e('Show all posts', 'kindlefan'); ?></a>
                    <?php endif; ?>
                <?php else : ?>
                    <p class="text-center text-gray-700"><?php _e('There are no post.', 'kindlefan'); ?></p>
                <?php endif; ?>
            </div>
        </li>

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="<?php echo esc_url( home_url('/submit') ); ?>" id="messagesDropdown">
                <i class="fas fa-plus"></i>
            </a>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Valerie Luna</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo esc_url( home_url('/profile') ); ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    <?php _e('Profile', 'kindlefan'); ?>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    <?php _e('Logout', 'kindlefan'); ?>
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
