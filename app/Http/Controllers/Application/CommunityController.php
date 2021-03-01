<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function teacher() {
        return view('community.teacher.teacher');
    }

    public function student() {
        return view('community.student.student-detail');
    }

    public function teacher_profile() {
        return view('community.teacher.teacher-profile');
    }

    public function blog() {
        return view('community.blog.blog');
    }

    public function blog_post() {
        return view('community.blog.blog-post');
    }

    public function faq() {
        return view('community.FAQ.FAQ');
    }

    public function helpcenter() {
        return view('community.helpcenter.help-center');
    }

    public function discussions() {
        return view('community.discussion.discussions');
    }

    public function discussion_detail() {
        return view('community.discussion.discussion-detail');
    }

    public function discussions_ask() {
        return view('community.discussion.ask');
    }

}
