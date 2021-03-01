@extends('layout.app')

@section('content')
<div class="pt-32pt pt-sm-64pt pb-32pt">
    <div class="container page__container">
        <form id="demo-form" class="col-md-5 p-0 mx-auto">
            @csrf
            {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
            <div class="form-group">
                <label class="form-label" for="email">Email/Tên đăng nhập:</label>
                <input id="login" value="{{ old('login') }}" name="login" type="text" class="form-control" placeholder="Email hoặc tên đăng nhập của bạn ...">
            <small id="usernameHelp" class="form-text text-danger"></small>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Mật khẩu:</label>
                <input id="password" name="password" value="{{ old('password') }}" type="password" class="form-control" placeholder="Mật khẩu của bạn ...">
                <small id="passwordHelp" class="form-text text-danger"></small>
                <div class="d-flex justify-content-between mt-2">
                    <label class="small" style="color: rgba(39,44,51,.7);margin-top: 1px;" for="remember_me"><input type="checkbox" name="remember_me" id="remember_me" checked>&nbsp Duy trì đăng nhập</label>
                    {{-- <p><a href="{{ route('forgot_password')}}" class="small">Quên mật khẩu?</a></p> --}}
                    <button type="button" class="text-btn" data-toggle="modal" data-target="#resetPasswordModal">Quên mật khẩu</button>
            </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="text-center">
                    <button class="btn btn-primary" id="loginBtn" onclick="wait_server()">Đăng nhập</button>
                </div>
                <div class="text-center">
                    <a href="{{ route('signup') }}" class="btn btn-success" role="button">Đăng ký</a>
            </div>
            </div>
        </form>
    </div>
</div>

<div class="page-separator justify-content-center m-0">
    <div class="page-separator__text">Hoặc đăng nhập với</div>
</div>
<div class="bg-body pt-32pt pb-32pt pb-md-64pt text-center">
    <div class="container page__container">
        <a href="/redirect/facebook" class="btn btn-secondary btn-block-xs"id="su_facebook" onclick="wait_server()">Facebook</a>
        <a href="/redirect/github" class="btn btn-secondary btn-block-xs"id="su_github" onclick="wait_server()">Github</a>
        <a href="/redirect/google" class="btn btn-secondary btn-block-xs" id="su_google" onclick="wait_server()">Google</a>
    </div>
</div>
@include('layout.dialog.resetpassword')
@endsection
@section('script')
<script src="https://www.google.com/recaptcha/api.js?render=6LcFjQQaAAAAAMybBuOQV3e86OOJKFIeJhSYqVhc"></script>
@endsection