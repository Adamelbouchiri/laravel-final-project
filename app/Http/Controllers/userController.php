<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use App\Models\userLessons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function index()
    {
        return view('user.classesCalendar');
    }

    public function showClasses()
    {
        $classes = Auth::user()->classes;
        return view('user.showClasses', compact('classes'));
    }

    public function showCourses()
    {
        return view('user.userCourse');
    }

    public function create()
    {
        $classes = Classe::all();

        $classes = $classes->map(function ($e) {
            return [
                "start" => $e->start,
                "end" => $e->end,
                "color" => "#94c4c6",
                "passed" => false,
                "id" => $e->id,
                "title" => $e->name,
                "seats" => $e->seats,
            ];
        });

        return response()->json([
            "classes" => $classes
        ]);
    }

    public function joinClass(Request $request)
    {
        request()->validate([
            'user_id' => 'required',
            'class_id' => 'required',
        ]);

        $class = Classe::where('id', $request->class_id)->first();
        $user = User::where('id', $request->user_id)->first();


        if ($class->seats === 0) {
            return back()->with('error', 'No seats available for this class');
        }

        if ($class->users()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'User already assigned to this class');
        }

        $class->seats -= 1;
        $class->save();
        $class->users()->attach($user->id);

        $coursesIds = $class->courses()->pluck('id')->toArray();
        $user->courses()->attach($coursesIds);

        foreach($class->courses as $course) {
            $lessonIds = $course->lessons->pluck('id')->toArray();
            $user->lessons()->attach($lessonIds);
        }

        return back()->with('success', 'User assigned successfully');
    }

    public function show(Classe $class)
    {
        return view('user.userSingleClass', compact('class'));
    }

    public function courseShow(Course $course)
    {
        $isTrue = false;
        $lastLesson = null;

        $user = User::where('id', Auth::user()->id)->first();

        $lessons = $user->lessons()->where('course_id', $course->id)->get();

        $firstLesson = $lessons[0]->id;

        $lesson = userLessons::where('user_id', Auth::user()->id)->where('lesson_id', count($lessons) -1)->first();
        
        if($lesson == true) {
            if($lesson->isDone == true) {
                $isTrue = true;
            }
        } 

        return view('user.userCourse', compact('course','lesson', 'lessons', 'firstLesson'));
    }

    public function lessonShow(Lesson $lesson)
    {
        $extension = substr($lesson->content, -3);
        return view('user.userLesson', compact('lesson', 'extension'));
    }
}
