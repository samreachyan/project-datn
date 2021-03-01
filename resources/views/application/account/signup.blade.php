@extends('layout.app')

@section('content')
<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">
            <a class="progression-bar__item progression-bar__item--complete">
                <span class="progression-bar__item-content">
                    <i class="material-icons progression-bar__item-icon">done</i>
                    <span class="progression-bar__item-text h5 mb-0 text-uppercase">Đăng ký</span>
                </span>
            </a>
            <a class="progression-bar__item progression-bar__item--complete progression-bar__item--active">
                <span class="progression-bar__item-content">
                    <i class="material-icons progression-bar__item-icon"></i>
                    <span class="progression-bar__item-text h5 mb-0 text-uppercase">THông tin tài khoản</span>
                </span>
            </a>
            <a class="progression-bar__item">
                <span class="progression-bar__item-content">
                    <i class="material-icons progression-bar__item-icon"></i>
                    <span class="progression-bar__item-text h5 mb-0 text-uppercase">Thông tin thanh toán</span>
                </span>
            </a>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-10 p-0 mx-auto">
        <form id="signup_form" action="{{route('postsignup')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-24pt mb-md-0">
                    <div class="form-group">
                        <label class="form-label" for="name">Tên đầy đủ:</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" class="form-control" onkeyup="isInputNull('name')" placeholder="Họ và tên đầy đủ của bạn ...">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Username:</label>
                        <input id="username" name="username" type="text" value="{{ old('username') }}" class="form-control" onkeyup="isUsername('username')" placeholder="Username có thể dùng để đăng nhập ...">
                        @if ($errors->has('username') || $errors->first() == 'username')
                            <small id="usernameHelp" class="form-text text-danger">Username đã được sử dụng.</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email:</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-control" onkeyup="isInputEmail('email')" placeholder="Email của bạn ...">
                        @if ($errors->has('email'))
                            <small id="emailHelp" class="form-text text-danger">Email đã được đăng ký.</small>
                        @endif
                    </div>
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
                        <label class="form-label" for="password">Nhập lại mật khẩu:</label>
                        <input id="repassword" type="password" class="form-control" onkeyup="isPassConfirmed('password','repassword')" placeholder="Nhập lại mật khẩu của bạn ...">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button onclick="return validateForm()" class="btn btn-primary" type="submit" name="submit">Tạo tài khoản</button>
                        <label for="">Đã có tài khoản?<a href="{{route('login')}}">&nbspĐăng nhập &nbsp</a></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-0">
                        <div class="card-body">
                            <h5>Dành cho giáo viên</h5>
                            <div class="d-flex mb-8pt">
                                <div class="flex"><strong class="text-70">Tạo tài khoản giáo viên</strong></div>
                                {{-- <strong>Giáo viên</strong> --}}
                            </div>
                            
                            <div class="alert alert-soft-warning">
                                <div class="d-flex flex-wrap align-items-start">
                                    <input class="mr-8pt" type="checkbox" name="role" id="role" value="instructor">
                                    <div class="flex" style="min-width: 180px">
                                        <small class="text-black-100">
                                            Đăng các khoá học chất lượng, tiếp cận <strong>hàng ngàn</strong> học sinh. 
                                        </small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex mb-16pt pb-16pt border-bottom">
                                <div class="flex"><strong class="text-70">Giá</strong></div>
                                <strong>200.000 VNĐ/tháng</strong>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="" checked id="policy">
                                <label class="">Điều khoản và chính sách</label>
                                <small class="form-text text-muted">Bằng cách click vào ô này và tiếp tục, tôi đồng ý với <a href="{{ route('policy')}}">Điều khoản và chính sách</a> của xxx</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="page-separator justify-content-center m-0">
    <div class="page-separator__text">Hoặc đăng ký với</div>
</div>
<div class="page-section text-center">
    <div class="container page__container">
        <div class="container page__container">
            <a href="/redirect/facebook" class="btn btn-secondary btn-block-xs"id="su_facebook" onclick="wait_server()">Facebook</a>
            <a href="/redirect/github" class="btn btn-secondary btn-block-xs"id="su_github" onclick="wait_server()">Github</a>
            <a href="/redirect/google" class="btn btn-secondary btn-block-xs" id="su_google" onclick="wait_server()">Google</a>
        </div>
    </div>
</div>
@endsection