<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <!-- LOGO -->
    <a href={{ route('admin_home') }} class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="/admin/images/logo.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="/admin/images/logo_sm.png" alt="" height="16">
        </span>
    </a>

    <!-- LOGO -->
    <a href={{ route('admin_home') }} class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="/admin/images/logo-dark.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="/admin/images/logo_sm_dark.png" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="left-side-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="metismenu side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a href={{ route('admin_home') }} class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboards </span>
                </a>
            </li>

            <li class="side-nav-title side-nav-item">Apps</li>

            <li class="side-nav-item">
                <a href={{ route('all_courses') }} class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span> Khóa Học </span>
                    <span class="badge badge-success float-right">4</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href={{ route('user') }} class="side-nav-link">
                    <i class="uil-rss"></i>
                    <span> Thông tin tải khoàn</span>
                </a>
            </li>

            {{-- <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span> Tasks </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="apps-tasks.html">List</a>
                    </li>
                    <li>
                        <a href="apps-tasks-details.html">Details</a>
                    </li>
                    <li>
                        <a href="apps-kanban.html">Kanban Board</a>
                    </li>
                </ul>
            </li> --}}

        </ul>


        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
