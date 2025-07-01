<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index(Request $request)
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'emis_no' => 'required|unique:students',
            'class_name' => 'required',
            'stud_name' => 'required',
            'roll_no' => 'required|integer',
            'father_name' => 'required',
            'mobile_no' => 'required',
            'address' => 'required',
        ]);

        Student::create($data);
        return redirect()->route('students.index')->with('success', 'Student added');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'class_name' => 'required',
            'stud_name' => 'required',
            'roll_no' => 'required|integer',
            'father_name' => 'required',
            'mobile_no' => 'required',
            'address' => 'required',
        ]);

        $student->update($data);
        return redirect()->route('students.index')->with('success', 'Updated');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Deleted');
    }
}
