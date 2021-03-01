@extends('layout.app')
@section('active-edit-account', 'active')
@section('content')
<div class="pt-32pt">
    <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center">

            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">Chỉnh sửa thông tin</h2>

                <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><a href="index">Home</a></li>

                    <li class="breadcrumb-item">

                        <a href="">Tài khoản</a>

                    </li>

                    <li class="breadcrumb-item active">

                        Chỉnh sửa thông tin

                    </li>

                </ol>

            </div>
        </div>


    </div>
</div>

<div class="container page__container page-section">
    <form class="d-md-flex justify-content-between" enctype="multipart/form-data" >
        @csrf
        <div class="col-md-4 p-0">
            <div class="page-separator">
                <div class="page-separator__text">Thông tin cơ bản</div>
            </div>
            <div class="form-group">
                <label class="form-label">Tên đầy đủ</label>
                <input id="user_name" name="user_name" type="text" class="form-control" value="{{Auth::user()->name}}" placeholder="Tên của bạn ...">
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input id="user_email" name="user_email" type="email" class="form-control" value="{{Auth::user()->email}}" placeholder="Email của bạn ...">
                <small class="form-text text-muted">Bạn sẽ phải xác thực lại nếu đổi email</small>
            </div>
            <button id="save_user_info" class="btn btn-primary" type="submit">Lưu thông tin</button>
        </div>
        <div class="col-md-7 p-0">
            <div class="page-separator">
                <div class="page-separator__text">Thông tin thêm</div>
            </div>
            <div class="form-group">
                <input type="file"  accept="image/*" name="avatar" id="avatar"  onchange="loadFile(event)" style="display: none;">
                <label class="form-label" for="avatar" style="cursor: pointer;">Avatar</label>
                <br>    
                <img id="output_thumbnail" style="max-width:80%;margin: auto;display: block;" src="{!!asset(Auth::user()->avatar_url) .'?'. time() !!}"/>
                <img id="old_thumbnail" style="max-width:80%;margin: auto;display: block;" src=""/>
                <div class="mt-2 text-center">
                    <label class="btn btn-light form-label" for="avatar" style="cursor: pointer;">Chọn ảnh</label>
                </div>
            </div>
            @if (Auth::user()->role == App\Enums\UserRole::Instructor)
                <div class="form-group">
                    <label class="form-label">Giới thiệu</label>
                    <div id="introduce" style="height: 200px;" class="mb-0" data-toggle="quill" data-quill-placeholder="Giới thiệu bản thân...">
                        {!! App\Models\Instructor::find(Auth::user()->id)->introduce !!}
                    </div>
                </div>
            @endif
        </div>
    </form>
</div>
@endsection
