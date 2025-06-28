<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalStudents = \App\Models\Student::count();
        $totalTeachers = \App\Models\Teacher::count();
        $totalIncome =  \App\Models\StudentFee::sum('payment');
        $totalDues =  \App\Models\StudentFee::sum('dues');
        $totalExpenses = \App\Models\TeacherExpense::sum('paid_amt') +  \App\Models\MiscExpense::sum('amount'); // or \App\Models\Expense if available

        return view('dashboard', compact(
            'totalStudents',
            'totalTeachers',
            'totalIncome',
            'totalDues',
            'totalExpenses'
        ));
    }

}
