<div class="sidebar-heading">Ứng dụng</div>
<ul class="sidebar-menu">
    <li class="sidebar-menu-item">
        <a class="sidebar-menu-button" data-toggle="collapse" href="#account_menu">
            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">account_box</span>
            Tài khoản
            <span class="ml-auto sidebar-menu-toggle-icon"></span>
        </a>
        <ul class="sidebar-submenu collapse sm-indent" id="account_menu">
            <li class="sidebar-menu-item">
                <a id="request_change_password" class="sidebar-menu-button" href="/account/request_change_password">
                    <span class="sidebar-menu-text">Đặt lại mật khẩu</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a class="sidebar-menu-button  @yield('active-edit-account')" href="/account/edit-account">
                    <span class="sidebar-menu-text">Chỉnh sửa tài khoản</span>
                </a>
            </li>

            {{-- <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="/account/edit-account-notifications">
                    <span class="sidebar-menu-text">Cài đặt thông báo</span>
                </a>
            </li>

            <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="/account/billing-payment">
                    <span class="sidebar-menu-text">Thông tin thanh toán</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="/account/billing-history">
                    <span class="sidebar-menu-text">Lịch sử thanh toán</span>
                </a>
            </li> --}}
        </ul>
    </li>


    {{-- <li class="sidebar-menu-item">
        <a class="sidebar-menu-button" data-toggle="collapse" href="#community_menu">
            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">people_outline</span>
            Cộng đồng
            <span class="ml-auto sidebar-menu-toggle-icon"></span>
        </a>
        <ul class="sidebar-submenu collapse sm-indent" id="community_menu">
            <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="/community/teachers">

                    <span class="sidebar-menu-text">Giảng viên</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="community/faq">
                    <span class="sidebar-menu-text">FAQ</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="community/help-center">
                    <!--  -->
                    <span class="sidebar-menu-text">Trung tâm hỗ trợ</span>
                </a>
            </li>
        </ul>
    </li> --}}
</ul>