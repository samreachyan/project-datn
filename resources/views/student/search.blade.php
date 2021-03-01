@extends('layout.app')
@section('content')
<div class="page-section">
<div class="container page__container">
    <div class="page-separator">
        <div class="page-separator__text">Giảng viên</div>
    </div>
    @if (count($instructors) == 0)
        <div id="not_have_course" class="m-5 h4">Không có kết quả phù hợp.</div>
    @else
        <div id="instructorSearchStack" class="row card-group-row">
        @foreach ($instructors as $instructor)
            <div class="col-md-3 col-xl-4 card-group-row__col">
                <div class="card card-group-row__card">
                    <a href="{{route('get_user_home', ['username' => $instructor->username])}}" class="card-header d-flex align-items-center">
                        <div style="width: 40px" class="mr-2">
                            <img src="{{$instructor->avatar_url}}" alt="avatar" class="circle-ava">
                        </div>
                        <div>
                            <p class="card-title flex mr-12pt">{{$instructor->name}}</p>
                            <p class="card-title flex mr-12pt text-muted">(@ {{$instructor->username}})</p>
                        </div>
                    </a>

                </div>
            </div>    
        @endforeach
        </div>
        <div class="mb-4">

            <ul class="pagination justify-content-start pagination-xsm m-0">
                @for ($i = 1; $i <= $instructors->lastPage(); $i++)
                    <li class="page-item">
                    <a class="instructorLink page-link @if ($i == $instructors->currentPage()) selected_page @endif" href="{{route('search')}}?keyword={{Request()->keyword}}&instructor={{$i}}" aria-label="Page {{$i}}">
                            <span>{{$i}}</span>
                        </a>
                    </li>
                @endfor
                <li class="simpleLoader linstructor ml-2 hidden"></li>
            </ul>

        </div>
    @endif

    <!-- Khoá học -->
    <div class="page-separator">
        <div class="page-separator__text">Khoá học</div>
    </div>

    @if (count($courses) == 0)
        <div id="not_have_course" class="m-5 h4">Không có kết quả phù hợp.</div>
    @else
        <div id="courseSearchStack" class="row card-group-row mb-8pt">
            @include('layout.simple-course-item')
        </div>
        <div class="mb-4">

            <ul class="pagination justify-content-start pagination-xsm m-0">
                @for ($i = 1; $i <= $courses->lastPage(); $i++)
                    <li class="page-item">
                    <a class="courseLink page-link @if ($i == $courses->currentPage()) selected_page @endif" href="{{route('search')}}?keyword={{Request()->keyword}}&course={{$i}}" aria-label="Page {{$i}}">
                            <span>{{$i}}</span>
                        </a>
                    </li>
                @endfor
                <li class="simpleLoader lcourse ml-2 hidden"></li>
            </ul>

        </div>
    @endif
</div>
</div>
@endsection
