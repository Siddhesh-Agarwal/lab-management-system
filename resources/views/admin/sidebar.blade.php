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
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image" style="margin-top:6px">
                {{-- <img src={{ URL('dist/img/user2-160x160.jpg') }} class="img-circle elevation-2" alt="User Image"> --}}
                <i class="fas fa-user fa-2x"></i>
            </div>
            <div class="info" style="margin-left: 20px">
                {{-- <a href="#" class="d-block">{{ Auth::user()->name }}</a> --}}
                <h3>{{ Auth::user()->name }}</h3>
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
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>
                            Manage Location
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            {{-- <a href="{{ route('admin.otherdevice') }}" class="nav-link">
                                --}}
                            <a href="{{ route('admin.lablist', ['lab_name' => 'Alan Kay']) }}" class="nav-link lab-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Alan Kay</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            {{-- <a href="./index2.html" class="nav-link ">
                                    --}}
                            <a href="{{ route('admin.lablist', ['lab_name' => 'DSP VLSI']) }}" class="nav-link lab-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>DSP/VLSI</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.lablist', ['lab_name' => 'Djikstra']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Djikstra</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.lablist', ['lab_name' => 'Donald Knuth']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Donald Knuth</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.lablist', ['lab_name' => 'EF Codd']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>EF Codd</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.lablist', ['lab_name' => 'Jimgray']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jimgray</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.lablist', ['lab_name' => 'Nicklaus Writh']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nicklaus Writh</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-plug"></i>
                        <p>
                            Manage Devices
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            {{-- <a href="{{ route('admin.otherdevice') }}" class="nav-link">
                                 --}}
                            <a href="{{ route('admin.listdevice', ['lab_name' => 'Alan Kay']) }}"
                                class="nav-link lab-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Alan Kay</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            {{-- <a href="./index2.html" class="nav-link ">
                                 --}}
                            <a href="{{ route('admin.listdevice', ['lab_name' => 'DSP VLSI']) }}"
                                class="nav-link lab-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    <p>DSP/VLSI</p>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.listdevice', ['lab_name' => 'Djikstra']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Djikstra</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.listdevice', ['lab_name' => 'Donald Knuth']) }}"
                                class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Donald Knuth</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.listdevice', ['lab_name' => 'EF Codd']) }}"
                                class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>EF Codd</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.listdevice', ['lab_name' => 'Jimgray']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jimgray</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.listdevice', ['lab_name' => 'Nicklaus Writh']) }}"
                                class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nicklaus Writh</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-wrench"></i>
                        <p>
                            Other Devices
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            {{-- <a href="{{ route('admin.otherdevice') }}" class="nav-link">
                                --}}
                            <a href="{{ route('admin.otherdevice', ['lab_name' => 'Alan Kay']) }}"
                                class="nav-link lab-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Alan Kay</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            {{-- <a href="./index2.html" class="nav-link ">
                                    --}}
                            <a href="{{ route('admin.otherdevice', ['lab_name' => 'DSP VLSI']) }}"
                                class="nav-link lab-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    <p>DSP/VLSI</p>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.otherdevice', ['lab_name' => 'Djikstra']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Djikstra</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.otherdevice', ['lab_name' => 'Donald Knuth']) }}"
                                class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Donald Knuth</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.otherdevice', ['lab_name' => 'EF Codd']) }}"
                                class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>EF Codd</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.otherdevice', ['lab_name' => 'Jimgray']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jimgray</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.otherdevice', ['lab_name' => 'Nicklaus Writh']) }}"
                                class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nicklaus Writh</p>
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
                            <a href={{route('admin.advance.search') }} class="nav-link">
                                <i class="fas fa-search-plus nav-icon"></i>
                                <p>Lab Search</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{  route('admin.searchlabs') }} class="nav-link">
                                <i class="fas fa-star nav-icon"></i>
                                <p>Enhanced</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{ route('admin.student.details') }} class="nav-link">
                                <i class="fas fa-tasks nav-icon"></i>
                                <p>Student Details</p>
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
