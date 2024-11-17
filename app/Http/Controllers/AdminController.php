<?php

namespace App\Http\Controllers;

use App\Mail\PasswordMailer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index() {

        $notApprovedUsers = User::where('isApproved', false)->get();

        return view('admin.users', compact("notApprovedUsers"));
    }

    public function allUsers() {

        $users = User::where('isApproved', true,)->where('id', '!=', 1)->get();

        return view('admin.allUsers', compact("users"));
    }

    public function approveUser(User $user) {

        $pass = Str::random(12);
        
        $passwordHashed = bcrypt($pass);
        $user->password = $passwordHashed;
        $user->isApproved = true;
        $user->save();

        Mail::to($user->email)->send(new PasswordMailer($pass));

        // Auth::login($user);
        return back()->with('success', 'User is accepted Successfully');
    }

    public function coachUser(User $user) {

        if($user->role == 'coach') {
            return back()->with('error', 'User is already a coach');
        }

        $user->role = 'coach';
        $user->save();
        
        return back()->with('success', 'User became a coach Successfully');
    }
}
