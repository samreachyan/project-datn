<!DOCTYPE html>
<html lang="vi" dir="ltr">

@include('layout.head')


<body class="layout-app">
    <div class="mask hidden"><div class="loader"></div></div>
    <div class="preloader">
        <div class="sk-double-bounce">
            <div class="sk-child sk-double-bounce1"></div>
            <div class="sk-child sk-double-bounce2"></div>
        </div>
    </div>

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">

            <!-- Header -->
            @include('layout.header')
            <!-- // END Header -->


            @yield('content')

            @yield('drawer')


            @include('layout.footer')

        </div>
        <!-- // END drawer-layout__content -->

        <!-- drawer -->
        {{-- @yield('sidebar') --}}
        @if (Auth::check())
            @if (Auth::user()->role == 3)
                @include('layout.sidebar.student')
            @else
                @include('layout.sidebar.instructor')
            @endif
        @endif
        <!-- // END drawer -->

    </div>
    <!-- // END drawer-layout -->

    @include('layout.script')
</body>

</html>