<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Notifications\NewLessonNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function newLesson()
    {
        $lesson = new Lesson();

        $lesson->user_id = auth()->user()->id;
        $lesson->title = "Laravel Notification";
        $lesson->body = "This lesson we learn about notification on laravel";
        $lesson->save();

        $user = User::where('id','!=',auth()->user()->id)->get();

        if(Notification::send($user, new NewLessonNotification(Lesson::latest('id')->first())))
        {
            return back();
        }


    }

}
