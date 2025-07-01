<?php

namespace App\Http\Controllers;

use App\Models\StudClass;
use Illuminate\Http\Request;
use App\Models\StudentFee;
use App\Models\Student;
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;
use Carbon\Carbon;

class StudentFeeController extends Controller
{
    public function index()
    {
        $fees = StudentFee::with('student')->get();
        return view('student_fees.index', compact('fees'));
    }

    public function create()
    {
        $students = Student::all();
        $classNames = StudClass::all();

        // Nepali Date
        $bsDate = NepaliCalendar::today();
        $todayFormattedBsDate = Carbon::parse($bsDate)->format('d-m-Y');

        return view('student_fees.create', compact('students', 'classNames', 'todayFormattedBsDate'));
    }

    public function store(Request $request)
    {
        StudentFee::create($request->all());
        return redirect()->route('student-fees.index')->with('success', 'Fee Added');
    }

    public function edit(StudentFee $studentFee)
    {
        $students = Student::all();
        return view('student_fees.edit', compact('studentFee', 'students'));
    }

    public function update(Request $request, StudentFee $studentFee)
    {
        $studentFee->update($request->all());
        return redirect()->route('student-fees.index')->with('success', 'Fee Updated');
    }

    public function destroy(StudentFee $studentFee)
    {
        $studentFee->delete();
        return redirect()->route('student-fees.index')->with('success', 'Fee Deleted');
    }
}
