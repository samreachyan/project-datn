<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Account;
use App\Models\Student;
use App\Models\Section;
use App\Models\Lesson;

class AdminController extends Controller
{
    public function getIndex() {
        return view('admin.index');
    }

    public function getUser() {
        $accounts = Account::orderBy('created_at', 'desc')->paginate(15);
        // dd($accounts);
        return view('admin.user.user', ['accounts' => $accounts]);
    }

    public function allCourse() {
        $courses = Course::orderBy('created_at', 'desc')->paginate(8);
        $course = Course::count();
        $students = Account::where('role', 3)->count();
        $instructors = Account::where('role', 2)->count();
        return view('admin.course.course', ['courses' => $courses, 'students' => $students, 'instructors'=>$instructors, 'course'=>$course]);
    }

    public function getCourseDetail($id) {
        $course = Course::where('id' , $id)->get();
        // $students = Course::where('id', $id)->students();
        // dd($students);
        return view('admin.course.detail_course', ['course' => $course]);
    }

    public function delCourse($id) {
        Course::where('id', $id)->delete();
        return redirect(route('all_courses'));
    }

    public function delUser($id) {
        $account = Account::find($id); // find account
        if ($account->role == 2) { // check to delete course, lesson, sections
            $course = Course::where('instructor_id', $account->id);
            $section = Section::where('course_id',$course->id);
            $lesson = Lesson::where('section_id', $section->id);
            $instructors = Instructor::where('account_id', $account->id);
            // delete
            $instructors->delete();
            $lesson->delete();
            $section->delete();
            $course->delete();
            $account->delete();
        } else if ($account->role == 3) { // student
            $account->delete();
        } else {
            $account->delete();
        }

        return redirect(route("user"));
    }
}
