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

    public function create()
    {
        $teachers = Teacher::all();
        $nepaliToday = NepaliCalendar::today();
        // Format the Nepali date to 'DD/MM/YYYY'
        if (!empty($nepaliToday)) {
            $parts = explode('-', $nepaliToday);
            if (count($parts) === 3) {
                $nepaliToday = $parts[2] . '/' . $parts[1] . '/' . $parts[0];
            }
        }
        return view('teacher_expenses.create', compact('teachers', 'nepaliToday'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_card_no' => [
                'required',
                'integer',
                'exists:teachers,id_card_no',
                //Rule::unique('teacher_expenses', 'id_card_no')->ignore($teacherExpense->id ?? null),
            ],
            'salary_amt' => 'required|numeric',
            'paid_amt' => 'required|numeric',
            'due_amt' => 'required|numeric',
            'paid_by' => 'required|string|max:255',
            'paid_date' => 'required',
            'remark' => 'nullable|string',
        ]);
        $validated['user_id'] = Auth::id(); // Set the user_id to the authenticated user
        TeacherExpense::create($validated);
        return redirect()->route('teacher-expenses.index')->with('success', 'Expense Added');
    }

    public function edit(TeacherExpense $teacherExpense)
    {
        $teachers = Teacher::all();
        return view('teacher_expenses.edit', compact('teacherExpense', 'teachers'));
    }

    public function update(Request $request, TeacherExpense $teacherExpense)
    {
        $teacherExpense->update($request->all());
        return redirect()->route('teacher-expenses.index')->with('success', 'Updated');
    }

    public function destroy(TeacherExpense $teacherExpense)
    {
        $teacherExpense->delete();
        return redirect()->route('teacher-expenses.index')->with('success', 'Deleted');
    }
}
