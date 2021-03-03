<?php

use App\Http\Controllers\API\AccountController as APIAccountController;
use Illuminate\Http\Request;
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
Route::post('/signup', [APIAccountController::class, 'store']);
Route::post('/get_verify_code', [APIAccountController::class, 'get_verify_code']);
Route::post('/check_verify_code', [APIAccountController::class, 'check_verify_code']);

