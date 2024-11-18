<?php

namespace App\Http\Controllers;

use App\Models\Classe;
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

        if($startDate < $currentDate || $endDate < $currentDate ) {
            return back()->with('error', 'Choose a date starting from today');
        
        } else {
            Classe::create([
                'name' => $request->name,
                'seats' => $request->seats,
                'premium' => $request->premium,
                'coach_id' => $request->coach_id,
                'start' => $startDate,
                'end' => $endDate,
            ]);
        }
        return back()->with('success', 'Classe created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $classe)
    {
        //
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
