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
    public function get_verify_code(Request $request) {
        $rules = array(
            'email'=>'required|email'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $msg = $validator->errors();
            return [ 'msg' => $msg, 'data' => null ];
        } else {
            $account = Account::where('email', $request->email)->first();

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
    public function check_code(Request $request) {
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
    public function show($id)
    {
        //
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
