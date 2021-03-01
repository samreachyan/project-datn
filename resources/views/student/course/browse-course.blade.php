@extends('layout.app')
@section('active-bcourse', 'active')
@section('content')
{{-- <script>
    course = {!!$courses->tojson()!!};
    console.log(course);
</script> --}}
    <div class="page-section">
        <div class="container page__container">

            <!-- Khoá học hot -->

            <div class="page-separator">
                <div class="page-separator__text">Khoá học hot 🔥🔥🔥</div>
            </div>

            <div class="card stack">
                <div id="stackHotCourse" class="list-group list-group-flush">
                    @foreach ($hotCourses as $course)
                    <div class="list-group-item d-flex flex-column flex-sm-row align-items-sm-center px-12pt">
                        <div class="flex d-flex align-items-center mr-sm-16pt mb-8pt mb-sm-0">
                            <a href="/student/course-preview/{{ $course->id }}" class="avatar overlay overlay--primary avatar-4by3 mr-12pt">
                                <img src="{{ $course ->thumbnail_url }}" alt="Newsletter Design" class="avatar-img rounded">
                                <span class="overlay__content"></span>
                            </a>
                            <div class="flex">
                                <a class="card-title mb-4pt" href="/student/course-preview/{{ $course->id }}">{{ $course->name }}</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex text-center d-flex align-items-center mr-16pt">
                                <span style="font-size: 13px" class="card-title text-muted">{{$course['students_count']}}</span>
                                <i style="font-size: 16px" class="material-icons text-muted ml-2">remove_red_eye</i>
                            </div>

                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            
            <div class="mb-4">

                <ul class="pagination justify-content-start pagination-xsm m-0">
                    @for ($i = 1; $i <= $hotCourses->lastPage(); $i++)
                        <li class="page-item">
                        <a class="hotLink page-link @if ($i == $hotCourses->currentPage()) selected_page @endif" href="{{route('browse-course')}}?page={{ Request()->page }}&hotpage={{$i}}" aria-label="Page {{$i}}">
                                <span>{{$i}}</span>
                            </a>
                        </li>
                    @endfor
                    <li class="simpleLoader ml-2 hidden"></li>
                </ul>

                {{-- {{ $courses->links() }} --}}

            </div>

            <!-- Khoá học mới -->

            <div class="page-separator">
                <div class="page-separator__text">Khoá học mới</div>
            </div>

            <div class="d-flex flex-column flex-sm-row align-items-sm-center mb-24pt" style="white-space: nowrap;">
                <div class="w-auto ml-sm-auto table d-flex align-items-center mb-2 mb-sm-0">
                    {{-- <span class="text-muted text-headings text-uppercase mr-3 d-none d-sm-block">Sắp xếp theo</span> --}}
                    <a class="small text-headings text-uppercase ml-2  mr-3 d-none d-sm-block">Sắp xếp theo</a>

                    {{-- <select class="form-control custom-select" name="time" id="time">
                        <option value="all">Tất cả</option>
                        <option value="desc">Mới nhất</option>
                        <option value="asc">Cũ nhất</option>
                    </select> --}}
                    <select class="form-control custom-select" name="price" id="price">
                        <option value="all" @if(request()->get('priceFilter') == 'all') selected @endif>Tất cả</option>
                        <option value="asc" @if(request()->get('priceFilter') == 'asc') selected @endif>Rẻ nhất</option>
                        <option value="desc" @if(request()->get('priceFilter') == 'desc') selected @endif>Đắt nhất</option>
                    </select>
                    {{-- <a href="#" class="sort desc small text-headings text-uppercase">Newest</a> --}}


                </div>

                <a  data-target="#library-drawer" data-toggle="sidebar" class="btn btn-sm btn-white ml-sm-16pt">
                    <i class="material-icons icon--left">tune</i> Lọc khoá học
                </a>

            </div>

            <div class="row card-group-row">

                @include('layout.student-course-item');

            </div>

            <div class="mb-32pt">

                <ul class="pagination justify-content-start pagination-xsm m-0">
                    <li class="page-item @if ($courses->currentPage() == 1) disabled @endif">
                    <a class="page-link" href="{{route('browse-course')}}?hotpage={{ Request()->hotpage }}&page={{max($courses->currentPage() - 1, 1)}}" aria-label="Previous">
                            <span aria-hidden="true" class="material-icons">chevron_left</span>
                            <span>Prev</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $courses->lastPage(); $i++)
                        <li class="page-item">
                        <a class="page-link @if ($i == $courses->currentPage()) selected_page @endif" href="{{route('browse-course')}}?hotpage={{Request()->hotpage}}&page={{$i}}" aria-label="Page {{$i}}">
                                <span>{{$i}}</span>
                            </a>
                        </li>
                    @endfor
                    <li class="page-item @if ($courses->currentPage() == $courses->lastPage()) disabled @endif">
                        <a class="page-link" href="{{route('browse-course')}}?hotpage={{Request()->hotpage}}&page={{min($courses->currentPage() + 1, $courses->lastPage())}}" aria-label="Next">
                            <span>Next</span>
                            <span aria-hidden="true" class="material-icons">chevron_right</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <!-- Filter drawler -->
    <div class="mdk-drawer js-mdk-drawer " id="library-drawer" data-align="end">
        <div class="mdk-drawer__content ">
            <div class="sidebar sidebar-light sidebar-right py-16pt" data-perfect-scrollbar data-perfect-scrollbar-wheel-propagation="true">
            
                <div class="sidebar-heading">Danh mục</div>
                <div class="d-flex align-items-center mb-24pt">
                    <form class="search-form search-form--light mx-16pt pr-0 pl-16pt">
                        <input id="searchTopicCourse" type="text" class="form-control pl-0" placeholder="Tìm kiếm danh mục...">
                        <button class="btn" type="submit"><i class="material-icons">search</i></button>
                    </form>
                </div>
                <ul id="listTopicCourse" class="sidebar-menu">
                    <li class="sidebar-menu-item active">
                        <a href="{{route('browse-course')}}" class="sidebar-menu-button filterCourse">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">style</span>
                            <span class="sidebar-menu-text">Tất cả</span>
                        </a>
                    </li>
                    @foreach ($topics as $item)
                    <li class="sidebar-menu-item active">
                        <a href="{{route('browse-course', ['topicId'=>$item->id])}}" class="sidebar-menu-button filterCourse">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">{{ $item->icon }}</span>
                            <span class="sidebar-menu-text">{{ $item->name }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
@endsection
