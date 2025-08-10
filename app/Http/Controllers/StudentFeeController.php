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
    public function show($id)
    {
        if ($id === 'trash') {
            $fees = StudentFee::onlyTrashed()->with('student')->get();
            return view('student_fees.trash', compact('fees'));
        }

        // Eager load 'student' and 'feeParticulars' relationships
        $studentFee = StudentFee::with(['student'])->find($id);

        // Convert created_at to Nepali date format
        // If created_at is null, use current date
        $nepDate = $studentFee->created_at->format('Y-m-d') ?? now()->format('Y-m-d');
        $createdAt = AD2BS($nepDate);

        // dd($studentFee);
        if (!$studentFee) {
            // Handle case where student fee record is not found
            // For example, redirect back with an error or return a 404
            abort(404, 'Student fee record not found.');
        }

        return view('student_fees.show', compact('studentFee', 'createdAt'));
    }

    public function create()
    {
        $classNames = StudClass::all();
        $nepaliToday = NepaliCalendar::today();
        return view('student_fees.create', compact('classNames', 'nepaliToday'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        $invoiceNo = StudentFee::withTrashed()->max('invoice_no') + 1;
        $data = $this->prepareFeeData($request);
        $data['user_id'] = Auth::id(); // Set the user_id to the authenticated user
        $data['invoice_no'] = $invoiceNo; // Set the invoice number
        StudentFee::create($data);

        return redirect()->route('student-fees.index')
            ->with('success', 'Student fee added successfully!');
    }

    public function edit(StudentFee $studentFee)
    {
        $classNames = StudClass::all();

        // Find the most recent payment *before* this one (to get past dues)
        $previousFee = StudentFee::where('emis_no', $studentFee->emis_no)
            ->where('id', '!=', $studentFee->id)
            ->orderByDesc('id')
            ->first();

        // Pass previous dues (if any) to the view
        $recurringDues = $previousFee ? $previousFee->dues_amt : 0;

        return view('student_fees.edit', compact('studentFee', 'classNames', "recurringDues"));
    }

    public function update(Request $request, StudentFee $studentFee)
    {
        $this->validateRequest($request);
        $data = $this->prepareFeeData($request);
        $data['user_id'] = Auth::id(); // Set the user_id to the authenticated user
        $studentFee->update($data);

        return redirect()->route('student-fees.index')
            ->with('success', 'Student fee updated successfully!');
    }

    public function destroy(StudentFee $studentFee)
    {
        $studentFee->delete();
        return redirect()->route('student-fees.index')
            ->with('success', 'Student fee deleted successfully!');
    }

    public function restore($id)
    {
        $studentFee = StudentFee::withTrashed()->findOrFail($id);
        $studentFee->restore();
        return redirect()->route('student-fees.show', 'trash')
            ->with('success', 'Student fee restored successfully!');
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
            'yearly_fee' => 'required|numeric',
            'monthly_fee' => 'required|numeric',
            'eca_fee' => 'required|numeric',
            'game_fee' => 'required|numeric',
            'misc_fee' => 'required|numeric',
            'exam_fee' => 'required|numeric',
            'tie_belt_fee' => 'required|numeric',
            'vest_fee' => 'required|numeric',
            'computer_fee' => 'required|numeric',
            'trouser_fee' => 'required|numeric',
            'admission_date' => 'nullable',
            'discount_amt' => 'nullable|numeric|min:0',
            'payment_amt' => 'nullable|numeric|min:0',
            'recurring_dues' => 'nullable|numeric|min:0',
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

        // Add recurring dues from input field (readonly)
        $recurringFromPrevious = (int)$request->recurring_dues;

        // Add recurring dues to total
        $total += $recurringFromPrevious;

        // Apply discount
        $discount = (int)$request->discount_amt;
        $afterDiscount = max($total - $discount, 0);

        // Calculate dues
        $payment = (int)$request->payment_amt;
        $dues = max($afterDiscount - $payment, 0);

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
                'recurring_dues' => $dues,
                'recurring_dues_included_amt' => $recurringFromPrevious,
            ]
        );
    }
}
