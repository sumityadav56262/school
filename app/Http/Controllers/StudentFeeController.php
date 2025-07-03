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
        $classNames = StudClass::all();

        // Nepali Date
        $bsDate = NepaliCalendar::today();
        $todayFormattedBsDate = $bsDate; //Carbon::parse($bsDate)->format('d-m-Y');

        return view('student_fees.create', compact('classNames', 'todayFormattedBsDate'));
    }

    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'emis_no' => 'required|exists:students,emis_no',
            'payment_date' => 'required|date',
            'month_name' => 'required',
            'payment_by' => 'required',
            'received_by' => 'required'
        ]);

        // Calculate total
        $total = (
            $request->yearly_fee +
            $request->monthly_fee +
            $request->eca_fee +
            $request->game_fee +
            $request->misc_fee +
            $request->exam_fee +
            $request->tie_belt_fee +
            $request->vest_fee +
            $request->computer_fee +
            $request->trouser_fee
        );

        // Apply discount
        $afterDiscount = $total - $request->discount_amt;
        if ($afterDiscount < 0) $afterDiscount = 0;

        // Calculate current dues
        $dues = $afterDiscount - $request->payment_amt;
        if ($dues < 0) $dues = 0;

        // Find previous recurring dues (latest record for this student)
        $latestFee = \App\Models\StudentFee::where('emis_no', $request->emis_no)
            ->latest()
            ->first();
        $previousRecurringDues = $latestFee ? intval($latestFee->recurring_dues) : 0;
        $totalRecurringDues = $previousRecurringDues + $dues;

        $formatedPaymentDate = null;
        if ($request->admission_date != null && strlen($request->admission_date) == 10) {
            $dateArray = explode('/', $request->admission_date);
            $formatedPaymentDate = $dateArray[2] . '-' . $dateArray[1] . '-' . $dateArray[0];
        }

        // Now save everything
        StudentFee::create([
            'emis_no'        =>  $request->emis_no,
            'payment_date'   =>  $request->payment_date,
            'admission_date' =>  $formatedPaymentDate,
            'month_name'     =>  $request->month_name,
            'yearly_fee'     =>  $request->yearly_fee,
            'monthly_fee'     =>  $request->monthly_fee,
            'eca_fee'        =>  $request->eca_fee,
            'game_fee'       =>  $request->game_fee,
            'misc_fee'       =>  $request->misc_fee,
            'exam_fee'       =>  $request->exam_fee,
            'tie_belt_fee'   =>  $request->tie_belt_fee,
            'vest_fee'       =>  $request->vest_fee,
            'computer_fee'   =>  $request->computer_fee,
            'trouser_fee'    =>  $request->trouser_fee,
            'total_amt'      =>  $total,
            'discount_amt'   =>  $request->discount_amt,
            'payment_amt'    =>  $request->payment_amt,
            'dues_amt'       =>  $dues,
            'payment_by'     =>  $request->payment_by,
            'received_by'    =>  $request->received_by,
            'recurring_dues' =>  $totalRecurringDues,
        ]);

        return redirect()->route('student-fees.index')->with('success', 'Student Fee Added Successfully!');
    }

    public function edit(StudentFee $studentFee)
    {
        $students = Student::all();
        $classNames = StudClass::all();

        return view('student_fees.edit', compact('studentFee', 'students', 'classNames'));
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

    public function getStudent(Request $request)
    {
        $student = Student::where('emis_no', $request->emis_no)->first();
        return response()->json([
            'student' => $student
        ]);
    }
}
