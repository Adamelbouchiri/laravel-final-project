<?php

namespace App\Http\Controllers;

use App\Models\MasterClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('masterClasses');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $MasterClasses = MasterClass::all();

        $MasterClasses = $MasterClasses->map(function ($e) {
            return [
                "start" => $e->start,
                "end" => $e->end,
                "color" => "#94c4c6",
                "name" => $e->name,
            ];
        });

        return response()->json([
            "MasterClasses" => $MasterClasses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "start" => "required",
            "end" => "required"
        ]);

        MasterClass::create([
            "name" => Auth::user()->name,
            "start" => $request->start . ":00",
            "end" => $request->end . ":00"
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterClass $masterClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterClass $masterClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterClass $masterClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterClass $masterClass)
    {
        //
    }
}
