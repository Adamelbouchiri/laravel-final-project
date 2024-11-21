<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function index() {
        return view('user.classesCalendar');
    }

    public function showClasses() {

        $classes = Auth::user()->classes;
        return view('user.showClasses', compact('classes'));
    }

    public function create() {
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

    public function joinClass(Request $request) {
        
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

        return back()->with('success', 'User assigned successfully');
    }
}
