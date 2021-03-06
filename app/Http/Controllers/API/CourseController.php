<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getAllCourses() {
        $hotCourses = Course::withCount('students')->orderBy('students_count', 'desc')->paginate(3);

        return [
            'msg' => 'Fetched all courses successfully',
            'data' => [
                'new_courses' => [
                    'id' => '1',
                    'title' => 'Title 1'
                ],
                'hot_courses' => $hotCourses,
            ]
        ];
    }
}
