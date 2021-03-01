@extends('admin.layout.app')

@section('content')

<div class="content-page">
    <div class="content">
        @include('admin.layout.topbar')

        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href={{ route('admin_home') }}>Vina School</a></li>
                                <li class="breadcrumb-item"><a href={{ route('all_courses') }}>Khóa học</a></li>
                                <li class="breadcrumb-item active">Khóa học</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Khóa học</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="text-muted font-weight-normal mt-0 text-truncate" title="Campaign Sent">All Students</h5>
                                    <h3 class="my-2 py-1">{{ $students }}</h3>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="text-muted font-weight-normal mt-0 text-truncate" title="Campaign Sent">All Instructors</h5>
                                    <h3 class="my-2 py-1">{{ $instructors }}</h3>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="text-muted font-weight-normal mt-0 text-truncate" title="Campaign Sent">All Courses</h5>
                                    <h3 class="my-2 py-1">{{ $course }}</h3>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row-->

            <div class="row">
                @foreach ($courses as $item)
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <img src={{ asset($item->thumbnail_url) }} class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <a href="/admin/course/detail/{{ $item->id }}" class="btn btn-primary mt-2 stretched-link">View details</a>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col-->
                @endforeach

            </div>
            {{-- end row  --}}

            <nav>
                <ul class="pagination pagination-rounded justify-content-center mb-0">
                    <li class="page-item @if ($courses->currentPage() == 1) disabled @endif"">
                        <a class="page-link" href="{{ route('all_courses') }}?page={{max($courses->currentPage() - 1, 1)}}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>

                    @for ($i = 1; $i <= $courses->lastPage(); $i++)
                    <li class="page-item @if ($i == $courses->currentPage()) active @endif"><a class="page-link" href="{{ route('all_courses') }}?page={{$i}}">{{ $i }}</a></li>
                    @endfor

                    <li class="page-item @if ($courses->currentPage() == $courses->lastPage()) disabled @endif">
                        <a class="page-link" href="{{ route('all_courses') }}?page={{ min($courses->currentPage() + 1, $courses->lastPage()) }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>


        @include('admin.layout.footer')

    </div>
</div>
@endsection
