<!-- Header -->
@if (Auth::check())
    <script>
        var accountId = {{Auth::user()->id}};
    </script>
@else
    <script>
        var accountId = 0;
    </script>
@endif
@php
    if(Auth::check()){
        $avatar = Auth::user()->avatar_url;
        if(Auth::user()->role == App\Enums\UserRole::Instructor)
            $user = App\Models\Instructor::find(Auth::user()->id);
        else if(Auth::user()->role == App\Enums\UserRole::Student)
            $user = App\Models\Student::find(Auth::user()->id);
        else {
            Auth::logout();
            $user = null;
        }
    }
    else {
        $avatar = null;
        $user = null;
    }

@endphp
<div class="navbar navbar-expand pr-0 navbar-light border-bottom-2" id="default-navbar" data-primary>
    <!-- Navbar toggler -->
    @if (Auth::check())
    <button class="navbar-toggler w-auto mr-16pt d-block @yield('menu_button') rounded-0" type="button" data-toggle="sidebar">
        <span class="material-icons">short_text</span>
    </button>
            @if (Auth::user()->role == App\Enums\UserRole::Instructor)
            <span class="d-none d-md-flex align-items-center mr-16pt">

                <span class="avatar avatar-sm mr-12pt">

                    <span class="avatar-title rounded navbar-avatar"><i class="material-icons">trending_up</i></span>

                </span>

                <small class="flex d-flex flex-column">
                    <strong class="navbar-text-100">Earnings</strong>
                    <span class="navbar-text-50">&dollar;12.3k</span>
                </small>
            </span>
            <span class="d-none d-md-flex align-items-center mr-16pt">
                <span class="avatar avatar-sm mr-12pt">
                    <span class="avatar-title rounded navbar-avatar"><i class="material-icons">receipt</i></span>
                </span>
                <small class="flex d-flex flex-column">
                    <strong class="navbar-text-100">Sales</strong>
                    <span class="navbar-text-50">264</span>
                </small>
            </span>
            @else
            <span class="d-none d-md-flex align-items-center mr-16pt">
                <span class="avatar avatar-sm mr-12pt">
                    <span class="avatar-title rounded navbar-avatar"><i class="material-icons">opacity</i></span>
                </span>
                <small class="flex d-flex flex-column">
                    <strong class="navbar-text-100">Experience IQ</strong>
                    <span class="navbar-text-50">2,300 points</span>
                </small>
            </span>
            @endif
        @endif

    <div class="flex"></div>


    <!-- Toggler -->
    <div class="nav navbar-nav flex-nowrap d-flex mr-16pt">

        @if (Auth::check())
        <!-- Notifications dropdown -->
        <div class="nav-item dropdown dropdown-notifications dropdown-xs-down-full" data-toggle="tooltip" data-title="Tin nhắn" data-placement="bottom" data-boundary="window">
            <button class="nav-link btn-flush dropdown-toggle" type="button" data-toggle="dropdown" data-caret="false">
                <i class="material-icons icon-24pt">mail_outline</i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <div data-perfect-scrollbar class="position-relative">
                    <div class="dropdown-header"><strong>Tin nhắn</strong></div>
                    <div class="list-group list-group-flush mb-0">

                        <a href="javascript:void(0);" class="list-group-item list-group-item-action unread">
                            <span class="d-flex align-items-center mb-1">
                                <small class="text-black-50">5 phút trước</small>

                                <span class="ml-auto unread-indicator bg-accent"></span>

                            </span>
                            <span class="d-flex">
                                <span class="avatar avatar-xs mr-2">
                                    @if ($avatar)
                                        <img src="{!!asset($avatar) .'?'. time() !!}" alt="people" class="avatar-img rounded-circle">
                                    @else
                                        <img src="assets/images/people/110/woman-5.jpg" alt="people" class="avatar-img rounded-circle">
                                    @endif
                                </span>
                                <span class="flex d-flex flex-column">
                                    <strong class="text-black-100">Michelle</strong>
                                    <span class="text-black-70">Clients loved the new design.</span>
                                </span>
                            </span>
                        </a>

                        <a href="javascript:void(0);" class="list-group-item list-group-item-action">
                            <span class="d-flex align-items-center mb-1">
                                <small class="text-black-50">5 phút trước</small>

                            </span>
                            <span class="d-flex">
                                <span class="avatar avatar-xs mr-2">
                                    @if ($avatar)
                                        <img src="{!!asset($avatar) .'?'. time() !!}" alt="people" class="avatar-img rounded-circle">
                                    @else
                                        <img src="assets/images/people/110/woman-5.jpg" alt="people" class="avatar-img rounded-circle">
                                    @endif
                                </span>
                                <span class="flex d-flex flex-column">
                                    <strong class="text-black-100">Michelle</strong>
                                    <span class="text-black-70">🔥 Superb job..</span>
                                </span>
                            </span>
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <!-- // END Notifications dropdown -->


        <!-- Notifications dropdown -->
        <div class="nav-item ml-16pt dropdown dropdown-notifications dropdown-xs-down-full" data-toggle="tooltip" data-title="Thông báo" data-placement="bottom" data-boundary="window">
            <button class="nav-link btn-flush dropdown-toggle" type="button" data-toggle="dropdown" data-caret="false">
                <i class="material-icons">notifications_none</i>
                <span id="notify-dot" class="badge badge-notifications badge-accent @if (count($user->unreadNotifications) == 0) hidden
                @endif">{{count($user->unreadNotifications)}}</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                @csrf
                <div data-perfect-scrollbar class="position-relative" style="max-height: 25rem;">
                    <div class="dropdown-header"><strong>Thông báo</strong></div>
                    <div id="notify-list" class="list-group list-group-flush mb-0">
                    @foreach ($user->unreadNotifications as $notification)
                        @if (Auth::user()->role == App\Enums\UserRole::Instructor)
                        <a href="/instructor/manage-courses" notification-id={{$notification->id}} class="list-group-item list-group-item-action unread notification-item" >
                        @else
                        <a href="/student/course-preview/{{$notification->data['course_id']}}" notification-id={{$notification->id}} class="list-group-item list-group-item-action unread notification-item" >
                        @endif
                            <span class="d-flex align-items-center mb-1">
                                <small class="text-black-50">{{$notification->created_at->diffForHumans()}}</small>
                                <span class="ml-auto unread-indicator bg-accent"></span>
                            </span>
                            <span class="d-flex">
                                <span class="avatar avatar-xs mr-2">
                                    <span class="avatar-title rounded-circle bg-light">
                                    <img src="{{$notification->data['avatar']}}" alt="people" class="avatar-img rounded-circle">
                                    </span>
                                </span>
                                <span class="flex d-flex flex-column">
                                    <strong class="text-black-100">{{$notification->data['notifyName']}}</strong>
                                    <span class="text-black-70">Đã {{$notification->data['type']}} khoá học {{$notification->data['course_name']}}</span>
                                </span>
                            </span>
                        </a>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- // END Notifications dropdown -->
        @endif

        <div class="nav-item dropdown">
            <a href="#" class="nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown" data-caret="false">

                <span class="avatar avatar-sm mr-8pt2">

                    <span class="avatar-title rounded-circle bg-primary" style="overflow: hidden">
                        @if ($avatar)
                            <img style="" src="{!!asset($avatar) .'?'. time() !!}" class="img-fluid material-icons circle-ava" alt="logo" />
                        @else
                            <i class="material-icons">account_box</i>
                        @endif
                    </span>

                </span>

            </a>
            @if (Auth::check())
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header"><strong style="font-size: 1rem">{{Auth::user()->name}}</strong>@if (Auth::user()->role == App\Enums\UserRole::Instructor)
                    <strong>Giáo viên</strong>
                @endif</div>
                <a class="dropdown-item" href="account/edit-account">Chỉnh sửa tài khoản</a>
                <a class="dropdown-item" href="account/billing">Lịch sử</a>
                <a class="dropdown-item" href="account/logout">Đăng xuất</a>
            </div>
            @else
            <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header"><strong>Tài khoản</strong></div>
                <a class="dropdown-item" href="{{route('login')}}">Đăng nhập</a>
                <a class="dropdown-item" href="{{route('signup')}}">Tạo tài khoản</a>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- // END Header -->