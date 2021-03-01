<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Instructor\InstructorController;
use App\Http\Controllers\Application\AccountController;
use App\Http\Controllers\AdminController\AdminController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [AccountController::class, 'home'])->name('home');

// Admin router
Route::group(['prefix' => 'admin', 'middleware' => 'CheckAdmin'], function () {
    Route::get('/home', [AdminController::class, 'getIndex'])->name('admin_home');
    Route::get('/allcourses', [AdminController::class, 'allCourse'])->name(('all_courses'));
    Route::get('/user-account', [AdminController::class, 'getUser'])->name('user');
    Route::get('/user-account/del/{id}', [AdminController::class, 'delUser']);
    Route::get('/course/detail/{id}', [AdminController::class, 'getCourseDetail'])->name('course_detail');
    Route::get('/course/del/{id}', [AdminController::class, 'delCourse']);
});

Route::group(['middleware' => 'CheckStudent'], function () {
    Route::get('/{username}', [AccountController::class, 'getUser'])->name('get_user_home');
});
// Student router
Route::group(['prefix' => 'student', 'middleware' => 'CheckStudent'], function () {
    Route::get('/{username}/dashboard', [StudentController::class, 'dashboard'])->name('student_dashboard');
    Route::get('/course-preview/{id}', [StudentController::class, 'course_preview'])->name('student_course');
    Route::get('/lesson-preview/{course_id}', [StudentController::class, 'lesson_preview'])->name('student_lesson');
    Route::get('/browse-course', [StudentController::class, 'browsecourse'])->name('browse-course');
    Route::get('/browse-path', [StudentController::class, 'browsepath']);
    Route::get('/{username}/my-course', [StudentController::class, 'mycourse'])->name('my_course');
    Route::get('/my-path', [StudentController::class, 'mypath'])->name('my_path');

    Route::post('/buy-course', [StudentController::class, 'buycourse'])->name('buy_course');
    Route::post('/section-lesson', [StudentController::class, 'lessonCheckpoint'])->name('section_lesson');
    Route::post('/section-score', [StudentController::class, 'sectionScore'])->name('section_score');

    Route::post('/follow', [StudentController::class, 'follow'])->name('follow');
    Route::post('/unfollow', [StudentController::class, 'unfollow'])->name('unfollow');

    Route::get('/search', [StudentController::class, 'search'])->name('search');

    Route::post('/rate-course', [StudentController::class, 'rateCourse'])->name('rate_course');
});

// Instructor router
Route::group(['prefix' => 'instructor', 'middleware' => 'CheckInstructor'], function () {
    Route::get('/{username}/dashboard', [InstructorController::class, 'dashboard'])->name('instructor_dashboard');
    Route::get('/manage-courses', [InstructorController::class, 'manage_courses'])->name('manage_courses');
    Route::get('/manage-quizzes', [InstructorController::class, 'manage_quizzes'])->name('manage_quizzes');
    Route::post('/edit-course', [InstructorController::class, 'edit_course'])->name('edit_course');
    Route::get('/edit-course', [InstructorController::class, 'get_course'])->name('get_edit_course');
    Route::get('/earning', [InstructorController::class, 'earning'])->name('earning');
});

Route::group(['prefix' => 'account'], function () {
    Route::get('/pricing', [AccountController::class, 'pricing']);
    Route::get('/policy', [AccountController::class, 'policy'])->name('policy');
    Route::get('/login', [AccountController::class, 'login'])->name('login');
    Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
    Route::post('/login', [AccountController::class, 'authenticate'])->name('postlogin');
    Route::get('/signup', [AccountController::class, 'signup'])->name('signup');
    Route::post('/signup', [AccountController::class, 'postsignup'])->name('postsignup');
    Route::get('/verify/{code}', [AccountController::class, 'verify'])->name('verify');
    Route::get('/send-verify/{email}', [AccountController::class, 'sendVerify']);
    Route::get('/signup-payment', [AccountController::class, 'signup_payment'])->name('signup_payment');
    Route::get('/forgot-password', [AccountController::class, 'forgot_password'])->name('forgot_password');
    Route::get('/request-change-password', [AccountController::class, 'request_change_password'])->name('request_change_password');
    Route::get('/change-password', [AccountController::class, 'change_password'])->name('change_password');
    Route::post('/change-password', [AccountController::class, 'post_change_password'])->name('post_change_password');
    Route::get('/edit-account', [AccountController::class, 'edit_account'])->name('edit-account');
    Route::post('/edit-account-profile', [AccountController::class, 'profile_privacy'])->name('save-account');
});

Route::group(['prefix' => 'notification'], function () {
    Route::post('/mark-read', [NotificationController::class, 'readNotification']);
});

Route::get('/redirect/{social}', [AccountController::class, 'redirect'])->name('redirect');
Route::get('/callback/{social}', [AccountController::class, 'callback'])->name('callback');
