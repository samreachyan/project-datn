<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function readNotification(Request $request)
    {
        if ($request->has('notification_id')) {
            DatabaseNotification::find($request->notification_id)->delete();
        } elseif ($request->has('course_id')) {
            DatabaseNotification::where('notifiable_id', $request->notifiable_id)->where('data', 'like', '%"course_id":'. $request->course_id .'%')->delete();
        }
    }
}
