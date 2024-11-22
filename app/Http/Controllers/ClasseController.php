<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\User;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('coach.createClass');
    }

    public function showClasses()
    {
        $classes = Classe::all();

        return view('coach.showClasses', compact('classes'));
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

        request()->validate([
            'name' => 'required',
            'seats' => 'required|integer|max:10',
            'premium' => 'required|boolean',
            'coach_id' => 'required',
            'startTime' => 'required|date|before:endTime',
            'endTime' => 'required|date|after:startTime',
        ]);

        $startTime = $request->startTime;
        $endTime = $request->endTime;

        $currentDate = date('Y-m-d');

        $position1 = strpos($startTime, "T");
        $startDate = substr($startTime, 0, $position1);

        $position2 = strpos($endTime, "T");
        $endDate = substr($endTime, 0, $position2);

        if ($startDate < $currentDate || $endDate < $currentDate) {
            return back()->with('error', 'Choose a date starting from today');
        } else {
            Classe::create([
                'name' => $request->name,
                'seats' => $request->seats,
                'isPremium' => $request->premium,
                'coach_id' => $request->coach_id,
                'start' => $startDate,
                'end' => $endDate,
            ]);
        }
        
        return back()->with('success', 'Classe created successfully');
    }

    public function assignUsers(Request $request)
    {
        request()->validate([
            'user_id' => 'required',
            'class_id' => 'required',
        ]);

        $class = Classe::where('id', $request->class_id)->first();
        $user = User::where('id', $request->user_id)->first();

        // dd($class->courses);

        
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

    /**
     * Display the specified resource.
     */
    public function show(Classe $class)
    {
        $users = User::where('role', 'user')->get();
        return view('coach.showSingleClass', compact('class', "users"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $classe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classe $classe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        //
    }
}
