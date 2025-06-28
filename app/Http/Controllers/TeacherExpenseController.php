<?php

namespace App\Http\Controllers;

use App\Models\TeacherExpense;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherExpenseController extends Controller
{
    public function index() {
        $expenses = TeacherExpense::with('teacher')->get();
        return view('teacher_expenses.index', compact('expenses'));
    }

    public function create() {
        $teachers = Teacher::all();
        return view('teacher_expenses.create', compact('teachers'));
    }

    public function store(Request $request) {
        TeacherExpense::create($request->all());
        return redirect()->route('teacher-expenses.index')->with('success', 'Expense Added');
    }

    public function edit(TeacherExpense $teacherExpense) {
        $teachers = Teacher::all();
        return view('teacher_expenses.edit', compact('teacherExpense', 'teachers'));
    }

    public function update(Request $request, TeacherExpense $teacherExpense) {
        $teacherExpense->update($request->all());
        return redirect()->route('teacher-expenses.index')->with('success', 'Updated');
    }

    public function destroy(TeacherExpense $teacherExpense) {
        $teacherExpense->delete();
        return redirect()->route('teacher-expenses.index')->with('success', 'Deleted');
    }
}
