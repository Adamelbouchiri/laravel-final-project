<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use App\Models\userClasses;
use App\Models\userLessons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;

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
                "premium" => $e->isPremium,
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
            return back()->with('error', "You're already assigned to this class");
        }

        $class->seats -= 1;
        $class->save();
        $class->users()->attach($user->id);

        $coursesIds = $class->courses()->pluck('id')->toArray();
        $user->courses()->attach($coursesIds);

        foreach ($class->courses as $course) {
            $lessonIds = $course->lessons->pluck('id')->toArray();
            $user->lessons()->attach($lessonIds);
        }

        $userClass = userClasses::where('user_id', $user->id)->where('classe_id', $class->id)->first();

        if ($userClass && $class->isPremium == true) {
            $userClass->isPaid = true;
            $userClass->save();
        }

        return redirect()->route('classesCalendar.show');
    }

    public function show(Classe $class)
    {
        return view('user.userSingleClass', compact('class'));
    }

    public function courseShow(Course $course)
    {
        $isTrue = false;

        $user = User::where('id', Auth::user()->id)->first();

        $lessons = $user->lessons()->where('course_id', $course->id)->get();

        $firstLesson = $lessons[0]->id;
        $lastLesson = $lessons[count($lessons) - 1]->id;

        $lesson = userLessons::where('user_id', Auth::user()->id)->where('lesson_id', $lastLesson)->first();

        if ($lesson == true) {
            $isTrue = $lesson->isDone;
        }

        return view('user.userCourse', compact('course', 'isTrue', 'lessons', 'firstLesson'));
    }

    public function lessonShow(Lesson $lesson)
    {
        $extension = substr($lesson->content, -3);
        return view('user.userLesson', compact('lesson', 'extension'));
    }

    public function payClass(Classe $class)
    {

        $user = User::where('id', Auth::user()->id)->first();
        $userClass = userClasses::where('user_id', $user->id)->where('classe_id', $class->id)->first();

        if ($userClass && $userClass->isPaid == true) {
            return back()->with('error', 'You have already paid for this class');
        }

        Stripe::setApiKey(config('stripe.sk'));

        $session = Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'usd',
                        'product_data' => [
                            "name" => $class->name,
                            "description" => "pay the previewed amount to join the class"
                        ],
                        'unit_amount'  => 4500,
                    ],
                    'quantity'   => 1,
                ],

            ],
            'mode'        => 'payment',
            'success_url' => route('success', $class->id),
            'cancel_url'  => route('dashboard'),
        ]);

        return redirect()->away($session->url);
    }

    public function success(Classe $class)
    {
        return view('user.paymentSuccess', compact('class'));
    }

    public function failed()
    {
        return view('user.paymentFailed');
    }

    public function userProfile()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $courses = $user->courses;
        return view('user.profile', compact('courses'));
    }
}
