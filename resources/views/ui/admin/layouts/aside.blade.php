<aside class="main-sidebar elevation-4 sidebar-light-pink">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">Omyra System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}"
                        class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-header pt-4">MASTER</li>
                <li class="nav-item">
                    <a href="{{ route('admin.brand.index') }}"
                        class="nav-link {{ request()->routeIs('admin.brand.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Brand
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.product.index') }}"
                        class="nav-link {{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-star"></i>
                        <p>
                            Produk
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.material.index') }}"
                        class="nav-link {{ request()->routeIs('admin.material.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>
                            Material
                        </p>
                    </a>
                </li>
                <li class="nav-header pt-4">PENYETOKAN MATERIAL</li>
                <li class="nav-item">
                    <a href="{{ route('admin.stock.plastic.index') }}"
                        class="nav-link {{ request()->routeIs('admin.stock.plastic.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Plastic
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.stock.inner.index') }}"
                        class="nav-link {{ request()->routeIs('admin.stock.inner.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Inner
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.stock.master.index') }}"
                        class="nav-link {{ request()->routeIs('admin.stock.master.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Master
                        </p>
                    </a>
                </li>
                <li class="nav-header pt-4">PROSES PRODUKSI</li>
                <li class="nav-item">
                    <a href="{{ route('admin.semifinish.index') }}"
                        class="nav-link {{ request()->routeIs('admin.semifinish.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-star-half-alt"></i>
                        <p>
                            Semifinish
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.finish.index') }}"
                        class="nav-link {{ request()->routeIs('admin.finish.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-star"></i>
                        <p>
                            Finish
                        </p>
                    </a>
                </li>
                <div class="pt-5"></div>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>