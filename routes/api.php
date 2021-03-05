<?php

use App\Http\Controllers\API\AccountController as APIAccountController;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function () {
    return response()->json([ 'msg' => "hello world", 'data' => [ 'm' => 'mes', 'n' => 'work'] ], 200);
});

// Login and Signup
Route::get('/users', [APIAccountController::class, 'index']);
Route::post('/login', [APIAccountController::class, 'login']);
Route::post('/signup', [APIAccountController::class, 'store']);
Route::post('/get_verify_code', [APIAccountController::class, 'getVerifyCode']);
Route::post('/check_verify_code', [APIAccountController::class, 'checkVerifyCode']);
Route::post('/forgot-password', [APIAccountController::class, 'forgotPassword']);
Route::post('/change-forgot-password', [APIAccountController::class, 'changeForgotPassword']);

// Authorization
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/get', function () {
        return ['get test'];
    });
    Route::post('/token', [APIAccountController::class, 'show']);
    Route::post('/signup-info-after-signup', [APIAccountController::class, 'signupInfoAfterSignup']);
    Route::post('/change-password', [APIAccountController::class, 'changePassword']);
});
