<!-- When there is no desire, all things are at peace. - Laozi -->
<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ Vite::asset('resources/images/digitalworld.webp') }}" alt="navbar brand" class="navbar-brand"
                    height="40" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <span class="icon material-symbols-outlined">home_app_logo</span>
                        <p>Dashboard</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="../demo1/index.html">
                                    <span class="sub-item">Dashboard 1</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#configurations">
                        <span class="icon material-symbols-outlined">manufacturing</span>
                        <p>Configurations</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="configurations">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.permissions.index') }}">
                                    <span class="sub-item">Permissions</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.roles.index') }}">
                                    <span class="sub-item">Roles</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.permissions.grant-to-user') }}">
                                    <span class="sub-item">Grant permissions</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/gridsystem.html">
                                    <span class="sub-item">Grid System</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#products">
                        <span class="icon material-symbols-outlined">category</span>
                        <p>Products</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="products">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.products.index') }}">
                                    <span class="sub-item">Product List</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.products.create') }}">
                                    <span class="sub-item">Create Product</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#terminologies">
                        <span class="icon material-symbols-outlined">book_3</span>
                        <p>Terminologies</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="terminologies">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="tables/tables.html">
                                    <span class="sub-item">Terminology List</span>
                                </a>
                            </li>
                            <li>
                                <a href="tables/datatables.html">
                                    <span class="sub-item">Create Terminology</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
