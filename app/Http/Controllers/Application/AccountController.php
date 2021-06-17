<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Account;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\Admin;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Jobs\SendVerifyEmail;
use App\Jobs\SendResetPasswordEmail;
use App\Models\Course;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use App\Services\SocialAccountService;
use Laravel\Socialite\Facades\Socialite;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
            switch ($role) {
                case UserRole::Student: {
                        return redirect()->route('student_dashboard', ['username' => Auth::user()->username]);
                    }
                case UserRole::Instructor: {
                        return redirect()->route('instructor_dashboard', ['username' => Auth::user()->username]);
                    }
                case UserRole::Admin: {
                        return redirect()->route('admin_home', ['username' => Auth::user()->username]);
                    }
                default: {
                        return redirect()->route('home');
                    }
            }
        } else {
            $courses = Course::withCount('students')->orderBy('created_at', 'desc')->with('topics')->paginate(8);
            // dd($courses);

            return view('index', ['courses' => $courses]);
        }
    }
    public function getUser($username)
    {
        $account = Account::where('username', $username)->first();
        $role = 9;
        if ($account != null) {
            $role = $account->role;
        }
        switch ($role) {
            case UserRole::Student: {
                    return redirect()->route('student_dashboard', ['username' => $username]);
                }
            case UserRole::Instructor: {
                    return view('instructor.dashboard.profile', ['account' => $account, 'instructor' => Instructor::find($account->id)]);
                }
            default: {
                    return redirect()->route('home');
                }
        }
    }

    public function store(Request $request)
    {
        $confirmation_code = time() . uniqid(true);
        $account = new Account;
        $account->name = $request->name;
        $account->username = $request->username;
        $account->email = $request->email;
        $account->confirmation_code = $confirmation_code;
        $account->password = Hash::make($request->password);
        if ($request->role == 'instructor') {
            $account->role = UserRole::Instructor;
            $user = new Instructor;
        } else {
            $user = new Student;
            $account->role = UserRole::Student;
        }
        $account->save();
        $user->account()->associate($account);
        $user->account_id = $account->id;
        // $account->user()->associate($user);
        $user->save();
        dispatch(new SendVerifyEmail($account));
        // Session::put("register_success", $request->username." đã đăng ký thành công");
    }

    public function verify($code)
    {
        $account = Account::where('confirmation_code', $code)->first();
        if ($account) {
            $account->is_verified = true;
            $account->confirmation_code = null;
            $account->save();
            Auth::login($account, true);
            return redirect()->route('home');
        } else {
            abort(404, 'Link xác thực hết hạn');
            return redirect(route('signup'))->with('status', 'Vui long đăng ký lại tải khoàn');
        }
    }

    public function sendVerify($login_info)
    {
        if (filter_var($login_info, FILTER_VALIDATE_EMAIL)) {
            $account = Account::where('email', $login_info)->first();
        } else {
            $account = Account::where('username', $login_info)->first();
        }
        if ($account) {
            $confirmation_code = time() . uniqid(true);
            $account->confirmation_code = $confirmation_code;
            $account->save();
            dispatch(new SendVerifyEmail($account));
            return response()->json(['status' => 'Thành công', 'mss' => 'Đã gửi email xác thực cho ' . $account->email]);
        }
        return response()->json(['status' => 'error', 'mss' => 'Không tìm thấy thông tin đăng nhập ' . $account->email]);
    }

    public function policy()
    {
        return view('application.account.pricing');
    }
    public function pricing()
    {
        return view('application.account.pricing');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function login()
    {
        return view('application.account.login');
    }
    public function authenticate(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
        }
        //for dev
        $disableCaptcha = true;
        if (!$disableCaptcha) {
            if ($request->captcha) {
                $secret   = '6LcFjQQaAAAAAI4U1LuYdozXaixCEeYgsZHKZt_r';
                $response = file_get_contents(
                    "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $request->captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']
                );
                // use json_decode to extract json response
                $response = json_decode($response);

                if ($response->success === false) {
                    //Do something with error
                    return response()->json(['status' => 'token_error', 'mss' => "Lỗi captcha."]);
                }
            } else {
                return response()->json(['status' => 'token_error', 'mss' => "Lỗi captcha."]);
            }
        }
        if ($disableCaptcha || $response->success == true && $response->score >= 0.5) {
            //Do something to denied access
            $login_info = $request->login;
            // $pass = $request->password;
            if (filter_var($login_info, FILTER_VALIDATE_EMAIL)) {
                //user sent their email
                $user = Account::whereRaw('LOWER(email) = ?', $login_info)->first();
                // Auth::attempt(['email' => $login_info, 'password' => $request->password], $request->remember_me);
            } else {
                //they sent their username instead
                $user = Account::whereRaw('LOWER(username) = ?', $login_info)->first();
                // Auth::attempt(['username' => $login_info, 'password' => $request->password], $request->remember_me);
            }
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user, $request->remember_me);
            }
            if (Auth::check()) {
                if (Auth::user()->is_verified) {
                    // Authentication passed...
                    // $a = Auth::user()->role;
                    if (Auth::user()->role == UserRole::Instructor) {
                        return response()->json(['status' => 'success', 'mss' => route('instructor_dashboard', ['username' => Auth::user()->username])]);
                        // return redirect()->route('instructor_dashboard', ['username' => Auth::user()->username]);
                    }
                    if (Auth::user()->role == UserRole::Student) {
                        return response()->json(['status' => 'success', 'mss' => route('student_dashboard', ['username' => Auth::user()->username])]);
                        // return redirect()->route('student_dashboard', ['username' => Auth::user()->username]);
                    }
                    if (Auth::user()->role == UserRole::Admin) {
                        return response()->json(['status' => 'success', 'mss' => route('admin_home', ['username' => Auth::user()->username])]);
                        // return redirect()->route('student_dashboard', ['username' => Auth::user()->username]);
                    }
                }
                $email = Auth::user()->email;
                Auth::logout();
                return response()->json(['status' => 'error_verify', 'mss' => "Tài khoản chưa được xác thực.", 'email' => $email]);
            }
            if ($user == null) {
                return response()->json(['status' => 'error_info', 'mss' => "Không tìm thấy thông tin đăng nhập."]);
            } else {
                return response()->json(['status' => 'error_password', 'mss' => "Sai mật khẩu."]);
            }
        } else {
            return response()->json(['status' => 'error_robot', 'mss' => "Get away you Robot."]);
        }
    }

    public function signup()
    {
        return view('application.account.signup');
    }
    public function postsignup(Request $request)
    {
        $account = Account::whereRaw('LOWER(username) = ?', $request->username)->first();
        if ($account) {
            return redirect()->back()->withErrors(['username', 'Username đã được sử dụng'])->withInput();
        }
        $rules = array(
            'name' => 'bail|required|string|min:2|',
            'username' => 'bail|required|string|min:2|unique:accounts',
            'email' => 'bail|required|email|unique:accounts',
            'password' => 'bail|required|string|min:6'
        );
        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            $this->store($request);
            // $request->flash();
            Auth::logout();
            return redirect(route('signup_payment'));
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function signup_payment()
    {
        return view('application.account.signup-payment');
    }

    public function change_password(Request $request)
    {
        return view('application.account.reset-password', ['code' => $request->code]);
    }
    public function post_change_password(Request $request)
    {
        $account = Account::where('confirmation_code', $request->code)->first();
        if ($account) {
            $account->password = Hash::make($request->password);
            $account->confirmation_code = null;
            $account->save();
            Auth::login($account, true);
            Auth::logoutOtherDevices($request->password);
            return redirect()->route('home');
        } else {
            $notification_status = 'Đường dẫn hết hạn';
            return response(['error' => true, 'error-msg' => $notification_status], 419);
        }
    }

    public function request_change_password()
    {
        $confirmation_code = time() . uniqid(true);
        Auth::user()->confirmation_code = $confirmation_code;
        Auth::user()->save();
        dispatch(new SendResetPasswordEmail(Auth::user()));
        return response()->json(['status' => 'success', 'mss' => "Email hướng dẫn đổi mật khẩu đã được gửi cho bạn"]);
    }

    public function forgot_password(Request $request)
    {
        $login_info = $request->email;
        if (filter_var($login_info, FILTER_VALIDATE_EMAIL)) {
            $account = Account::whereRaw('LOWER(email) = ?', $login_info)->first();
        } else {
            $account = Account::whereRaw('LOWER(username) = ?', $login_info)->first();
        }
        if ($account == null) {
            return response()->json(['status' => 'error', 'mss' => "Không tìm thấy thông tin đăng nhập."]);
        } else {
            $confirmation_code = time() . uniqid(true);
            $account->confirmation_code = $confirmation_code;
            $account->save();
            dispatch(new SendResetPasswordEmail($account));
            return response()->json(['status' => 'success', 'mss' => "Email hướng dẫn đổi mật khẩu đã được gửi cho bạn nếu email/username của bạn tồn tại
            trong hệ thống."]);
        }
    }

    public function edit_account()
    {
        return view('application.account.edit-account');
    }

    public function profile_privacy(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->hasFile('avatar')) {
                $image = $request->file('avatar');
                $fileName = $user->username . '-avatar-200x200' . '.' . $image->getClientOriginalExtension();

                $avatar = Image::make($image->getRealPath());
                $avatar->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $avatar->stream();
                if (Storage::exists('public/images/avatars' . '/' . $fileName)) {
                    Storage::delete('public/images/avatars' . '/' . $fileName);
                }
                Storage::disk('local')->put('public/images/avatars' . '/' . $fileName, $avatar, 'public');
                $user->avatar_url = Storage::url('public/images/avatars' . '/' . $fileName);
            }
            if ($user->role == UserRole::Instructor) {
                $instructor = Instructor::find($user->id);
                $instructor->introduce = $request->introduce;
                $instructor->save();
            }
            $user->save();
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }

    public function email_notification()
    {
        return view('application.account.email-notification');
    }

    public function account_password()
    {
        return view('application.account.account-password');
    }

    public function billing()
    {
        return view('application.account.subscription');
    }

    public function billing_upgrade()
    {
        return view('application.account.upgrade');
    }

    public function billing_payment()
    {
        return view('application.account.payment-information');
    }

    public function billing_history()
    {
        return view('application.account.payment-history');
    }

    public function billing_invoice()
    {
        return view('application.account.invoice');
    }

    public function redirect($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        $user = SocialAccountService::createOrGetUser(Socialite::driver($social)->user(), $social);
        auth()->login($user);
        return redirect()->route('home');
    }
}