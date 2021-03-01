<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-dark-dodger-blue sidebar-left" data-perfect-scrollbar>
            @if(Auth::user()->role == App\Enums\UserRole::Student)
            <div class="d-flex align-items-center navbar-height">
                <form action="{{route('search')}}" method="get" class="search-form search-form--black mx-16pt pr-0 pl-16pt">
                    @csrf
                    <input style="" name="keyword" type="text" class="form-control pl-0" placeholder="Tìm kiếm ...">
                    <button class="btn" type="submit"><i class="material-icons">search</i></button>
                </form>
            </div>
            @endif
            <a href="index" class="sidebar-brand ">
                {{-- <img class="sidebar-brand-icon" src="assets/images/illustration/student/128/white.svg" alt="VinaCourse"> --}}
                <span class="avatar avatar-xl sidebar-brand-icon h-auto" style="width: 7.125rem;
                height: 7.125rem !important;overflow: hidden;">
                    <span class="avatar-title rounded bg-primary">
                        @if (Auth::user()->avatar_url)
                            <img src="{!!asset(Auth::user()->avatar_url) .'?'. time() !!}" class="img-fluid ava" alt="logo" />
                        @else
                            <img src="assets/images/illustration/student/128/white.svg" class="img-fluid" alt="logo" />    
                        @endif                     
                    </span>
                </span>

            <span>@if (Auth::check())
                {{Auth::user()->name}}
            @endif</span>
            </a>

            @yield('sidebar_content') 
            @include('layout.sidebar.application')
        </div>
    </div>
</div>
<!-- // END drawer -->