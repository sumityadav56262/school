<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StudClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = StudClass::all();
        return view('stud-classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stud-classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('stud_classes')->where(
                    fn($query) =>
                    $query->where('user_id', Auth::id())
                ),
            ],
        ]);
        $validated['user_id'] = Auth::id(); // Assuming you want to set the user_id to the authenticated user
        StudClass::create($validated);

        return redirect()->route('stud-classes.index')->with('success', 'Class created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $classes = StudClass::onlyTrashed()->get();
        return view('stud-classes.trash', compact('classes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $studClass = StudClass::findOrFail($id);
        return view('stud-classes.edit', compact('studClass'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $studClass = StudClass::findOrFail($id);

        $validated = $request->validate([
            'class_name' => [
                'required',
                'string',
                'max:255',
            ],
        ]);
        $validated['user_id'] = Auth::id(); // Assuming you want to set the user_id to the authenticated user
        $studClass->update($validated);

        return redirect()->route('stud-classes.index')->with('success', 'Class updated successfully.');
    }

    public function restore(string $id)
    {
        $studClass = StudClass::withTrashed()->findOrFail($id);
        $studClass->restore();

        return redirect()->route('stud-classes.index')->with('success', 'Class restored successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $studClass = StudClass::findOrFail($id);
        $studClass->delete();

        return redirect()->route('stud-classes.index')->with('success', 'Class archived successfully.');
    }
}
