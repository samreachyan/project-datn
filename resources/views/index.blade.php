<!DOCTYPE html>
<html lang="vi" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>VinaCourse</title>
    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="assets/vendor/perfect-scrollbar.css" rel="stylesheet">

    <!-- Fix Footer CSS -->
    <link type="text/css" href="assets/vendor/fix-footer.css" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="assets/css/material-icons.css" rel="stylesheet">


    <!-- Font Awesome Icons -->
    <link type="text/css" href="assets/css/fontawesome.css" rel="stylesheet">


    <!-- Preloader -->
    <link type="text/css" href="assets/css/preloader.css" rel="stylesheet">


    <!-- App CSS -->
    <link type="text/css" href="assets/css/app.css" rel="stylesheet">

</head>


<body class="layout-sticky-subnav layout-default ">

    <div class="preloader">
        <div class="sk-double-bounce">
            <div class="sk-child sk-double-bounce1"></div>
            <div class="sk-child sk-double-bounce2"></div>
        </div>
    </div>

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">

        <!-- Header -->

        <div id="header" class="mdk-header mdk-header--bg-dark bg-dark js-mdk-header mb-0" data-effects="parallax-background waterfall" data-fixed data-condenses>

            <div class="mdk-header__content justify-content-center">

                <div class="navbar navbar-expand navbar-dark-dodger-blue bg-transparent will-fade-background" id="default-navbar" data-primary>

                    <!-- Navbar Brand -->
                    <a href={{ route('home') }} class="navbar-brand mr-16pt">
                        <!-- <img class="navbar-brand-icon" src="assets/images/logo/white-100@2x.png" width="30" alt="VinaCourse"> -->

                        <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">

                            <span class="avatar-title rounded bg-primary"><img src="assets/images/illustration/student/128/white.svg" alt="logo" class="img-fluid" /></span>

                        </span>

                        <span class="d-none d-lg-block">VinaCourse</span>
                    </a>


                    <ul class="nav navbar-nav ml-auto mr-0">
                        <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link" data-toggle="tooltip" data-title="Login" data-placement="bottom" data-boundary="window"><i class="material-icons">lock_open</i></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('signup') }}" class="btn btn-outline-white">Get Started</a>
                        </li>
                    </ul>
                </div>
{{--
                <div class="hero container page__container text-center text-md-left py-112pt">
                    <h1 class="text-white text-shadow">Learn to Code</h1>
                    <p class="lead measure-hero-lead mx-auto mx-md-0 text-white text-shadow mb-48pt">Business, Technology and Creative Skills taught by industry experts. Explore a wide range of skills with our professional tutorials.</p>


                    <a href="fixed-courses" class="btn btn-lg btn-white btn--raised mb-16pt">Browse Courses</a>


                    <p class="mb-0"><a href="" class="text-white text-shadow"><strong>Are you a teacher?</strong></a></p>

                </div> --}}
            </div>
        </div>

        <!-- // END Header -->

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content ">


            <div class="bg-white border-bottom-2 py-16pt ">
                <div class="container page__container">
                    <div class="row align-items-center">
                        <div class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt mb-md-0 pb-16pt pb-md-0">
                            <div class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                <i class="material-icons text-white">subscriptions</i>
                            </div>
                            <div class="flex">
                                <div class="card-title mb-4pt">8,000+ Courses</div>
                                <p class="card-subtitle text-black-70">Explore a wide range of skills.</p>
                            </div>
                        </div>
                        <div class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt mb-md-0 pb-16pt pb-md-0">
                            <div class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                <i class="material-icons text-white">verified_user</i>
                            </div>
                            <div class="flex">
                                <div class="card-title mb-4pt">By Industry Experts</div>
                                <p class="card-subtitle text-black-70">Professional development from the best people.</p>
                            </div>
                        </div>
                        <div class="d-flex col-md align-items-center">
                            <div class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                <i class="material-icons text-white">update</i>
                            </div>
                            <div class="flex">
                                <div class="card-title mb-4pt">Unlimited Access</div>
                                <p class="card-subtitle text-black-70">Unlock Library and learn any topic with one subscription.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="page-section border-bottom-2">
                <div class="container page__container">
                    <div class="page-separator">
                        <div class="page-separator__text">Hot Courses</div>
                    </div>



                    <div class="row card-group-row">

                        {{-- <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col">

                            <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card" data-toggle="popover" data-trigger="click">


                                <a href="fixed-student-course" class="card-img-top js-image" data-position="" data-height="140">
                                    <img src="assets/images/paths/sketch_430x168.png" alt="course">
                                    <span class="overlay__content">
                                        <span class="overlay__action d-flex flex-column text-center">
                                            <i class="material-icons icon-32pt">play_circle_outline</i>
                                            <span class="card-title text-white">Preview</span>
                                        </span>
                                    </span>
                                </a>

                                <div class="card-body flex">
                                    <div class="d-flex">
                                        <div class="flex">
                                            <a class="card-title" href="fixed-student-course">Learn Sketch</a>
                                            <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                        </div>
                                        <a href="fixed-student-course" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>
                                    </div>
                                    <div class="d-flex">
                                        <div class="rating flex">
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span class="material-icons">star_border</span></span>
                                        </div>
                                        <!-- <small class="text-50">6 hours</small> -->
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row justify-content-between">
                                        <div class="col-auto d-flex align-items-center">
                                            <span class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span>
                                            <p class="flex text-black-50 lh-1 mb-0"><small>6 hours</small></p>
                                        </div>
                                        <div class="col-auto d-flex align-items-center">
                                            <span class="material-icons icon-16pt text-black-50 mr-4pt">play_circle_outline</span>
                                            <p class="flex text-black-50 lh-1 mb-0"><small>12 lessons</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="popoverContainer d-none">
                                <div class="media">
                                    <div class="media-left mr-12pt">
                                        <img src="assets/images/paths/sketch_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                                    </div>
                                    <div class="media-body">
                                        <div class="card-title mb-0">Learn Sketch</div>
                                        <p class="lh-1 mb-0">
                                            <span class="text-black-50 small">with</span>
                                            <span class="text-black-50 small font-weight-bold">Elijah Murray</span>
                                        </p>
                                    </div>
                                </div>

                                <p class="my-16pt text-black-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>

                                <div class="mb-16pt">
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                    </div>
                                </div>


                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="d-flex align-items-center mb-4pt">
                                            <span class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span>
                                            <p class="flex text-black-50 lh-1 mb-0"><small>6 hours</small></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-4pt">
                                            <span class="material-icons icon-16pt text-black-50 mr-4pt">play_circle_outline</span>
                                            <p class="flex text-black-50 lh-1 mb-0"><small>12 lessons</small></p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="material-icons icon-16pt text-black-50 mr-4pt">assessment</span>
                                            <p class="flex text-black-50 lh-1 mb-0"><small>Beginner</small></p>
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        <a href="fixed-student-course" class="btn btn-primary">Watch trailer</a>
                                    </div>
                                </div>



                            </div>

                        </div> --}}

                        @foreach ($courses as $course)
                        <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col">

                            <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card" data-toggle="popover" data-trigger="click">

                                <a href="fixed-student-course" class="card-img-top js-image" data-position="" data-height="140">
                                    <img src="@if ($course->thumbnail_url)
                                        {!!asset($course->thumbnail_url)!!}
                                    @else
                                        assets/images/paths/angular_430x168.png
                                    @endif" alt="course">
                                    <span class="overlay__content">
                                        <span class="overlay__action d-flex flex-column text-center">
                                            <i class="material-icons icon-32pt">play_circle_outline</i>
                                            <span class="card-title text-white">Preview</span>
                                        </span>
                                    </span>
                                </a>

                                <div class="card-body flex">
                                    <div class="d-flex">
                                        <div class="flex">
                                            <a class="card-title" href="fixed-student-course">{{ $course->name }}</a>
                                            <small class="text-50 font-weight-bold mb-4pt">{{App\Models\Account::find($course->instructor_id)->name}}</small>
                                        </div>

                                    </div>

                                    {{-- rating  --}}
                                    @php
                                        $rate0 = 0;
                                        $rate1 = 0;
                                        $rate2 = 0;
                                        $rate3 = 0;
                                        $rate4 = 0;
                                        $rate5 = 0;
                                        foreach ($course['rates'] as $rate) {
                                            $srate = $rate->rate;
                                            switch ($srate) {
                                                case 1:
                                                    $rate1 += 1;
                                                    break;
                                                case 2:
                                                    $rate2 += 1;
                                                    break;
                                                case 3:
                                                    $rate3 += 1;
                                                    break;
                                                case 4:
                                                    $rate4 += 1;
                                                    break;
                                                case 5:
                                                    $rate5 += 1;
                                                    break;
                                                default:
                                                    $rate0 += 1;
                                                    break;
                                            }
                                        }
                                        $totalRates = $rate1 + $rate2 + $rate3 + $rate4 + $rate5;
                                        if($totalRates > 0)
                                            $avgRate = round (($rate1*1 + $rate2*2 + $rate3*3 + $rate4*4 + $rate5*5)*10/$totalRates)/10;
                                        else
                                            $avgRate = 0;
                                    @endphp

                                    <div class="d-flex">
                                        <div class="rating flex">
                                            @if ($totalRates == 0)
                                            <small class="text-muted">
                                                Chưa có đánh giá nào!
                                            </small>
                                            @else
                                            <span class="rating__item">
                                                @if($avgRate >=1)
                                                <span class="material-icons">star</span>
                                                @else
                                                <span class="material-icons">star_border</span>
                                                @endif
                                            </span>
                                            <span class="rating__item"> @if($avgRate >=2)
                                                <span class="material-icons">star</span>
                                                @else
                                                <span class="material-icons">star_border</span>
                                                @endif</span>
                                            <span class="rating__item"> @if($avgRate >=3)
                                                <span class="material-icons">star</span>
                                                @else
                                                <span class="material-icons">star_border</span>
                                                @endif</span>
                                            <span class="rating__item"> @if($avgRate >=4)
                                                <span class="material-icons">star</span>
                                                @else
                                                <span class="material-icons">star_border</span>
                                                @endif</span>
                                            <span class="rating__item"> @if($avgRate == 5)
                                                <span class="material-icons">star</span>
                                                @else
                                                <span class="material-icons">star_border</span>
                                                @endif</span>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- end rating  --}}

                                </div>
                                <div class="card-footer">
                                    <div class="row justify-content-between">
                                        @php
                                            $totalTime = 0;
                                            $totalQuizzes = 0;
                                            $totalLessons = 0;
                                            foreach ($course->sections as $section) {
                                                // $totalLessons++;
                                                foreach ($section->lessons as $lesson) {
                                                    $totalLessons++;
                                                    $totalTime += 10;
                                                }
                                                $totalQuizzes += count($section->quizzes);
                                            }
                                        @endphp

                                        <div class="col-auto d-flex align-items-center">
                                            <span class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span>
                                            <p class="flex text-black-50 lh-1 mb-0"><small>{{ floor(($totalTime/60)*10)/10 }} giờ</small></p>
                                        </div>
                                        <div class="col-auto d-flex align-items-center">
                                            <span class="material-icons icon-16pt text-black-50 mr-4pt">play_circle_outline</span>
                                            <p class="flex text-black-50 lh-1 mb-0"><small>{{ $totalLessons }} lessons</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="popoverContainer d-none">
                                <div class="media">
                                    <div class="media-left mr-12pt">
                                        <img src="{{App\Models\Account::find($course->instructor_id)->avatar_url }}" width="40" height="40" alt="Angular" class="rounded">
                                    </div>
                                    <div class="media-body">
                                        <div class="card-title mb-0">{{$course->name}}</div>
                                        <p class="lh-1">
                                            <span class="text-black-50 small">với</span>
                                            <span class="text-black-50 small font-weight-bold">
                                                {{App\Models\Account::find($course->instructor_id)->name}}
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <div class="my-16pt">
                                    {!! Str::of($course->introduce)->limit(1000) !!}
                                </div>

                                <div ds class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="d-flex align-items-center mb-4pt">
                                            <span class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span>
                                            @php
                                                $totalTime = 0;
                                                $totalQuizzes = 0;
                                                $totalLessons = 0;
                                                foreach ($course->sections as $section) {
                                                    // $totalLessons++;
                                                    foreach ($section->lessons as $lesson) {
                                                        $totalLessons++;
                                                        $totalTime += 10;
                                                    }
                                                    $totalQuizzes += count($section->quizzes);
                                                }
                                            @endphp
                                            <p class="flex text-black-50 lh-1 mb-0"><small>
                                                {{ floor(($totalTime/60)*10)/10 }} giờ</small></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-4pt">
                                            <span class="material-icons icon-16pt text-black-50 mr-4pt">play_circle_outline</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>{{$totalLessons}} khoá học</small></p>
                                        </div>
                                        @if ($totalQuizzes > 0)
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-black-50 mr-4pt">assessment</span>
                                            <p class="flex text-black-50 lh-1 mb-0"><small>{{ $totalQuizzes }} Quiz</small></p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col text-right">
                                        <a href={{ route('login') }} class="btn btn-primary whiteButton">Xem khoá học</a>
                                    </div>
                                </div>

                            </div>

                        </div>
                        @endforeach

                    </div>
                </div>
            </div>


        </div>
        <!-- // END Header Layout Content -->

        @include('layout.footer')


    </div>
    <!-- // END Header Layout -->


    <!-- jQuery -->
    <script src="assets/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/vendor/popper.min.js"></script>
    <script src="assets/vendor/bootstrap.min.js"></script>

    <!-- Perfect Scrollbar -->
    <script src="assets/vendor/perfect-scrollbar.min.js"></script>

    <!-- DOM Factory -->
    <script src="assets/vendor/dom-factory.js"></script>

    <!-- MDK -->
    <script src="assets/vendor/material-design-kit.js"></script>

    <!-- Fix Footer -->
    <script src="assets/vendor/fix-footer.js"></script>

    <!-- App JS -->
    <script src="assets/js/app.js"></script>


    <script>
        (function() {
            'use strict';
            var headerNode = document.querySelector('.mdk-header')
            var layoutNode = document.querySelector('.mdk-header-layout')
            var componentNode = layoutNode ? layoutNode : headerNode

            componentNode.addEventListener('domfactory-component-upgraded', function() {
                headerNode.mdkHeader.eventTarget.addEventListener('scroll', function() {
                    var progress = headerNode.mdkHeader.getScrollState().progress
                    var navbarNode = headerNode.querySelector('#default-navbar')
                    navbarNode.classList.toggle('bg-transparent', progress <= 0.2)
                })
            })
        })()
    </script>

</body>

</html>
