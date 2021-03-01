<script>
    course = {!!$courses->tojson()!!};
    console.log(course);
</script>
@foreach ($courses as $course)
@php
    $ownerCourse = App\Models\Account::find($course->instructor_id);
@endphp
<div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col">
    <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal card-group-row__card" data-partial-height="44" data-toggle="popover" data-trigger="click">
        <a href="student-course" class="js-image itemheight" data-position="">
            <img src="@if ($course->thumbnail_url)
                {!!asset($course->thumbnail_url)!!}
            @else
                assets/images/paths/angular_430x168.png
            @endif" alt="course">

            <span class="overlay__content align-items-start justify-content-start">
                <span class="overlay__action card-body d-flex align-items-center">
                    <i class="material-icons mr-4pt">remove_red_eye</i>
                    <span class="card-title text-white">{{$course['students_count']}}</span>
                </span>
            </span>
        </a>

        <div class="mdk-reveal__content">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex">
                        <a class="card-title" href="student-course">{{ $course->name }}</a>
                        <small class="text-50 font-weight-bold mb-4pt">{{ number_format($course->price, 0, ' ', ',') }} VNĐ</span></small>
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
                <img src={{ $ownerCourse->avatar_url }} width="40" height="40" alt="Angular" class="rounded">
            </div>
            <div class="media-body">
                <div class="card-title mb-0">{{ $course->name }}</div>
                <p class="lh-1 mb-0">
                    <span class="text-black-50 small">với</span>
                    <a href="{{ route('get_user_home', ['username' => App\Models\Account::find($course->instructor_id)->username]) }}" class="text-black-50 small font-weight-bold">{{App\Models\Account::find($course->instructor_id)->name}}</a>
                </p>
            </div>
        </div>

        <div class="my-16pt">
            {!! Str::of($course->introduce)->limit(1000) !!}
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
                    @foreach ($course['topics'] as $topic)
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
                
                @if (App\Models\Student::find(Auth::user()->id)->courses()->where('course_id', $course->id)->exists())
                <a href="{{route('student_lesson', ['course_id'=>$course->id])}}" class="btn btn-primary">Vào học ngay</a>
                @endif
                <a href="/student/course-preview/{{ $course->id }}" class="btn btn-info">Xem khoá học</a>

            </div>
        </div>



    </div>

</div>
@endforeach