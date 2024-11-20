<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
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
    Route::get('/classes', [ClasseController::class, 'showClasses'])->name('classes.show');
    Route::get('/classe/{class}', [ClasseController::class, 'show'])->name('classe.show');
    Route::get('/classe/course/{course}', [CourseController::class, 'show'])->name('course.show');
    Route::get('/classe/course/Lesson/{lesson}', [LessonController::class, 'show'])->name('lesson.show');
    Route::post('/lesson/complete', [LessonController::class, 'nextLesson'])->name('lesson.complete');
    Route::post('/course/project', [CourseController::class, 'checkAnswers'])->name('course.checkProject');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [AdminController::class, 'index'])->name('admin.users');
    Route::get('/users/all', [AdminController::class, 'allUsers'])->name('admin.allUsers');
    Route::post('/user/approve/{user}', [AdminController::class, 'approveUser'])->name('admin.approveUser');
    Route::post('/user/coach/{user}', [AdminController::class, 'coachUser'])->name('admin.coachUser');
});

Route::middleware(['auth', 'coach'])->group(function () {
    Route::get('/create-class', [ClasseController::class, 'index'])->name('coach.show');
    Route::post('/class/store', [ClasseController::class, 'store'])->name('class.store');
    Route::post('/class/assign', [ClasseController::class, 'assignUsers'])->name('class.assign');
    Route::post('/course/store', [CourseController::class, 'store'])->name('course.store');
    Route::post('/Lesson/store', [LessonController::class, 'store'])->name('lesson.store');
    Route::post('/course/projectStore', [CourseController::class, 'projectStore'])->name('course.projectStore');
});


require __DIR__.'/auth.php';
