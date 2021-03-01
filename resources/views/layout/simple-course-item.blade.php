@foreach ($courses as $course)
<div class="col-sm-6 card-group-row__col">
    <div class="card card-sm card-group-row__card">
        <div class="card-body d-flex align-items-center">
            <a href="/student/course-preview/{{ $course->id }}" class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                @if ($course->thumbnail_url)
                    <img src="{!!asset($course->thumbnail_url)!!}" alt="Angular Routing In-Depth" class="avatar-img rounded">
                @else
                    <img src="assets/images/paths/angular_routing_200x168.png" alt="Angular Routing In-Depth" class="avatar-img rounded">
                @endif
                <span class="overlay__content"></span>
            </a>
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
            <div class="flex">
                <a class="card-title mb-4pt" href="/student/course-preview/{{ $course->id }}">{{$course->name}}</a>
                <div class="d-flex align-items-center">
                    <div class="rating mr-8pt">

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
                    <small class="text-muted">{{$avgRate}}/5</small>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="flex text-center d-flex align-items-center mr-16pt">
                    <span style="font-size: 13px" class="card-title text-muted">{{$course['students_count']}}</span>
                    <i style="font-size: 16px" class="material-icons text-muted ml-2">remove_red_eye</i>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach