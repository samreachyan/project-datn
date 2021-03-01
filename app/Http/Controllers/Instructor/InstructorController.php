<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Section;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
// use DB;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use File;
use Pusher\Pusher;
use App\Models\Instructor;
use App\Notifications\NewCourseNotification;

class InstructorController extends Controller
{
    public function dashboard($username)
    {
        return view('instructor.dashboard.dashboard');
    }

    public function manage_courses(Request $request)
    {
        if (Auth::check()) {
            $courses = Course::where('instructor_id', Auth::user()->id)->withCount('students')->with('topics')->orderBy('created_at', 'desc')->paginate(8);
            if ($request->ajax()) {
                return view('layout.course-item', compact('courses'))->render();
            }
            $topics = Topic::all();
            return view('instructor.courses.manage-courses', ['courses'=>$courses, 'topics'=>$topics]);
        } else {
            abort(404);
        }
    }

    public function manage_quizzes()
    {
        return view('instructor.quizzes.manage-quizzes');
    }

    public function earning()
    {
        return view('instructor.earnings.earnings');
    }

    public function statement()
    {
        return view('instructor.statement.statement');
    }

    public function get_course(Request $request)
    {
        $user = Auth::user();
        $course_id = $request->course_id;
        if ($user === null) {
            return response()->json(['status'=>'error', 'message' => 'User not authenticated', 404]);
        }
        $course = Course::where('id', $course_id)->where('instructor_id', $user->id);
        if ($course === null) {
            return response()->json(['status'=>'error', 'message' => 'User not have permission', 404]);
        }
        $sections = Section::where('course_id', $course_id)->get();
        return view('layout.section-edit', ['sections'=>$sections])->render();
    }

