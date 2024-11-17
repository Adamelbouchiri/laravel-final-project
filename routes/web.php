<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/waitingPage', [ProfileController::class, 'index'])->name("waiting");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [AdminController::class, 'index'])->name('admin.users');
    Route::get('/users/all', [AdminController::class, 'allUsers'])->name('admin.allUsers');
    Route::post('/user/approve/{user}', [AdminController::class, 'approveUser'])->name('admin.approveUser');
    Route::post('/user/coach/{user}', [AdminController::class, 'coachUser'])->name('admin.coachUser');
});


require __DIR__.'/auth.php';
