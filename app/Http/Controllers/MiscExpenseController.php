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

    public function create()
    {
        $nepaliToday = NepaliCalendar::today();
        if (!empty($nepaliToday)) {
            $parts = explode('-', $nepaliToday);
            if (count($parts) === 3) {
                $nepaliToday = $parts[2] . '/' . $parts[1] . '/' . $parts[0];
            }
        }

        return view('misc_expenses.create', compact('nepaliToday'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequestData($request);
        $validated['user_id'] = Auth::id();
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
