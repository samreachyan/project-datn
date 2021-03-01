@extends('layout.app')
@section('active-manage_courses', 'active')
@section('page')
    | {{ Auth::user()->username}} - Manage course
@endsection
@section('content')
<script>
    var courses = {!! $courses->toJson() !!};
    console.log(courses);
    var deleteSections = [];
    var deleteLessons = [];
    var deleteQuizzes = [];
</script>
<div class="pt-32pt">
    <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">Quản lý khoá học</h2>
                
                <ol class="breadcrumb p-0 m-0">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    
                <li class="breadcrumb-item active">
                    Quản lý khoá học
                </li>

                </ol>
                
            </div>
        </div>
        
        
        <div class="row add_button" role="tablist">
            <div class="col-auto">
                <a class="btn btn-outline-secondary add_course_btn" onclick="addCourse()">Thêm khoá học</a>
            </div>
        </div>
        
    </div>
</div>
<div id= "manage_course" class="content_layout active">
    @include('layout.course-item');
</div>
<div id="edit_course" class="content_layout" course_id="new">
    <div class="page-section border-bottom-2">
        <div class="container page__container">
            <div class="row">
                <div class="col-md-8">
                    @csrf
                    <div class="page-separator">
                        <div class="page-separator__text">Thông tin cơ bản</div>
                    </div>
                    <label class="form-label">Tên khoá học</label>
                    <div class="form-group mb-24pt">
                        <input id="course_name" type="text" class="form-control form-control-lg" placeholder="Tên khoá học..." value="">
                    </div>
                    
                    <div class="form-group mb-32pt">
                        <label class="form-label">Giới thiệu</label>
                        {{-- <textarea id="course_intro" class="form-control" rows="5" placeholder="Mô tả khoá học..."></textarea> --}}
                        <div id="course_intro" style="height: 150px;" class="mb-0" data-toggle="quill" data-quill-placeholder="Mô tả khoá học...">
                        </div>
                        <small class="form-text text-muted">Đọc <a href="https://viblo.asia/helps/cach-su-dung-markdown-bxjvZYnwkJZ" target="_blank">hướng dẫn </a>để sử dụng markdown</small>
                    </div>

                    <div class="page-separator">
                        <div class="page-separator__text">Chương</div>
                    </div>

                    <div class="accordion js-accordion accordion--boxed mb-24pt" id="parent">


                    </div>

                    <button class="btn btn-outline-secondary mb-24pt mb-sm-0" onclick="addNewSection()">Thêm chương</button>

                </div>
                <div class="col-md-4">

                    <div class="page-separator">
                        <div class="page-separator__text">Tuỳ chọn</div>
                    </div>
                    <div class="card">
                        <div class="card-body p-3">
                            <input type="file"  accept="image/*" name="image" id="course_thumbnail"  onchange="loadFile(event)" style="display: none;">
                            <label class="form-label" for="course_thumbnail" style="cursor: pointer;">Ảnh Thumbnail</label>
                            <br>
                            <img id="output_thumbnail" style="max-width:100%;margin: auto;display: block;" />
                            <img id="old_thumbnail" style="max-width:100%;margin: auto;display: block;" />
                            <div class="mt-2 text-center">
                                <label class="btn btn-light form-label" for="course_thumbnail" style="cursor: pointer;">Chọn ảnh</label>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="form-group mb-0">
                                <label class="form-label" for="select_topic">Chủ đề</label>
                                <br>
                                <ul class="d-flex topic_list">
                                </ul>
                                <input class="form-control mb-1" id="search_topic" type="text" placeholder="Tìm kiếm..">
                                <select id="select_topic" size="7" data-toggle="select" multiple class="form-control">
                                    @foreach ($topics as $topic)
                                        <option topic_id='{{ $topic->id }}'>{{ $topic->name }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Chọn các topic phù hợp với khoá học.</small>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Giá</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group form-inline">
                                            <input id="course_price" type="number" class="form-control" value="100000">
                                            <span class="input-group-prepend"><span class="input-group-text">VNĐ</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header text-center">
                            <a id="saveCourse" class="btn btn-accent whiteButton">Lưu thay đổi</a>
                        </div>
                        <div class="list-group list-group-flush">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
