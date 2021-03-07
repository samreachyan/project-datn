<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CoursePageResources;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function getAllCourses() {
        $hotCourses = Course::withCount('students')->orderBy('students_count', 'desc')->paginate(3);
        $newCourses = Course::withCount('students')->orderBy('price', 'desc')->orderBy('id', 'desc')->paginate(3);
        $courses = Course::withCount('students')->orderBy('id', 'desc')->paginate(3);

        return [
            'msg' => 'Fetched all courses successfully',
            'data' => [
                'new_courses' => CourseResource::collection($newCourses),
                'hot_courses' => CourseResource::collection($hotCourses),
                'all_courses' => CourseResource::collection($courses)
            ]
        ];
    }

    public function hotCourses() {
        $hotCourses = Course::withCount('students')->orderBy('price', 'desc')->paginate(3);

        return [
            'msg' => 'Fetched hot courses successfully',
            'data' => new CoursePageResources($hotCourses)
        ];
    }

    public function courseDetails (Request $request) {
        $rules = array(
            'id_course' => 'required|string',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $msg = $validator->errors();
            return [ 'msg' => $msg, 'data' => null ];
        } else {
            $course = Course::withCount('students')->where('id', $request->id_course)->first();

            return [
                'msg' => 'Found course successfully',
                'data' => $course
            ];
        }
    }
}
