@extends('layout.app')
@section('active-bcourse', 'active')
@section('content')
@php
    $instructor = App\Models\Account::find($course->instructor_id);
    $isHaveThisCourse = App\Models\Student::find(Auth::user()->id)->courses()->where('course_id', $course->id)->exists();
    $myRate;
    for ($i=0; $i < count($course['students']); $i++) {
        if($course['students'][$i]->account_id == Auth::user()->id){
            $myRate = $course['students'][$i]->pivot->progress;
            break;
        }
    }
@endphp
{{-- <script>
    course = {!!$course->tojson()!!};
    console.log(course);
</script> --}}
    <div class="mdk-box bg-black js-mdk-box mb-0" data-effects="blend-background" style="overflow: hidden;">
        <div style="background-image: url({!! asset($course->thumbnail_url) !!}); background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            height: 100%;
            width: 100%;
            position: absolute;
            filter: blur(4px);
            -webkit-filter: blur(4px);
            opacity:0.5"></div>
        <div class="mdk-box__content">
            <div class="hero py-64pt text-center text-sm-left">
                <div class="container page__container">
                    <h1 class="text-white">{{ $course->name }}</h1>
                    <div style="font-size: 1.2rem; color:white">
                        {!! $course->introduce !!}
                    </div>
                    @if ($isHaveThisCourse)
                        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-start">
                            <a href="{{route('student_lesson', ['course_id'=>$course->id])}}" class="btn btn-outline-white mb-16pt mb-sm-0 mr-sm-16pt">Học ngay <i class="material-icons icon--right">play_circle_outline</i></a>
                        </div>    
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="navbar navbar-expand-sm navbar-light bg-white border-bottom-2 navbar-list p-0 m-0 align-items-center">
        <div class="container page__container">
            <ul class="nav navbar-nav flex align-items-sm-center">
                <li class="nav-item navbar-list__item">
                    <div class="media align-items-center">
                        <span class="media-left mr-16pt">
                            <img src="{!! asset($instructor->avatar_url) .'?'. time()  !!}" width="40" height="40" alt="avatar" class="rounded-circle">
                        </span>
                        <div class="media-body">
                            <a class="card-title m-0" href="{{ route('get_user_home', ['username' => $instructor->username]) }}">{{$instructor->name}}</a>
                            <p class="text-50 lh-1 mb-0">Giảng viên</p>
                        </div>
                    </div>
                </li>
                @php
                    $totalTime = 0;
                    $totalQuizzes = 0;
                    $totalLessons = 0;
                    foreach ($course->sections as $section) {
                        // $totalLessons++;
                        foreach ($section->lessons as $lesson) {
                            $totalLessons++;
                            $totalTime += 30;
                        }
                        $totalQuizzes += count($section->quizzes);
                    }
                @endphp
                <li class="nav-item navbar-list__item">
                    <i class="material-icons text-muted icon--left">schedule</i>
                    {{ floor(($totalTime)*10)/10 }} phút
                </li>
                <li class="nav-item navbar-list__item">
                    <i class="material-icons text-muted icon--left">remove_red_eye</i>
                    {{$course['students_count']}}
                </li>
                {{-- <li class="nav-item ml-sm-auto text-sm-center flex-column navbar-list__item">
                    <div class="rating rating-24">
                        <div class="rating__item"><i class="material-icons">star</i></div>
                        <div class="rating__item"><i class="material-icons">star</i></div>
                        <div class="rating__item"><i class="material-icons">star</i></div>
                        <div class="rating__item"><i class="material-icons">star</i></div>
                        <div class="rating__item"><i class="material-icons">star_border</i></div>
                    </div>
                    <p class="lh-1 mb-0"><small class="text-muted">20 ratings</small></p>
                </li> --}}
            </ul>
        </div>
    </div>

    <div class="page-section border-bottom-2">
        <div class="container page__container">

            <div class="page-separator">
                <div class="page-separator__text">Nội dung khoá học</div>
            </div>
            <div class="row mb-0">
                <div class="col-lg-7">


                    <div class="accordion js-accordion accordion--boxed list-group-flush" id="parent">

                        @php
                            $count=0;
                        @endphp
                        @foreach ($sections as $item)
                        <div class="accordion__item @if ($count==0) echo "open"; @endif">
                            <a href="#" class="accordion__toggle" data-toggle="collapse" data-target="#course-toc-{{ $item->id }}" data-parent="#parent">
                                <span class="flex">{{ $item->name }}</span>
                                <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                            </a>
                            <div class="accordion__menu collapse @if ($count==0) show @endif"" id="course-toc-{{ $item->id }}">
                                @foreach ($item->lessons as $lesson)
                                <div class="accordion__menu-link active">
                                    <!-- <span class="material-icons icon-16pt icon--left text-muted">lock</span> -->
                                    <span class="icon-holder icon-holder--small icon-holder--primary rounded-circle d-inline-flex icon--left">
                                        <i class="material-icons icon-16pt">play_circle_outline</i>
                                    </span>
                                    <a class="flex" href="student-lesson">{{ $lesson->name }}</a>
                                    <span class="text-muted">{{ $lesson->duration }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @php
                            $count++;
                        @endphp
                        @endforeach
                    </div>

                </div>
                <div class="col-lg-5 justify-content-center">


                    <div class="card">
                        <div class="card-body py-16pt text-center">
                            @if ($isHaveThisCourse)
                                <span class="icon-holder icon-holder--outline-secondary rounded-circle d-inline-flex mb-8pt">
                                    <i class="material-icons">book</i>
                                </span>
                                <h4></h4>
                                <a href="{{route('student_lesson', ['course_id'=>$course->id])}}" class="btn btn-accent mb-8pt">Truy cập khoá học</a>
                            @else
                                <span class="icon-holder icon-holder--outline-secondary rounded-circle d-inline-flex mb-8pt">
                                    <i class="material-icons">timer</i>
                                </span>
                                <h4 class="card-title"><strong>Mở khoá khoá học</strong></h4>
                                <p class="card-subtitle text-70 mb-2">Truy cập đến tất cả nội dung của khoá học này chỉ với</p>
                                <a id="buy_course" course-id={{$course->id}} href="" class="btn btn-accent mb-8pt">{{number_format($course->price, 0, ' ', ',') }} VNĐ</a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="page-section bg-white border-bottom-2">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mb-24pt mb-md-0">
                    <h4>Thông tin giảng viên</h4>
                    <p class="text-70 mb-24pt">{!!App\Models\Instructor::find($course->instructor_id)->introduce!!}</p>

                </div>
                <div class="col-md-5 pt-sm-32pt pt-md-0 d-flex flex-column align-items-center justify-content-start">
                    <div class="text-center">
                        @csrf
                        <p class="mb-16pt">
                            <img src="{!! asset($instructor->avatar_url) .'?'. time() !!}" alt="guy-6" class="rounded-circle" width="80" height="80cd ..">
                        </p>
                        <h4 class="m-0 mb-2">{{ $instructor->name }}</h4>
                        {{-- <p class="lh-1">
                            <small class="text-muted">Angular, Web Development</small>
                        </p> --}}
                        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-start">
                            @if (App\Models\Student::find(Auth::user()->id)->isFollowing($instructor->id))
                                <a instructor-id={{$instructor->id}} class="btn btn-outline-secondary mb-16pt mb-sm-0 mr-sm-16pt follow">Bỏ theo dõi
                            @else
                                <a instructor-id={{$instructor->id}} class="btn btn-outline-secondary mb-16pt mb-sm-0 mr-sm-16pt follow">Theo dõi
                            @endif
                            </a>
                            <a href="{{ route('get_user_home', ['username' => $instructor->username])}}" class="btn btn-outline-secondary">Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="page-section bg-white border-bottom-2">



        <div class="container page__container">
            <div class="page-separator">
                <div class="page-separator__text">Phản hồi của học sinh</div>
            </div>
            @if ($isHaveThisCourse)
                <div class="d-flex mx-auto my-3 align-items-center justify-content-center">
                    <h5 class="mb-0 mr-3">Đánh giá của bạn: </h5>  
                    <div course-id="{{$course->id}}" class="rating-star">
                        <input id="star5" name="rating" type="radio" value="5" @if($myRate == 5) checked @endif/>
                        <label for="star5"></label>
                        <input id="star4" name="rating" type="radio" value="4" @if($myRate == 4) checked @endif/>
                        <label for="star4"></label>
                        <input id="star3" name="rating" type="radio" value="3" @if($myRate == 3) checked @endif/>
                        <label for="star3"></label>
                        <input id="star2" name="rating" type="radio" value="2" @if($myRate == 2) checked @endif/>
                        <label for="star2"></label>
                        <input id="star1" name="rating" type="radio" value="1" @if($myRate == 1) checked @endif/>
                        <label for="star1"></label>
                    </div>
                </div>
            @endif
            <div class="row mb-32pt">
                <div class="col-md-3 mb-32pt mb-md-0">
                    @php
                        $rate0 = 0;
                        $rate1 = 0;
                        $rate2 = 0;
                        $rate3 = 0;
                        $rate4 = 0;
                        $rate5 = 0;
                        foreach ($course['students'] as $student) {
                            $srate = $student->pivot->progress;
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
                    <div class="display-1">{{number_format($avgRate, 1)}}</div>
                    <div class="rating rating-24">
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
                    <p class="text-muted mb-0">{{$totalRates}} đánh giá</p>
                </div>
                <div class="col-md-9">
                    @if ($totalRates > 0 )
                    <div class="row align-items-center mb-8pt" data-toggle="tooltip" data-title="{{$rate5}} đánh giá 5/5" data-placement="top">
                        <div class="col-md col-sm-6">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-secondary" role="progressbar" style="width: {{round($rate5*100/$totalRates)}}%"></div>
                            </div>
                        </div>
                        <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                            <div class="rating">
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-8pt" data-toggle="tooltip" data-title="{{$rate4}} đánh giá 4/5" data-placement="top">
                        <div class="col-md col-sm-6">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-secondary" role="progressbar" style="width: {{round($rate4*100/$totalRates)}}%" ></div>
                            </div>
                        </div>
                        <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                            <div class="rating">
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-8pt" data-toggle="tooltip" data-title="{{$rate3}} đánh giá 3/5" data-placement="top">
                        <div class="col-md col-sm-6">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-secondary" role="progressbar" style="width: {{round($rate3*100/$totalRates)}}%" ></div>
                            </div>
                        </div>
                        <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                            <div class="rating">
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-8pt" data-toggle="tooltip" data-title="{{$rate2}} đánh giá 2/5" data-placement="top">
                        <div class="col-md col-sm-6">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-secondary" role="progressbar" style="width: {{round($rate2*100/$totalRates)}}%" ></div>
                            </div>
                        </div>
                        <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                            <div class="rating">
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-8pt" data-toggle="tooltip" data-title="{{$rate1}} đánh giá 0/5" data-placement="top">
                        <div class="col-md col-sm-6">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-secondary" role="progressbar" style="width: {{round($rate1*100/$totalRates)}}%" ></div>
                            </div>
                        </div>
                        <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                            <div class="rating">
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </div>

    </div>

    <div class="page-section">
        <div class="container page__container">
            <div class="page-heading">
                <h4>Cùng tác giả</h4>
            </div>

            @php
                $courses = App\Models\Course::withCount('students')->where('instructor_id', $instructor->id)->get();
            @endphp


            <div class="position-relative carousel-card">
                <div class="js-mdk-carousel row d-block" id="carousel-courses1">

                    <a class="carousel-control-next js-mdk-carousel-control mt-n24pt" href="#carousel-courses1" role="button" data-slide="next">
                        <span class="carousel-control-icon material-icons" aria-hidden="true">keyboard_arrow_right</span>
                        <span class="sr-only">Next</span>
                    </a>

                    <div class="mdk-carousel__content nowidth">

                        @foreach ($courses as $item)
                        <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col">
                            <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal card-group-row__card" data-partial-height="44" data-toggle="popover" data-trigger="click">
                                <a href="student-course" class="js-image itemheight" data-position="">
                                    <img src="@if ($item->thumbnail_url)
                                        {!!asset($item->thumbnail_url)!!}
                                    @else
                                        assets/images/paths/angular_430x168.png
                                    @endif" alt="course">
        
                                    <span class="overlay__content align-items-start justify-content-start">
                                        <span class="overlay__action card-body d-flex align-items-center">
                                            <i class="material-icons mr-4pt">remove_red_eye</i>
                                            <span class="card-title text-white">{{$item['students_count']}}</span>
                                        </span>
                                    </span>
                                </a>
        
                                <div class="mdk-reveal__content">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title" href="student-course">{{ $item->name }}</a>
                                                <small class="text-50 font-weight-bold mb-4pt">{{ number_format($item->price, 0, ' ', ',') }} VNĐ</span></small>
                                            </div>
                                            <a href="student-course" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>
                                        </div>
                                        @php
                                            $rate0 = 0;
                                            $rate1 = 0;
                                            $rate2 = 0;
                                            $rate3 = 0;
                                            $rate4 = 0;
                                            $rate5 = 0;
                                            foreach ($item['rates'] as $rate) {
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
                                            <small class="text-50" >{{ floor(($totalTime/60)*10)/10 }} giờ</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="popoverContainer d-none">
                                <div class="media">
                                    <div class="media-left mr-12pt">
                                        <img src={{ $instructor->avatar_url }} width="40" height="40" alt="Angular" class="rounded">
                                    </div>
                                    <div class="media-body">
                                        <div class="card-title mb-0">{{ $item->name }}</div>
                                        <p class="lh-1 mb-0">
                                            <span class="text-black-50 small">với</span>
                                            <a href="{{ route('get_user_home', ['username' => $instructor->username]) }}" class="text-black-50 small font-weight-bold">{{$instructor->name}}</a>
                                        </p>
                                    </div>
                                </div>
        
                                <div class="my-16pt">
                                    {!! Str::of($item->introduce)->limit(1000) !!}
                                </div>
        
                                <div ds class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="d-lg-flex">
                                            <div class="d-flex align-items-center mb-4pt mr-2">
                                                <span class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span>
                                                <p class="flex text-black-50 lh-1 mb-0"><small>
                                                    {{ floor(($totalTime/60)*10)/10 }} giờ</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt mr-2">
                                                <span class="material-icons icon-16pt text-black-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-black-50 lh-1 mb-0"><small>{{$totalLessons}} khoá học</small></p>
                                            </div>
                                            @if ($totalQuizzes > 0)
                                                <div class="d-flex align-items-center mb-4pt">
                                                    <span class="material-icons icon-16pt text-black-50 mr-4pt">assessment</span>
                                                    <p class="flex text-black-50 lh-1 mb-0"><small>{{ $totalQuizzes }} Quiz</small></p>
                                                </div>
                                            @endif
                                        </div>
                                        <ul class="topic_list d-flex my-2">
                                            @foreach ($item['topics'] as $topic)
                                            <li class="topic_item fitcontent 
                                            <?php $a = rand(1, 5); 
                                                switch ($a) {
                                                    case 1:
                                                        echo 'blue';
                                                        break;
                                                    case 2:
                                                        echo 'gray';
                                                        break;
                                                    case 3:
                                                        echo 'red';
                                                        break;
                                                    case 4:
                                                        echo 'green';
                                                        break;
                                                    case 5:
                                                        echo 'yellow';
                                                        break;
                                                    case 6:
                                                        echo 'pink';
                                                        break;
                                                    case 7:
                                                        echo 'dpurple';
                                                        break;
                                                    case 8:
                                                        echo 'dgreen';
                                                        break;
                                                    default:
                                                        echo 'blue';
                                                        break;
                                                }
                                            ?>"><a class="text-white filterCourse" href="{{route('browse-course', ['topicId'=>$topic->id])}}">{{$topic->name}}</a></li>
                                            @endforeach
                                        </ul>
                                        
                                        @if (App\Models\Student::find(Auth::user()->id)->courses()->where('course_id', $item->id)->exists())
                                        <a href="{{route('student_lesson', ['course_id'=>$item->id])}}" class="btn btn-primary">Vào học ngay</a>
                                        @endif
                                        <a href="/student/course-preview/{{ $item->id }}" class="btn btn-info">Xem khoá học</a>
        
                                    </div>
                                </div>
        
        
        
                            </div>
        
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
