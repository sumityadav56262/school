<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_card_no' => 'required|unique:teachers,id_card_no',
            'teacher_name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:15',
            'designation' => 'required|string|max:100',
            'address' => 'required|string|max:255',
        ]);
        Teacher::create($request->merge(['user_id' => Auth::id()])->all());
        return redirect()->route('teachers.index')->with('success', 'Teacher Added');
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $teacher->update($request->all());
        return redirect()->route('teachers.index')->with('success', 'Updated');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Deleted');
    }

    public function getTeacherByIdCardNo(Request $request)
    {
        $value = $request->input('id_card_no');
        $teacher = Teacher::where('id_card_no', $value)->first();
        return response()->json($teacher);
    }

    public function getTeacherByName(Request $request)
    {
        $value = $request->input('teacher_name');
        $teacher = Teacher::where('teacher_name', $value)->first();
        return response()->json($teacher);
    }
}
