@extends('layout.app')

@section('content')
<div class="page-section pb-0">
    <div class="container page__container d-flex flex-column flex-sm-row align-items-sm-center">
        <div class="flex">
            <h1 class="h2 mb-0">Đổi mật khẩu</h1>
            {{-- <p class="text-breadcrumb">Account Management</p> --}}
        </div>
        <p class="d-sm-none"></p>
        <a href="" class="btn btn-outline-secondary flex-column">
            Cần giúp đỡ?
            <span class="btn__secondary-text">Liên hệ</span>
        </a>
    </div>
</div>

<div class="page-section">
    <div class="container page__container">
        <div class="page-separator">
            <div class="page-separator__text">Nhập mật khẩu mới của bạn</div>
        </div>

    <form action="{{ route('post_change_password') }}" method="post">
        @csrf
        <input type="hidden" name='code' value="{{$code}}">
        <div class="form-group mb-24pt passwordBlock">
            <label class="form-label" for="password">Mật khẩu:</label>
            <input id="password" name="password" type="password" class="form-control" onkeyup="isPasswordValid('password')" placeholder="Mật khẩu của bạn ...">
            <div class="col-md-12 passReqBlock">
                <div class="passRequire" id="length">Lớn hơn 8 ký tự.</div>
                <div class="passRequire" id="capital">Có chữ cái hoa và thường.</div>
                <div class="passRequire" id="special">Có ký tự đặc biệt (!@#$%^&*.,<>/\'";:?).</div>
            </div>
        </div>
        <div class="form-group mb-24pt">
            <label class="form-label" for="repassword">Nhập lại mật khẩu:</label>
            <input id="repassword" type="password" class="form-control" onkeyup="isPassConfirmed('password','repassword')" placeholder="Nhập lại mật khẩu của bạn ...">
        </div>
        <button onclick="return validateForm()" class="btn btn-primary" type="submit" name="submit">Đổi mật khẩu</button>
    </form>
    </div>
</div>
@endsection