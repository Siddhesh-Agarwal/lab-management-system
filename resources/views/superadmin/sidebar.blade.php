<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <p href="index3.html" class="brand-link">
        <img src={{ URL('dist/img/Logo.jpg') }} alt="SKCET Logo" class="brand-image img-circle elevation-8"
            style="opacity: .9">
        <span class="brand-text font-weight-light">Super Admin</span>
    </p>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image" style="margin-top:6px">
                <i class="fas fa-user-secret fa-2x"></i>
            </div>
            <div class="info" style="margin-left: 20px">
                <h3 style="color:rgba(80, 167, 255, 0.804)">{{ Auth::user()->name }}</h3>
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
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>
                            Manage Location
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{ url('superadmin/addlablistdevice') }} class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add System</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{ url('/superadmin/lablist') }} class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>System Details</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-desktop"></i>
                        <p>
                            Other Devices
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{ url('superadmin/addotherdevice') }} class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Devices</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{ route('superadmin.otherdevice') }} class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Devices Details</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-plus-square"></i>
                        <p>
                            Additional Devices
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{ url('superadmin/savelablistdevices') }} class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Devices</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{ route('superadmin.lablistdevices') }} class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Device Details</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href={{ url('/superadmin/labmovelist') }} class="nav-link">
                        <i class="nav-icon fas fa-inbox"></i>
                        <p>
                            Lab Request
                            <span class="badge badge-primary">{{ $totalDeviceCount }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Controls
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('superadmin.addlabs') }}" class="nav-link">
                                <i class="fas fa-plus-circle nav-icon"></i>
                                <p>Add Labs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{ route('superadmin.add') }} class="nav-link">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Add Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{ route('superadmin.details') }} class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Admins Details</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-trash"></i>
                        <p>
                            Scrap Controls
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-primary">{{ $totalTempCount }}</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{ route('temp.list') }} class="nav-link">
                                <i class="fas fa-recycle nav-icon"></i>
                                <p>Temp</p>
                                <span class="badge badge-primary">{{ $totalTempCount }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{ route('scrap.list') }} class="nav-link">
                                <i class="fas fa-edit nav-icon"></i>
                                <p>Scrap</p>
                            </a>
                        </li>
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
                            <a href={{ route('superadmin.search') }} class="nav-link">
                                <i class="fas fa-search-plus nav-icon"></i>
                                <p>Simple Search</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href={{ route('superadmin.listinglabs') }} class="nav-link">
                        <i class="nav-icon fas fa-tachometer"></i>
                        <p>
                            Labs
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href={{ route('superadmin.list.consumables') }} class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Consumables
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Consumables
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{ route('superadmin.list.consumablesadd') }} class="nav-link">
                                <i class="far fa-circle  nav-icon"></i>
                                <p>Add consumables</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{ route('superadmin.list.consumables') }} class="nav-link">
                                <i class="far fa-circle  nav-icon"></i>
                                <p>Consumables Details</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
