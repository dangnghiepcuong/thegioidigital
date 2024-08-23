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
                            <li>
                                <a href="components/panels.html">
                                    <span class="sub-item">Panels</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/notifications.html">
                                    <span class="sub-item">Notifications</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/sweetalert.html">
                                    <span class="sub-item">Sweet Alert</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/font-awesome-icons.html">
                                    <span class="sub-item">Font Awesome Icons</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/simple-line-icons.html">
                                    <span class="sub-item">Simple Line Icons</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/typography.html">
                                    <span class="sub-item">Typography</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#forms">
                        <span class="icon material-symbols-outlined">edit_document</span>
                        <p>Forms</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="forms/forms.html">
                                    <span class="sub-item">Basic Form</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#tables">
                        <span class="icon material-symbols-outlined">table</span>
                        <p>Tables</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="tables/tables.html">
                                    <span class="sub-item">Basic Table</span>
                                </a>
                            </li>
                            <li>
                                <a href="tables/datatables.html">
                                    <span class="sub-item">Datatables</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#maps">
                        <span class="icon material-symbols-outlined">location_on</span>
                        <p>Maps</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="maps/googlemaps.html">
                                    <span class="sub-item">Google Maps</span>
                                </a>
                            </li>
                            <li>
                                <a href="maps/jsvectormap.html">
                                    <span class="sub-item">Jsvectormap</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#charts">
                        <span class="icon material-symbols-outlined">bar_chart</span>
                        <p>Charts</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="charts/charts.html">
                                    <span class="sub-item">Chart Js</span>
                                </a>
                            </li>
                            <li>
                                <a href="charts/sparkline.html">
                                    <span class="sub-item">Sparkline</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="widgets.html">
                        <span class="icon material-symbols-outlined">widgets</span>
                        <p>Widgets</p>
                        <span class="badge badge-success">4</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../documentation/index.html">
                        <span class="icon material-symbols-outlined">description</span>
                        <p>Documentation</p>
                        <span class="badge badge-secondary">1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#submenu">
                        <span class="icon material-symbols-outlined">menu</span>
                        <p>Menu Levels</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a data-bs-toggle="collapse" href="#subnav1">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav1">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a data-bs-toggle="collapse" href="#subnav2">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav2">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Level 1</span>
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
