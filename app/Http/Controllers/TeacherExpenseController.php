<?php

namespace App\Http\Controllers;

use App\Models\TeacherExpense;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class TeacherExpenseController extends Controller
{
    public function index()
    {
        $expenses = TeacherExpense::all();
        return view('teacher_expenses.index', compact('expenses'));
    }

    public function show($id)
    {
        if ($id === 'trash') {
            $expenses = TeacherExpense::onlyTrashed()->get();
            return view('teacher_expenses.trash', compact('expenses'));
        }
        $teacherExpense = TeacherExpense::with('teacher')->findOrFail($id);
        $nepaliDate = $teacherExpense->created_at->format('Y-m-d') ?? now()->format('Y-m-d');;
        $createdAt = AD2BS($nepaliDate);
        if (!$teacherExpense) {
            abort(404, 'Teacher expense record not found.');
        }

        return view('teacher_expenses.show', compact('teacherExpense', 'createdAt'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        $nepaliToday = NepaliCalendar::today();
        return view('teacher_expenses.create', compact('teachers', 'nepaliToday'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequestData($request);

        // Optional: Validate due_amt math relationship
        if ((float)$validated['due_amt'] !== (float)$validated['salary_amt'] - (float)$validated['paid_amt']) {
            return back()->withErrors(['due_amt' => 'Due amount must be equal to Salary amount minus Paid amount.'])->withInput();
        }

        $teacher = Teacher::where('id_card_no', $validated['id_card_no'])->first();

        if (!$teacher) {
            return back()->withErrors(['id_card_no' => 'Teacher not found.'])->withInput();
        }

        $validated['teacher_id'] = $teacher->id;
        unset($validated['id_card_no']);

        $invoiceNo = TeacherExpense::withTrashed()->max('invoice_no') + 1;
        $validated['invoice_no'] = $invoiceNo;

        TeacherExpense::create($validated);

        return redirect()->route('teacher-expenses.index')->with('success', 'Expense added successfully!');
    }


    public function edit(TeacherExpense $teacherExpense)
    {
        $teachers = Teacher::all();
        return view('teacher_expenses.edit', compact('teacherExpense', 'teachers'));
    }

    public function update(Request $request, TeacherExpense $teacherExpense)
    {
        $validated = $this->validateRequestData($request);
        $teacher_id = Teacher::where('id_card_no', $validated['id_card_no'])->value('id');
        unset($validated['id_card_no']);
        $validated['teacher_id'] = $teacher_id;
        $teacherExpense->update($validated);
        return redirect()->route('teacher-expenses.index')->with('success', 'Record updated successfully!');
    }

    public function destroy(TeacherExpense $teacherExpense)
    {
        $teacherExpense->delete();
        return redirect()->route('teacher-expenses.index')->with('success', 'Record deleted successfully!');
    }

    public function restore($id)
    {
        $teacherExpense = TeacherExpense::withTrashed()->findOrFail($id);
        $teacherExpense->restore();
        return redirect()->route('teacher-expenses.show', 'trash')->with('success', 'Record restored successfully!');
    }
    private function validateRequestData($request)
    {
        $validated = $request->validate(
            [
                'salary_amt' => 'required|numeric|min:0',
                'paid_amt'   => 'required|numeric|min:0|lte:salary_amt',
                'due_amt'    => 'required|numeric|min:0',
                'paid_by'    => 'required|string|max:50',
                'paid_date'  => 'required|',
                'remark'     => 'nullable|string|max:500',
                'id_card_no' => 'required|integer',
            ],
            [
                'salary_amt.required' => 'Salary amount is required.',
                'salary_amt.numeric'  => 'Salary amount must be a number.',
                'salary_amt.min'      => 'Salary amount cannot be negative.',

                'paid_amt.required' => 'Paid amount is required.',
                'paid_amt.numeric'  => 'Paid amount must be a number.',
                'paid_amt.min'      => 'Paid amount cannot be negative.',
                'paid_amt.lte'      => 'Paid amount cannot be greater than the salary amount.',

                'due_amt.required' => 'Due amount is required.',
                'due_amt.numeric'  => 'Due amount must be a number.',
                'due_amt.min'      => 'Due amount cannot be negative.',

                'paid_by.required' => 'Paid by field is required.',
                'paid_by.string'   => 'Paid by must be a valid text.',
                'paid_by.max'      => 'Paid by must not exceed 255 characters.',

                'paid_date.required'    => 'Paid date is required.',
                'paid_date.date'        => 'Paid date must be a valid date.',
                'paid_date.date_format' => 'Paid date must be in the format YYYY-MM-DD.',

                'remark.string' => 'Remark must be a valid text.',
                'remark.max'    => 'Remark must not exceed 500 characters.',

                'id_card_no.required' => 'ID Card No is required.',
                'id_card_no.exists'   => 'The selected ID Card No is invalid for your account.',
            ]
        );

        return $validated;
    }
}
