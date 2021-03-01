@extends('layout.sidebar.sidebar')
@section('sidebar_content')
<div class="sidebar-heading">Giáo viên</div>
<ul class="sidebar-menu">
    <li class="sidebar-menu-item @yield('active-dashboard')">
        <a class="sidebar-menu-button" href="{{route('instructor_dashboard', ['username' => Auth::user()->username])}}">
            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">school</span>
            <span class="sidebar-menu-text">My Dashboard</span>
        </a>
    </li>
    <li class="sidebar-menu-item @yield('active-manage_courses')">
        <a class="sidebar-menu-button" href="{{ route('manage_courses') }}">
            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">import_contacts</span>
            <span class="sidebar-menu-text">Quản lý khoá học</span>
        </a>
    </li>
    <li class="sidebar-menu-item @yield('active-earnings')">
        <a class="sidebar-menu-button" href="{{ route('earning') }}">
        {{-- <a class="sidebar-menu-button" href="/instructor/earning"> --}}
            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">trending_up</span>
            <span class="sidebar-menu-text">Thu nhập</span>
        </a>
    </li>
    {{-- <li class="sidebar-menu-item @yield('active-statement')">
        <a class="sidebar-menu-button" href="{{ route('statement') }}">
            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">receipt</span>
            <span class="sidebar-menu-text">Hoá đơn</span>
        </a>
    </li> --}}
</ul>
@endsection

