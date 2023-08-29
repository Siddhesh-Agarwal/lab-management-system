<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <p href="index3.html" class="brand-link">
        <img src={{ URL('dist/img/Logo.jpg') }} alt="SKCET Logo" class="brand-image img-circle elevation-8"
            style="opacity: .9">
        <span class="brand-text font-weight-light">Admin</span>
    </p>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image" style="margin-top:6px">
                <i class="fas fa-user fa-2x"></i>
            </div>
            <div class="info">
                <h3 class="stylish-text">{{ Auth::user()->name }}</h3>
            </div>
        </div>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>
                            Manage Location
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach ($labNames as $labName)
                            <li class="nav-item">
                                <a href="<?= route('admin.lablist', ['lab_name' => $labName->lab_name]) ?>"
                                    class="nav-link lab-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p><?= htmlspecialchars($labName->lab_name) ?></p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-plug"></i>
                        <p>
                            Other devices
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach ($labNames as $labName)
                            <li class="nav-item">
                                <a href="<?= route('admin.otherdevice', ['lab_name' => $labName->lab_name]) ?>"
                                    class="nav-link lab-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p><?= htmlspecialchars($labName->lab_name) ?></p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                </li>
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-wrench"></i>
                        <p>
                            Additional Devices
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach ($labNames as $labName)
                            <li class="nav-item">
                                <a href="<?= route('admin.listdevice', ['lab_name' => $labName->lab_name]) ?>"
                                    class="nav-link lab-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p><?= htmlspecialchars($labName->lab_name) ?></p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Consumables
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach ($labNames as $labName)
                            <li class="nav-item">
                                <a href="<?= route('admin.consumables', ['lab_name' => $labName->lab_name]) ?>"
                                    class="nav-link lab-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p><?= htmlspecialchars($labName->lab_name) ?></p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-search"></i>
                        <p>
                            Search
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{ route('admin.searchlabs') }} class="nav-link">
                                <i class="fas fa-search nav-icon"></i>
                                <p>Lab Search</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href={{ route('admin.tables') }} class="nav-link">
                        <i class="nav-icon fas fa-street-view"></i>
                        <p>
                            Student's Info
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href={{ route('admin.log.details') }} class="nav-link">
                        <i class="nav-icon fas fa-circle-info"></i>
                        <p>
                            Log Details
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
