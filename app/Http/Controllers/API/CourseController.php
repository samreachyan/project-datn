<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getAllCourses() {
        $hotCourses = Course::withCount('students')->orderBy('students_count', 'desc')->paginate(3);

        return [
            'msg' => 'Fetched all courses successfully',
            'data' => [
                'new_courses' => CourseResource::collection($hotCourses),
                'hot_courses' => CourseResource::collection($hotCourses),
                'all_courses' => CourseResource::collection($hotCourses)
            ]
        ];
    }
}
