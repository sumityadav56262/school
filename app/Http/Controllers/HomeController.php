<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\StudentFee;
use App\Models\TeacherExpense;
use App\Models\MiscExpense;

class HomeController extends Controller
{
    public function index()
    {
        $totalStudents  =   Student::count();
        $totalTeachers  =   Teacher::count();
        $totalIncome    =   StudentFee::sum('payment');
        $totalDues      =   StudentFee::sum('dues');
        $totalExpenses  =   TeacherExpense::sum('paid_amt') +  MiscExpense::sum('amount'); // or \App\Models\Expense if available

        return view('dashboard', compact(
            'totalStudents',
            'totalTeachers',
            'totalIncome',
            'totalDues',
            'totalExpenses'
        ));
    }

}
