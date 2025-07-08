<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudClass;
use Illuminate\Support\Facades\Auth;

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
        $validated = $request->validated([
            'class_name' => 'required|string|max:255|unique:stud_classes,class_name',
        ]);
        $validated['user_id'] = Auth::id(); // Assuming you want to set the user_id to the authenticated user
        StudClass::create($validated);

        return redirect()->route('stud-classes.index')->with('success', 'Class created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $studClass = StudClass::findOrFail($id);
        return view('stud-classes.show', compact('studClass'));
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
            'class_name' => 'required|string|max:255|unique:stud_classes,class_name,' . $studClass->id,
        ]);
        $validated['user_id'] = Auth::id(); // Assuming you want to set the user_id to the authenticated user
        $studClass->update($validated);

        return redirect()->route('stud-classes.index')->with('success', 'Class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $studClass = StudClass::findOrFail($id);
        $studClass->delete();

        return redirect()->route('stud-classes.index')->with('success', 'Class deleted successfully.');
    }
}