    public function edit_course(Request $request)
    {
        $course = $request->all();
        // $name = Auth::user()->name;
        DB::beginTransaction();
        // DB::transaction(function () use ($course) {
        try {
            $user = Auth::user();
            if ($user === null) {
                return response()->json(['status'=>'error', 'message' => 'User not authenticated', 404]);
            }
            if ($course['id'] == "new") {
                $newCourse = new Course;
            } else {
                $newCourse = Course::where('id', $course['id'])->where('instructor_id', $user->id)->first();
                if ($newCourse === null) {
                    return response()->json(['status'=>'error', 'message' => 'Không tìm thấy khoá học', 404]);
                }
            }

            if (array_key_exists('deleteLessons', $course)) {
                foreach ($course['deleteLessons'] as $delLessonId) {
                    $fileName   = $user->username .'-'. $delLessonId .'.mp4';
                    if (Storage::disk('google')->exists($fileName)) {
                        Storage::delete($fileName);
                    }
                    Lesson::find($delLessonId)->delete();
                }
            }
            if (array_key_exists('deleteQuizzes', $course)) {
                foreach ($course['deleteQuizzes'] as $delQuizId) {
                    Quiz::find($delQuizId)->delete();
                }
            }
            if (array_key_exists('deleteSections', $course)) {
                foreach ($course['deleteSections'] as $delSectionId) {
                    Section::find($delSectionId)->delete();
                }
            }

            $totalTime = 0;
            $totalQuizzes = 0;
            $totalLessons = 0;
            $newCourse->name = $course['name'];
            $newCourse->instructor_id = Auth::user()->id;
            $newCourse->introduce = $course['introduce'];
            $newCourse->price = $course['price'];
            $newCourse->save();
            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $fileName   = $user->username .'-'. $newCourse->id .'-222x168'. '.' . $image->getClientOriginalExtension();

                $thumbnail = Image::make($image->getRealPath());
                $thumbnail->resize(222, 168, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $thumbnail->stream();
                if (Storage::exists('public/images/course_thumbnails'.'/'.$fileName)) {
                    Storage::delete('public/images/course_thumbnails'.'/'.$fileName);
                }
                // Storage::disk('google')->put('public/images/course_thumbnails'.'/'.$fileName, $thumbnail, 'public');
                Storage::disk('local')->put('public/images/course_thumbnails'.'/'.$fileName, $thumbnail, 'public');
                // $newCourse->thumbnail_url = 'images/course_thumbnails/'.$fileName;
                $newCourse->thumbnail_url = Storage::url('public/images/course_thumbnails'.'/'.$fileName);
            }
            $newCourse->topics()->detach();
            $newCourse->topics()->attach($course['topics']);
            foreach ($course['sections'] as $section) {
                if ($section['id'] == "new") {
                    $newSection = new Section;
                } else {
                    $newSection = Section::find($section['id']);
                    if ($newSection === null) {
                        return response()->json(['status'=>'error', 'message' => 'Không tìm thấy chương', 404]);
                    }
                }
                $newSection->name = $section['name'];
                $newSection->course()->associate($newCourse);
                $newSection->save();
                foreach ($section['lessons'] as $lesson) {
                    $totalLessons++;
                    $totalTime += 10;
                    if ($lesson['id'] == "new") {
                        $newLesson = new Lesson;
                    } else {
                        $newLesson = Lesson::find($lesson['id']);
                        if ($newLesson === null) {
                            return response()->json(['status'=>'error', 'message' => 'Không tìm thấy bài học', 404]);
                        }
                    }

                    $newLesson->name = $lesson['name'];
                    $newLesson->info = $lesson['info'];
                    $newLesson->duration = $lesson['duration'];
                    $newLesson->section()->associate($newSection);
                    $newLesson->save();
                    if (array_key_exists('video', $lesson)) {
                        $video =  $request->file($lesson['video']);
                        $fileName   = $user->username .'-'. $newLesson->id .'.' . $video->getClientOriginalExtension();
                        if (Storage::disk('google')->exists($fileName)) {
                            Storage::delete($fileName);
                        }
                        Storage::disk('google')->put($fileName, File::get($video));

                        $fileArray = Storage::disk('google')->listContents();
                        foreach ($fileArray as $file) {
                            if ($file['name'] == $fileName) {
                                $newLesson->video_url = 'https://drive.google.com/file/d/'.$file['path'].'/preview';
                                break;
                            }
                        }
                    } else {
                        $newLesson->video_url = $lesson['url'];
                    }
                    $newLesson->save();
                }
                if (array_key_exists('quizzes', $section)) {
                    foreach ($section['quizzes'] as $quiz) {
                        if ($quiz['id'] == "new") {
                            $newQuiz = new Quiz;
                        } else {
                            $newQuiz = Quiz::find($quiz['id']);
                            if ($newQuiz === null) {
                                return response()->json(['status'=>'error', 'message' => 'Không tìm thấy quiz', 404]);
                            }
                        }
                        $newQuiz->name = $quiz['name'];
                        $newQuiz->question = $quiz['question'];
                        $newQuiz->section()->associate($newSection);
                        $newQuiz->save();
                        foreach ($quiz['answers'] as $answer) {
                            if ($answer['id'] == "new") {
                                $newAnswer = new Answer;
                            } else {
                                $newAnswer = Answer::find($answer['id']);
                                if ($newAnswer === null) {
                                    return response()->json(['status'=>'error', 'message' => 'Không tìm thấy câu trả lời này', 404]);
                                }
                            }
                            $newAnswer->content = $answer['content'];
                            if ($answer['isAnswer'] == 'false') {
                                $newAnswer->is_true = 0;
                            } elseif ($answer['isAnswer'] == 'true') {
                                $newAnswer->is_true = 1;
                            }
                            $newAnswer->quiz()->associate($newQuiz);
                            $newAnswer->save();
                        }
                        $newQuiz->save();
                        $totalQuizzes ++;
                    }
                }
                $newSection->course()->associate($newCourse);
                $newSection->save();
            }
            if ($course['id'] == "new") {
                $newCourse->instructor()->associate(Auth::user()->id);
            }
            $newCourse->save();
            DB::commit();

            if ($course['id'] == "new") {
                $type = 'thêm';
            } else {
                $type = 'sửa';
            }
            // $courseBuyers = $newCourse->students()->get();
            $followers = Instructor::find(Auth::user()->id)->followers()->get()->merge($newCourse->students()->get());
            $notify = [
                'notifyName'=>Auth::user()->name,
                'avatar'=>Auth::user()->avatar_url,
                'course_id'=>$newCourse->id,
                'course_name'=>$newCourse->name,
                'type'=>$type,
            ];
            $receiverList = [];
            foreach ($followers as $follower) {
                $follower->notify(new NewCourseNotification($notify));
                $receiverList[] = $follower->account_id;
            }
            $notify['receivers'] = $receiverList;
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

            $pusher->trigger('AddCourseNotifyEvent', 'add-course-notify', $notify);

            return response()->json(['status'=>'success', 'message' => 'Lưu khoá học thành công', 'course'=>$newCourse, 'owner_name'=>$user->name, 'totalTime'=>$totalTime, 'totalLessons'=>$totalLessons, 'totalQuizzes'=>$totalQuizzes, 200]);
            // });
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'error', 'message' => 'Lỗi lưu khoá học', 404]);
        }
    }

    public function edit_quiz()
    {
        return view('instructor.quizzes.edit-quiz');
    }
}
