<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LessonController extends Controller
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

    public function nextLesson(Request $request)
    {
        
        request()->validate([
            'lesson_id' => 'required|integer',
        ]);

        $lesson = Lesson::where('id', $request->lesson_id)->first();

        $course = Course::where('id', $lesson->course->id)->first();

        foreach ($course->lessons as $lessonItm) {
            if($lesson->id + 1 == $lessonItm->id){
                $lessonItm->current = true;
                $lessonItm->save();
            }
        }

        return back()->with('success', 'Lesson Completed Successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'course_id' => 'required',
            'content' => 'required|file|mimes:pdf,jpg,jpeg,png,mp4,avi,mov',
        ]);

        
        $file = file_get_contents($request->content);
        
        $fileName = hash("sha256", $file . Carbon::now()) . "." . $request->content->getClientOriginalExtension();
        

        $request->content->move(public_path("lessons-files"), $fileName);

        Lesson::create([
            'name' => $request->name,
            'description' => $request->description,
            'course_id' => $request->course_id,
            'content' => $fileName
        ]);

        return back()->with('success', 'Lesson created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        $extension = substr($lesson->content, -3);
        return view('coach.lesson', compact('lesson', 'extension'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
