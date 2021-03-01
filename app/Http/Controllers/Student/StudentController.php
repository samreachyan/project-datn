<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Topic;
use App\Models\Section;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Account;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BuyCourseNotification;
use Pusher\Pusher;

class StudentController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }

    public function dashboard($username)
    {
        $me = Student::find(Auth::user()->id);
        $myCourses = $me->courses()->with('topics')->get();
        return view('student.dashboard.index', ['courses'=>$myCourses]);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $instructors = Account::where(function ($query) {
            $query->where('role', UserRole::Instructor);
        })->where(function ($query) use ($keyword) {
            $query->whereRaw("LOWER(name) LIKE N'%" . $keyword . "%'")
            ->orWhereRaw("LOWER(username) LIKE N'%" . $keyword . "%'")
            ->orWhereRaw("LOWER(email) LIKE N'%" . $keyword . "%'");
        })
        ->paginate(4, ['*'], 'instructor')
        ;

        $courses = Course::withCount('students')->whereRaw("LOWER(name) LIKE N'%" . $keyword . "%'")
        ->paginate(4, ['*'], 'course');
        if ($request->ajax()) {
            if ($request->has('instructor')) {
                return view('layout.instructor-item', compact('instructors'))->render();
            } else {
                return view('layout.simple-course-item', ['courses'=>$courses])->render();
            }
        }
        return view('student.search', ['instructors' => $instructors, 'courses' => $courses]);
    }

    public function course_preview($id)
    {
        $course = Course::withCount('students')->with('students')->where('id', $id)->first();
        if (!$course) {
            return redirect()->route('browse-course');
        }
        $sections = Section::where('course_id', $id)->orderBy('created_at', 'desc')->get();
        return view('student.course.course-preview', ['course' => $course, 'sections' => $sections]);
    }

    public function browsecourse(Request $request)
    {
        $hotCourses = Course::withCount('students')->orderBy('students_count', 'desc')->paginate(3, ['*'], 'hotpage');
        if ($request->ajax()) {
            return view('layout.hot-course-item', compact('hotCourses'))->render();
        }

        $timeFilter = 'desc';
        $priceFilter = 'all';

        if ($request->has('timeFilter')) {
            $timeFilter = $request->timeFilter;
        }
        if ($request->has('priceFilter')) {
            $priceFilter = $request->priceFilter;
        }

        // $courses = DB::table('courses')->paginate(4);
        if ($request->has('topicId')) {
            if ($priceFilter == 'asc' || $priceFilter == 'desc') {
                $courses = Course::withCount('students')->orderBy('price', $priceFilter)->orderBy('created_at', $timeFilter)->with('topics')->whereHas('topics', function ($q) use ($request) {
                    $q->where('id', $request->topicId);
                })->paginate(8);
            } else {
                $courses = Course::withCount('students')->orderBy('created_at', $timeFilter)->with('topics')->whereHas('topics', function ($q) use ($request) {
                    $q->where('id', $request->topicId);
                })->paginate(8);
            }
        } elseif ($request->has('topic')) {
            if ($priceFilter == 'asc' || $priceFilter == 'desc') {
                $courses = Course::withCount('students')->orderBy('price', $priceFilter)->orderBy('created_at', $timeFilter)->with('topics')->whereHas('topics', function ($q) use ($request) {
                    $q->where('name', $request->topic);
                })->paginate(8);
            } else {
                $courses = Course::withCount('students')->orderBy('created_at', $timeFilter)->with('topics')->whereHas('topics', function ($q) use ($request) {
                    $q->where('name', $request->topic);
                })->paginate(8);
            }
        } else {
            if ($priceFilter == 'asc' || $priceFilter == 'desc') {
                $courses = Course::withCount('students')->orderBy('price', $priceFilter)->orderBy('created_at', $timeFilter)->with('topics')->paginate(8);
            } else {
                $courses = Course::withCount('students')->orderBy('created_at', $timeFilter)->with('topics')->paginate(8);
            }
        }
        $topics = Topic::get();
        // dd($topics);
        return view('student.course.browse-course', ['hotCourses' => $hotCourses, 'courses' => $courses, 'topics'=>$topics]);
    }

    public function buycourse(Request $request)
    {
        $student = Student::find(Auth::user()->id);
        if (!$student->courses()->where('course_id', $request->course_id)->exists()) {
            $course = Course::find($request->course_id);
            $student->courses()->attach($request->course_id);
            $sections = $course->sections()->get();
            foreach ($sections as $section) {
                $student->sections()->attach($section->id);
            }
            $instructor = $course->instructor()->first();
            // $instructor = Instructor::find($course->instructor_id);
            $notify = [
                'notifyName'=>Auth::user()->name,
                'avatar'=>Auth::user()->avatar_url,
                'course_id'=>$course->id,
                'course_name'=>$course->name,
                'type'=>"mua",
            ];
            $instructor->notify(new BuyCourseNotification($notify));
            $notify['receivers'][] = $instructor->account_id;
            $options = array(
                'cluster' => 'ap1',
                'encrypted' => true
            );
    
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
    
            $pusher->trigger('BuyCourseNotifyEvent', 'buy-course-notify', $notify);

            return response()->json(['status'=>'success', 'mss'=>'Mua khoá học thanh công']);
        } else {
            return response()->json(['status'=>'false', 'mss'=>'Đã mua khoá học']);
        }
    }

    public function browsepath()
    {
        return view('student.course.browse-path');
    }

    public function mycourse()
    {
        return view('student.course.my-course');
    }

    public function mypath()
    {
        return view('student.course.my-path');
    }

    public function pathdetail()
    {
        return view('student.course.path-detail');
    }

    public function lesson_preview(Request $request)
    {
        $student = Student::find(Auth::user()->id);
        if ($student->courses()->where('course_id', $request->course_id)->exists()) {
            $course = Course::where('id', $request->course_id)->with(array('sections.lessons', 'sections.quizzes.answers', 'sections.students'=>function ($query) {
                $query->where('student_id', Auth::user()->id);
            }))->first();
            $initLesson = null;
            $oldSectionId = $student->courses()->where('course_id', $request->course_id)->first()->pivot->section_id;
            if ($oldSectionId) {
                $oldLesson = $student->sections()->where('section_id', $oldSectionId)->first();
                if ($oldLesson) {
                    $initLesson = Lesson::find($student->sections()->where('section_id', $oldSectionId)->first()->pivot->lesson_id);
                }
            }
            return view('student.course.lesson-preview', ['course'=>$course, 'initLesson'=>$initLesson]);
        }
        return redirect()->route('student_course', ['id' => $request->course_id]);
    }

    public function follow(Request $request)
    {
        Student::find(Auth::user()->id)->follow($request->instructor_id);
        return response()->json(['status'=>'Thành công', 'mss'=>'Bạn đã follow người dùng']);
    }
    public function unfollow(Request $request)
    {
        Student::find(Auth::user()->id)->unfollow($request->instructor_id);
        return response()->json(['status'=>'Thành công', 'mss'=>'Bạn đã bỏ follow người dùng']);
    }

    public function lessonCheckpoint(Request $request)
    {
        $student = Student::find(Auth::user()->id);
        if ($student->courses()->where('course_id', $request->course_id)->exists()) {
            $student->courses()->updateExistingPivot($request->course_id, ['section_id'=>$request->section_id]);
            if (!$student->sections()->where('section_id', $request->section_id)->exists()) {
                $student->sections()->attach($request->section_id);
            }
            $student->sections()->updateExistingPivot($request->section_id, ['lesson_id' => $request->lesson_id]);
        }
    }
    public function sectionScore(Request $request)
    {
        $student = Student::find(Auth::user()->id);
        if ($student->courses()->where('course_id', $request->course_id)->exists()) {
            // $student->courses()->updateExistingPivot($request->course_id, ['progress'=>$request->progress]);
            if (!$student->sections()->where('section_id', $request->section_id)->exists()) {
                $student->sections()->attach($request->section_id);
            }
            $student->sections()->updateExistingPivot($request->section_id, ['highest_point' => $request->score]);
        }
    }
    public function rateCourse(Request $request)
    {
        $student = Student::find(Auth::user()->id);
        if ($student->courses()->where('course_id', $request->course_id)->exists()) {
            $student->courses()->updateExistingPivot($request->course_id, ['progress'=>$request->rate]);
            return response()->json(['status'=>'success']);
        }
        return response()->json(['status'=>'error']);
    }
}
