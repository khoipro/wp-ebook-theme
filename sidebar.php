<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo esc_url( home_url('/') ); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?php bloginfo('name'); ?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <?php
    $categories = kindlefan_ebook_terms();
    if ( ! empty( $categories ) ) :
    ?>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item active">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span><?php _e('Categories', 'kindlefan'); ?></span>
            </a>
            <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php foreach($categories as $category) : ?>
                        <a class="collapse-item" href="<?php echo $category['link']; ?>"><?php echo $category['name']; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </li>
    <?php endif; ?>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
