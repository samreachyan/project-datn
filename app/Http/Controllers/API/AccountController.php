<?php

namespace App\Http\Controllers\API;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Jobs\SendVerifyEmail;
use App\Models\Account;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Account::findOrFail(5);
        return new UserResource($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'username'=>'required|string|min:2|unique:accounts',
            'fullname'=>'required|string|min:2|',
            'email'=>'required|email|unique:accounts',
            'password'=>'required|string|min:6'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $msg = $validator->errors();
            return [ 'msg' => $msg, 'data' => null ];
        } else {
            $confirmation_code = time().uniqid(true);
            $account = new Account;
            $account->name = $request->fullname;
            $account->username = $request->username;
            $account->email = $request->email;
            $account->confirmation_code = $confirmation_code;
            $account->password = Hash::make($request->password);

            // phần loại là student
            $user = new Student();
            $account->role = UserRole::Student;

            $account->save();
            $user->account()->associate($account);
            $user->account_id = $account->id;
            // $account->user()->associate($user);
            $user->save();
            dispatch(new SendVerifyEmail($account));
            // Session::put("register_success", $request->username." đã đăng ký thành công");

            // return [ 'msg' => 'đã đăng ký thành công'];
            $user = Account::find($account->id);
            return new UserResource($user);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getVerifyCode(Request $request) {
        $rules = array(
            'email'=>'required|email'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $msg = $validator->errors();
            return [ 'msg' => $msg, 'data' => null ];
        } else {
            $account = Account::where('email', $request->email)->first();

            if ($account == null) {
                return [
                    'msg' => 'The account isn\'t registered yet' ,
                    'data' => null
                ];
            }

            // check again is already verified
            if ($account->is_verified == 1) {
                return [
                    'msg' => 'Account has been active',
                    'data' => null
                ];
            } else {
                return [
                    'msg' => 'Requested confirmation code successfully',
                    'data' => [
                        'confirmation_code' => $account->confirmation_code
                    ]
                ];
            }
        }
    }

     /**
     * Display the specified resource.
     *
     * @param  string email, confirmation_code
     * @return \Illuminate\Http\Response
     */
    public function checkVerifyCode(Request $request) {
        $rules = array(
            'email'=>'required|email',
            'confirmation_code' => 'required|string'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $msg = $validator->errors();
            return [
                'msg' => $msg,
                'data' => null
            ];
        } else {
            $code = $request->confirmation_code;
            $account = Account::where('confirmation_code', $code)->first();
            // check email are same or not
            if ($account && ($account->email == $request->email)) {
                $account->is_verified = true;
                $account->confirmation_code = null;
                $account->remember_token = Str::random(60); // make remember token
                $account->save();
                return [
                    'msg' => 'The account is verified successfully',
                    'data' => [
                        'id' => $account->id,
                        'active' => $account->is_verified == 1 ? 'true' : 'false'
                    ]
                ];
            } else {
                return [
                    'msg' => 'your email or code is invalid',
                    'data' => null
                ];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $rules = array(
            'email'=>'required|email',
            'password' => 'required|string'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $msg = $validator->errors();
            return [
                'msg' => $msg,
                'data' => null
            ];
        } else {
            $user = Account::whereRaw('LOWER(email) = ?', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                // check account is verified
                if ($user->is_verified == false) {
                    return [
                        'msg' => 'The account not verify yet',
                        'data' => null
                    ];
                }

                $token = $user->createToken('authToken')->plainTextToken;
                $user->remember_token = $token; // make remember token
                $user->save();

                return [
                    "msg" => "The account authenticated",
                    "data" => [
                        'id' => $user->id,
                        'username' => $user->username,
                        'fullfname' => $user->name,
                        'email' => $user->email,
                        'avatar' => $user->avatar_url,
                        'active' => $user->is_verified == 1 ? "true" : "false",
                        'token' => $token,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at,
                    ]
                ];
            } else {
                return [
                    "msg" => "The account not authenticated",
                    "data" => null
                ];
            }
        }
    }
    /**
     * Sign up information after sign just upload avatar
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  file $image
     * @return \Illuminate\Http\Response
     */
    public function signupInfoAfterSignup(Request $request) {
        $rules = array(
            'image' => 'required|mimes:jpeg,png,jpg|mimetypes:image/jpeg,image/png, image/jpg|max:2048',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $msg = $validator->errors();
            return [
                'msg' => $msg,
                'data' => null
            ];
        } else {
            // find user by token
            $email = $request->user()->currentAccessToken()->tokenable->email;
            $user = Account::whereRaw('LOWER(email) = ?', $email)->first();

            // checking file image
            $image = $request->file('image');
            $fileName = $user->username .'-avatar-200x200'. '.' . $image->getClientOriginalExtension();

            $avatar = Image::make($image->getRealPath());
            $avatar->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $avatar->stream();
            if (Storage::exists('public/images/avatars'.'/'.$fileName)) {
                Storage::delete('public/images/avatars'.'/'.$fileName);
            }
            Storage::disk('local')->put('public/images/avatars'.'/'.$fileName, $avatar, 'public');

            $user->avatar_url = Storage::url('public/images/avatars'.'/'.$fileName);
            $user->save();

            return [
                'msg' => 'Uploaded avatar successfully',
                "data" => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'fullfname' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar_url,
                    'active' => $user->is_verified == 1 ? "true" : "false",
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ]
            ];
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // Revoke the user's current token...
        $user = $request->user()->currentAccessToken()->tokenable;
        return [
            'msg' => 'success',
            "data" => [
                'id' => $user->id,
                'username' => $user->username,
                'fullfname' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar_url,
                'active' => $user->is_verified == 1 ? "true" : "false",
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
