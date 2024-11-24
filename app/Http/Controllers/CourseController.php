<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\FinalProject;
use App\Models\userCourses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'name' => 'required',
            'classe_id' => 'required',
        ]);

        Course::create([
            'name' => $request->name,
            'classe_id' => $request->classe_id,
        ]);

        return back()->with('success', 'Course added to this class successfully');
    }

    public function projectStore(Request $request)
    {

        request()->validate([
            'question' => 'required',
            'answer' => 'required',
            'course_id' => 'required',
        ]);

        FinalProject::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'course_id' => $request->course_id,
        ]);

        return back()->with('success', 'Project added to this course successfully');
    }

    public function checkAnswers(Request $request)
    {
        request()->validate([
            'answer' => 'required',
            'course_id' => 'required',
            'project_id' => 'required',
        ]);

        $project = FinalProject::where('id', $request->project_id)->first();
        $userCourse = userCourses::where('user_id', Auth::user()->id)->where('course_id', $request->course_id)->first();

        if ($project->answer === $request->answer) {
            $userCourse->completed = true;
            $userCourse->save();
            return back()->with('success', 'Correct answer, You Completed The Course');
        } else {
            return back()->with('error', 'Incorrect answer, Try again');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('coach.course', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
