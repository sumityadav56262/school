<?php

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
