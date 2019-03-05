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

        Notification::send($user, new NewLessonNotification(Lesson::latest('id')->first()));
    }

    public function readLesson()
    {
        return auth()->user()->unreadNotifications;
    }

    public function markAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $lessons = auth()->user()->readNotifications->take(5)->sortBy('created_at');
        return view('lesson', compact('lessons'));
    }

    public function readNotificationById($not_id,$lesson_id)
    {
        auth()->user()->unreadNotifications->find($not_id)->markAsRead();
        $lesson = Lesson::find($lesson_id);
        dump($lesson);
    }

    public function showLesson()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return auth()->user()->readNotifications;
    }
}
