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
use App\Http\Controllers\SubscriptionController;

use App\Http\Middleware\Subscription;
use App\Models\Teacher;

Route::middleware('guest')->group(function () {
    // Authentication Routes
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::view('/forgot-password', 'auth.forgot')->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

    // Reset password form and submit
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'reset'])->name('password.update');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/subscription/expired', [SubscriptionController::class, 'expired'])->name('subscription.expired');
    Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription.index');
    Route::view('/subscription/renew', 'subscription.renew')->name('subscription.renew');
    Route::post('/subscription/renew', [SubscriptionController::class, 'renew'])->name('subscription.renew');

    Route::get('/subscription/start-trial', [SubscriptionController::class, 'startTrial'])->name('subscription.startTrial');
    Route::get('/subscription/purchase/{months}', [SubscriptionController::class, 'purchase'])->name('subscription.purchase');
});
Route::middleware(['auth'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/get_student', [StudentController::class, 'getStudent'])->name('student.get_student');
    Route::get('/get_student_by_rollno_class', [StudentController::class, 'getStudByRollNoClass'])
        ->name('student.get_student_by_rollno_class');
    Route::get('/get_teacher_by_id_card_no', [TeacherController::class, 'getTeacherByIdCardNo'])
        ->name('teacher.get_teacher_by_id_card_no');
    Route::get('/get_teacher_by_name', [TeacherController::class, 'getTeacherByName'])
        ->name('teacher.get_teacher_by_name');

    Route::resource('students', StudentController::class);
    Route::resource('student-fees', StudentFeeController::class);
    Route::resource('stud-classes', StudClassController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('teacher-expenses', TeacherExpenseController::class);
    Route::resource('misc-expenses', MiscExpenseController::class);

    //restore archived student
    Route::get('/students/archive/restore/{student}', [StudentController::class, 'restore'])
        ->name('students.restore');

    //change password
    Route::view('/change-password', 'auth.change-password')->name('password.change');
    Route::post('/change-password', [AuthController::class, 'update'])->name('password.change.update');
});
