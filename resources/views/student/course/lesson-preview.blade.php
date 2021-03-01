@extends('layout.app')
@section('active-bcourse', 'active')
@section('content')
@php
    if(!$initLesson) $initLesson = $course['sections'][0]['lessons'][0];
    $first_section_id = $initLesson->section_id;   
@endphp
<script>
    var course = {!! $course->toJson() !!};
    var first_section_id = {{$initLesson->id}};
    var first_lesson_id = {{$initLesson->id}};
    console.log(course);
    console.log({!! $initLesson->toJson() !!});
</script>
@csrf
    <div class="mdk-drawer js-mdk-drawer" data-align="end" data-opened data-persistent>
        <div id="content_pane" class="mdk-drawer__content">
            <div class="sidebar sidebar-dark-dodger-blue sidebar-right" data-perfect-scrollbar>
                <div class="mt-5 sidebar-heading text-white-50">Mục lục</div>
                <ul class="sidebar-menu">
                @foreach ($course['sections'] as $section)
                        <li section-id={{$section->id}} class="selectsection sidebar-menu-item @if($section->id == $first_section_id) active @endif">
                            <a class="sidebar-menu-button" data-toggle="collapse" href="#section{{$section->id}}">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--right">book</span>{{$section->name}}
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent" id="section{{$section->id}}">
                            @foreach ($section['lessons'] as $lesson)
                                <li lesson-id="{{$lesson->id}}" class="sidebar-menu-item viewlesson @if($lesson->id == $initLesson->id) active @endif">
                                    <a class=" sidebar-menu-button" href="#">
                                        <span class="sidebar-menu-text">{{$lesson->name}}</span>
                                    </a>
                                </li>                                                                          
                            @endforeach
                            @if (count($section['quizzes']) > 0)
                                <li class="viewquiz sidebar-menu-item">
                                    <a class=" sidebar-menu-button" href="#">
                                        <span class="sidebar-menu-text">Bài tập</span>
                                    </a>
                                </li>
                            @endif
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="navbar navbar-light border-0 navbar-expand">
        <div class="container page__container">
            <div class="media flex-nowrap">
                <div class="media-left mr-16pt">
                    <a href="student-course"><img src="{{$course->thumbnail_url}}" width="40" height="40" alt="{{$course->name}}" class="rounded"></a>
                </div>
                <div class="media-body">
                    <a href="student-course" class="card-title text-body mb-0">{{$course->name}}</a>
                    <p class="lh-1 d-flex align-items-center mb-0">
                        <span class="text-50 small font-weight-bold mr-8pt">{{App\Models\Account::find($course->instructor_id)->name}}</span>
                        {{-- <span class="text-50 small">Software Engineer and Developer</span> --}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Lesson view pane -->
    <div id="lesson-view" class="content_layout active">
        <div class="bg-primary pt-32pt pb-1 mb-4">
            <div class="container page__container">
                <nav class="course-nav mb-3">
                    @foreach ($course['sections'] as $section)
                        <a data-toggle="tooltip" data-placement="bottom" data-title="{{$section->name}}" href="#"><span sid={{$section->id}} class="material-icons @if($section->id == $first_section_id) text-primary @endif">account_circle</span></a>
                    @endforeach
                </nav>
                <div class="d-flex justify-content-between">
                    <a href="#" class="btn btn-outline-white prev-learn">Bài trước</a>
                    <a href="#" class="btn btn-outline-white next-learn">Bài tiếp theo</a>
                </div>
                <div class="d-flex flex-wrap align-items-end mb-16pt">
                    <h1 id="lesson-name" class="text-white flex m-0">{{$initLesson->name}}</h1>
                    <p id="lesson-duration" class="h3 text-white-50 font-weight-light m-0">{{$initLesson->duration}}</p>
                </div>
                <div id="video-container" class="js-player embed-responsive embed-responsive-16by9 mb-32pt @if(!$initLesson->video_url) video-gone @endif">
                    <div class="player embed-responsive-item">
                        <div class="player__embed" id="featured-media">
                            <iframe id="featured-video" class="embed-responsive-item featured-video" src="{{$initLesson->video_url}}" allowfullscreen=""></iframe>
                        </div>
                    </div>
                </div>
    
                
            </div>
        </div>
        <div id="lesson-info" class="container hero__lead measure-hero-lead text-black mb-24pt">{!!$initLesson->info!!}</div>
    </div>
    <!-- Quiz view pane -->
    <div id="quiz-view" class="content_layout">
        <div class="bg-primary pb-lg-64pt py-32pt">
            <div class="container page__container">
                <nav class="course-nav">
                    @foreach ($course['sections'] as $section)
                        <a data-toggle="tooltip" data-placement="bottom" data-title="{{$section->name}}" href="#"><span sid={{$section->id}} class="material-icons @if($section->id == $first_section_id) text-primary @endif">account_circle</span></a>
                    @endforeach
                </nav>

                <div class="d-flex flex-wrap align-items-end justify-content-end mb-16pt">
                    <h1 id="quiz-number" class="text-white flex m-0">Câu hỏi 1 trong 5</h1>
                </div>

                <div id="quiz-question" class="hero__lead measure-hero-lead text-white"></div>
            </div>
        </div>

        <div class="navbar navbar-expand-md navbar-list navbar-light bg-white border-bottom-2 " style="white-space: nowrap;">
            <div class="container page__container">
                <ul class="nav navbar-nav flex navbar-list__item">
                    <li class="nav-item">
                        <i class="material-icons text-50 mr-8pt">tune</i>
                        Chọn câu hỏi đúng dưới đây:
                    </li>
                </ul>
                <div class="nav navbar-nav ml-sm-auto navbar-list__item">
                    <div class="nav-item d-flex flex-column flex-sm-row ml-sm-16pt">
                        <a href="#" class="prev-quiz btn justify-content-center btn-outline-secondary w-100 w-sm-auto mb-16pt mb-sm-0"><i class="material-icons icon--left">keyboard_arrow_left</i>Câu hỏi trước</a>
                        <a href="#" class="next-quiz btn justify-content-center btn-accent w-100 w-sm-auto mb-16pt mb-sm-0 ml-sm-16pt">Câu hỏi tiếp theo <i class="material-icons icon--right">keyboard_arrow_right</i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container page__container">
            <div class="page-section">
                <div class="page-separator">
                    <div class="page-separator__text">Câu trả lời</div>
                </div>
                <div class="answer_pane">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input id="customCheck01" type="checkbox" class="custom-control-input">
                            <label for="customCheck01" class="custom-control-label">Ability to use newer syntax and offers reliability</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input id="customCheck02" type="checkbox" class="custom-control-input" checked="">
                            <label for="customCheck02" class="custom-control-label">Compatibility</label>
                        </div>
                    </div>
                    <div class="form-group mb-32pt mb-lg-48pt">
                        <div class="custom-control custom-checkbox">
                            <input id="customCheck03" type="checkbox" class="custom-control-input">
                            <label for="customCheck03" class="custom-control-label">Usage of missing features</label>
                        </div>
                    </div>
                </div>

                <p class="text-50 mb-0 mt-32pt mt-lg-48pt">Chú ý: Câu hỏi có thể có nhiều câu trả lời.</p>
            </div>
        </div>
    </div>

    <div id="quiz-result" class="content_layout">
        <div class="mdk-box bg-primary mdk-box--bg-gradient-primary2 js-mdk-box mb-0" data-effects="blend-background">
            <div class="mdk-box__content">
                <div class="py-64pt text-center text-sm-left">
                    <div class="container d-flex flex-column justify-content-center align-items-center">
                        <h1 class="text-white mb-24pt large-point">Bạn được: 100 điểm</h1>
                        <div class="d-flex">
                            <a href="#" class="btn btn-outline-white mr-3 requiz">Làm lại</a>
                            <a href="#" class="btn btn-outline-white continue-learn">Học tiếp</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-expand-sm navbar-light navbar-submenu navbar-list p-0 m-0 align-items-center">
            <div class="container page__container">
                <ul class="nav navbar-nav flex align-items-sm-center">
                    <li class="nav-item navbar-list__item small-point">
                        <i class="material-icons text-muted icon--left">assessment</i>50/100 Điểm</li>
                </ul>
            </div>
        </div>

        <div class="container page__container result-container">
            <div class="border-left-2 page-section pl-32pt">

                <div class="d-flex align-items-center page-num-container mb-16pt">
                    <div class="page-num">1</div>
                    <h4>Câu hỏi 1 trên 5</h4>
                </div>

                <p class="text-70 measure-lead mb-32pt mb-lg-48pt">An angular 2 project written in typescript is* transpiled to javascript duri*ng the build process. Which of the following additional features are provided to the developer while programming on typescript over javascript?</p>

                <ul class="list-quiz">
                    <li class="list-quiz-item">
                        <span class="list-quiz-badge">A</span>
                        <span class="list-quiz-text">Ability to use newer syntax and offers reliability</span>
                    </li>
                    <li class="list-quiz-item active">
                        <span class="list-quiz-badge bg-primary text-white"><i class="material-icons">check</i></span>
                        <span class="list-quiz-text">Compatibility</span>
                    </li>
                    <li class="list-quiz-item">
                        <span class="list-quiz-badge">C</span>
                        <span class="list-quiz-text">Usage of missing features</span>
                    </li>
                </ul>

            </div>
        </div>
    </div>

    <div class="navbar navbar-expand-sm navbar-light bg-white border-bottom-2 navbar-list p-0 m-0 align-items-center">
        <div class="container page__container">
            <ul class="nav navbar-nav flex align-items-sm-center">
                <li class="nav-item navbar-list__item">
                    <div class="media align-items-center">
                        <span class="media-left mr-16pt">
                            @if (App\Models\Account::find($course->instructor_id)->avatar_url)
                                <img src="{!! asset(App\Models\Account::find($course->instructor_id)->avatar_url) . '?' . time()!!}" width="40" alt="avatar" class="rounded-circle">
                            @else
                                <img src="assets/images/people/50/guy-6.jpg" width="40" alt="avatar" class="rounded-circle">
                            @endif
                        </span>
                        <div class="media-body">
                            <a class="card-title m-0" href="/{{App\Models\Account::find($course->instructor_id)->username}}">{{App\Models\Account::find($course->instructor_id)->name}}</a>
                            <p class="text-50 lh-1 mb-0">Giảng viên</p>
                        </div>
                    </div>
                </li>
                <li class="nav-item navbar-list__item">
                    <i class="material-icons text-muted icon--left">schedule</i>
                    2h 46m
                </li>
                <li class="nav-item ml-sm-auto text-sm-center flex-column navbar-list__item">
                    <div class="rating rating-24">
                        <div class="rating__item"><i class="material-icons">star</i></div>
                        <div class="rating__item"><i class="material-icons">star</i></div>
                        <div class="rating__item"><i class="material-icons">star</i></div>
                        <div class="rating__item"><i class="material-icons">star</i></div>
                        <div class="rating__item"><i class="material-icons">star_border</i></div>
                    </div>
                    <p class="lh-1 mb-0"><small class="text-muted">20 ratings</small></p>
                </li>
            </ul>
        </div>
    {{-- </div> --}}
@endsection
@section('more-script')
<script src="assets/js/learn.js"></script>
@endsection