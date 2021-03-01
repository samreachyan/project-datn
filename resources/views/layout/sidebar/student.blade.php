@extends('layout.sidebar.sidebar')
@section('sidebar_content')
<div class="sidebar-heading">Học sinh</div>
<ul class="sidebar-menu">


    {{-- <li class="sidebar-menu-item @yield('active-home')">
        <a class="sidebar-menu-button" href="index">
            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
            <span class="sidebar-menu-text">Home</span>
        </a>
    </li> --}}
    <li class="sidebar-menu-item @yield('active-bcourse')">
        {{-- <a class="sidebar-menu-button" href="student/browse-course"> --}}
        <a class="sidebar-menu-button" href="{{route('browse-course')}}">
            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">local_library</span>
            <span class="sidebar-menu-text">Khoá học</span>
        </a>
    </li>
    <li class="sidebar-menu-item @yield('active-bpath')">
        <a class="sidebar-menu-button" href="student/browse-path">
            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">style</span>
            <span class="sidebar-menu-text">Lộ trình</span>
        </a>
    </li>
    <li class="sidebar-menu-item @yield('active-dashboard')">
        <a class="sidebar-menu-button" href="student/{{ Auth::user()->username }}/dashboard">
            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">account_box</span>
            <span class="sidebar-menu-text">My Dashboard</span>
        </a>
    </li>
    {{-- <li class="sidebar-menu-item @yield('active-mcourse')">
        <a class="sidebar-menu-button" href="{{route('student_course', ['username' => Auth::user()->username])}}">
            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">search</span>
            <span class="sidebar-menu-text">Khoá học của tôi</span>
        </a>
    </li> --}}
    <li class="sidebar-menu-item @yield('active-mpath')">
        <a class="sidebar-menu-button" href="{{route('my_path')}}">
            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">timeline</span>
            <span class="sidebar-menu-text">Lộ trình của tôi</span>
        </a>
    </li>
    {{-- <li class="sidebar-menu-item @yield('active-mquiz')">
        <a class="sidebar-menu-button" href="student/my-quizzes">
            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">poll</span>
            <span class="sidebar-menu-text">Quizzes</span>
        </a>
    </li>
    <li class="sidebar-menu-item @yield('active-skillrs')">
        <a class="sidebar-menu-button" href="student/skill-result">
            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">assignment_turned_in</span>
            <span class="sidebar-menu-text">Kỹ năng</span>
        </a>
    </li> --}}

</ul>
@endsection
