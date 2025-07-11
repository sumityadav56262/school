<?php

namespace App\Http\Controllers;

use App\Models\StudClass;
use App\Models\Student;
use App\Models\StudentFee;
use Illuminate\Http\Request;
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        $nepaliToday = NepaliCalendar::today();
        // Format the Nepali date to 'DD/MM/YYYY'
        if (!empty($nepaliToday)) {
            $parts = explode('-', $nepaliToday);
            if (count($parts) === 3) {
                $nepaliToday = $parts[2] . '/' . $parts[1] . '/' . $parts[0];
            }
        }

        return view('student_fees.create', compact('classNames', 'nepaliToday'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        $data = $this->prepareFeeData($request);
        $data['user_id'] = Auth::id(); // Set the user_id to the authenticated user
        StudentFee::create($data);

        return redirect()->route('student-fees.index')
            ->with('success', 'Student Fee Added Successfully!');
    }

    public function edit(StudentFee $studentFee)
    {
        $classNames = StudClass::all();
        return view('student_fees.edit', compact('studentFee', 'classNames'));
    }

    public function update(Request $request, StudentFee $studentFee)
    {
        $validated = $this->validateRequest($request);

        $data = $this->prepareFeeData($request);
        $data['user_id'] = Auth::id(); // Set the user_id to the authenticated user
        $studentFee->update($data);

        return redirect()->route('student-fees.index')
            ->with('success', 'Fee Updated');
    }

    public function destroy(StudentFee $studentFee)
    {
        $studentFee->delete();
        return redirect()->route('student-fees.index')
            ->with('success', 'Fee Deleted');
    }

    /**
     * Validate incoming request.
     */
    private function validateRequest(Request $request)
    {
        return $request->validate([
            'emis_no' => 'required|exists:students,emis_no',
            'payment_date' => 'required',
            'month_name' => 'required',
            'payment_by' => 'required',
            'received_by' => 'required',
        ]);
    }

    /**
     * Prepare all fee calculations and return data array for saving.
     */
    private function prepareFeeData(Request $request)
    {
        // Convert all possible numeric fields safely
        $fees = [
            'yearly_fee' => (int)$request->yearly_fee,
            'monthly_fee' => (int)$request->monthly_fee,
            'eca_fee' => (int)$request->eca_fee,
            'game_fee' => (int)$request->game_fee,
            'misc_fee' => (int)$request->misc_fee,
            'exam_fee' => (int)$request->exam_fee,
            'tie_belt_fee' => (int)$request->tie_belt_fee,
            'vest_fee' => (int)$request->vest_fee,
            'computer_fee' => (int)$request->computer_fee,
            'trouser_fee' => (int)$request->trouser_fee,
        ];

        $total = array_sum($fees);

        // Check for recurring dues
        $latestFee = StudentFee::where('emis_no', $request->emis_no)
            ->latest()
            ->first();

        if ($request->has('recuring_dues_checkbox')) {
            $total += $latestFee ? (int)$latestFee->recurring_dues : 0;
        }

        // Apply discount
        $discount = (int)$request->discount_amt;
        $afterDiscount = max($total - $discount, 0);

        // Calculate dues
        $payment = (int)$request->payment_amt;
        $dues = max($afterDiscount - $payment, 0);

        // Handle recurring dues logic
        if (!$request->has('recuring_dues_checkbox')) {
            $previousRecurringDues = $latestFee ? (int)$latestFee->recurring_dues : 0;
            $totalRecurringDues = $previousRecurringDues + $dues;
        } else {
            $totalRecurringDues = $dues;
        }

        return array_merge(
            $fees,
            [
                'emis_no'        => $request->emis_no,
                'payment_date'   => $request->payment_date,
                'admission_date' => $request->admission_date,
                'month_name'     => $request->month_name,
                'total_amt'      => $total,
                'discount_amt'   => $discount,
                'payment_amt'    => $payment,
                'dues_amt'       => $dues,
                'payment_by'     => $request->payment_by,
                'received_by'    => $request->received_by,
                'recurring_dues' => $totalRecurringDues,
                'recurring_dues_included_amt' => $request->has('recuring_dues_checkbox') ? $request->recurring_dues : null,
            ]
        );
    }
}
