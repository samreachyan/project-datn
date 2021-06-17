<?php

use App\Http\Controllers\API\AccountController as APIAccountController;
use App\Http\Controllers\API\CourseController as APICourseController;
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
    return response()->json(['msg' => "hello world", 'data' => ['m' => 'mes', 'n' => 'work']], 200);
});

// Login and Signup
Route::get('/users', [APIAccountController::class, 'index']);
Route::post('/login', [APIAccountController::class, 'login']);
Route::post('/signup', [APIAccountController::class, 'store']);
Route::post('/get_verify_code', [APIAccountController::class, 'getVerifyCode']);
Route::post('/check_verify_code', [APIAccountController::class, 'checkVerifyCode']);
Route::post('/forgot-password', [APIAccountController::class, 'forgotPassword']);
Route::post('/reset-password', [APIAccountController::class, 'resetPassword']);

// Authorization
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/get', function () {
        return ['get test'];
    });
    Route::post('/token', [APIAccountController::class, 'show']);
    Route::post('/signup-info-after-signup', [APIAccountController::class, 'signupInfoAfterSignup']);
    Route::post('/change-password', [APIAccountController::class, 'changePassword']);

    // course router by token
    Route::post('/get-all-courses', [APICourseController::class, 'getAllCourses']);
    Route::post('/hot-courses', [APICourseController::class, 'hotCourses']);
    Route::post('/course-details', [APICourseController::class, 'courseDetails']);

    // instructor profile information
    Route::post('/instructor-profile', [APIAccountController::class, 'instructorProfile']);
    Route::post('/follow-instructor', [APIAccountController::class, 'followInstructor']);
    Route::post('/unfollow-instructor', [APIAccountController::class, 'unfollowInstructor']);
});
