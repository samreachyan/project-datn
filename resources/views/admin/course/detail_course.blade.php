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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="row no-gutters align-items-center">
                            <div class="col-md-4">
                                <img src={{ asset($course[0]->thumbnail_url) }} class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $course[0]->name }}</h5>
                                    <p class="card-text">{!! $course[0]->introduce !!}</p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div> <!-- end card-body-->

                                <div class="card-body">
                                    <a href="#" class="btn btn-info"><i class="mdi mdi-account-circle mr-1"></i> <span>{{ App\Models\Account::find($course[0]->instructor_id)->name }} - Instructor</span> </a>
                                    <a href="/admin/course/del/{{ $course[0]->id }}" class="btn btn-danger"><i class="mdi mdi-delete mr-1"></i> <span>Delete course</span> </a>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->

            {{-- <div class="row">
                <div class="col-md-12 col-lg-12">
                    <table class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Account No.</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course->students() as $item)
                            <tr>
                                <td class="table-user">
                                    <img src="/admin/images/users/avatar-2.jpg" alt="table-user" class="mr-2 rounded-circle" />
                                    Risa D. Pearson
                                </td>
                                <td>AC336 508 2157</td>
                                <td>July 24, 1950</td>
                                <td class="table-action">
                                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <nav class="justify-content-center">
                    <ul class="pagination pagination-rounded justify-content-center mb-0">
                        <li class="page-item">
                            <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                        <li class="page-item active"><a class="page-link" href="javascript: void(0);">3</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                        <li class="page-item">
                            <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div> --}}
            <!-- end row -->

        </div>
        <!-- end container fluid-->
    </div>
</div>
@endsection
