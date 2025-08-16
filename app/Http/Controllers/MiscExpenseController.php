<?php

namespace App\Http\Controllers;

use App\Models\MiscExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;

class MiscExpenseController extends Controller
{
    public function index(Request $request)
    {
        $expenses = MiscExpense::all();
        return view('misc_expenses.index', compact('expenses'));
    }

    public function show($id)
    {
        if ($id === 'trash') {
            $expenses = MiscExpense::onlyTrashed()->get();
            return view('misc_expenses.trash', compact('expenses'));
        }

        $expense = MiscExpense::findOrFail($id);
        return view('misc_expenses.show', compact('expense'));
    }

    public function create()
    {
        $nepaliToday = NepaliCalendar::today();
        return view('misc_expenses.create', compact('nepaliToday'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequestData($request);
        MiscExpense::create($validated);
        return redirect()->route('misc-expenses.index')->with('success', 'Expense Added successfully');
    }

    public function edit(MiscExpense $miscExpense)
    {
        return view('misc_expenses.edit', compact('miscExpense'));
    }

    public function update(Request $request, MiscExpense $miscExpense)
    {
        $validated = $this->validateRequestData($request);
        $miscExpense->update($validated);
        return redirect()->route('misc-expenses.index')->with('success', 'Record Updated successfully');
    }

    public function destroy(MiscExpense $miscExpense)
    {
        $miscExpense->delete();
        return redirect()->route('misc-expenses.index')->with('success', 'Record archived successfully');
    }
    public function restore($id)
    {
        $miscExpense = MiscExpense::withTrashed()->findOrFail($id);
        $miscExpense->restore();
        return redirect()->route('misc-expenses.show', 'trash')->with('success', 'Record restored successfully');
    }
    private function validateRequestData($request)
    {
        return $request->validate([
            'particular' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'payment_by' => 'required|string|max:50',
            'payment_date' => 'required',
        ], [
            'particular.required' => 'Particular is required.',
            'amount.required' => 'Amount is required.',
            'payment_by.required' => 'Payment by is required.',
            'payment_date.required' => 'Payment date is required.',
        ]);
    }
}
