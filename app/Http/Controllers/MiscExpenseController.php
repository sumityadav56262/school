<?php

namespace App\Http\Controllers;

use App\Models\MiscExpense;
use Illuminate\Http\Request;

class MiscExpenseController extends Controller
{
    public function index() {
        $expenses = MiscExpense::all();
        return view('misc_expenses.index', compact('expenses'));
    }

    public function create() {
        return view('misc_expenses.create');
    }

    public function store(Request $request) {
        MiscExpense::create($request->all());
        return redirect()->route('misc-expenses.index')->with('success', 'Expense Added');
    }

    public function edit(MiscExpense $miscExpense) {
        return view('misc_expenses.edit', compact('miscExpense'));
    }

    public function update(Request $request, MiscExpense $miscExpense) {
        $miscExpense->update($request->all());
        return redirect()->route('misc-expenses.index')->with('success', 'Updated');
    }

    public function destroy(MiscExpense $miscExpense) {
        $miscExpense->delete();
        return redirect()->route('misc-expenses.index')->with('success', 'Deleted');
    }
}
