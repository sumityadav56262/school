<?php

use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudClassController;
use App\Http\Controllers\StudentFeeController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherExpenseController;
use App\Http\Controllers\MiscExpenseController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Authentication Routes
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::view('/forgot-password', 'auth.forgot')->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset password form and submit
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'reset'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/get_student', [StudentController::class, 'getStudent'])->name('student.get_student');
    Route::get('/get_student_by_rollno_class', [StudentController::class, 'getStudByRollNoClass'])
        ->name('student.get_student_by_rollno_class');
    
    Route::resource('students', StudentController::class);
    Route::resource('student-fees', StudentFeeController::class);
    Route::resource('stud-classes', StudClassController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('teacher-expenses', TeacherExpenseController::class);
    Route::resource('misc-expenses', MiscExpenseController::class);

});
