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

    public function getStudent(Request $request)
    {
        $student = Student::where('emis_no', $request->emis_no)->first();
        $latestFee = \App\Models\StudentFee::where('emis_no', $request->emis_no)
            ->latest()
            ->first();
        $recurring_dues_amt = $latestFee->recurring_dues;

        return response()->json([
            'student' => $student,
            'recurring_dues' => $recurring_dues_amt

        ]);
    }
    public function getStudByRollNoClass(Request $request)
    {
        $student = Student::where('class_name', $request->class_name)
            ->where('roll_no', $request->roll_no)
            ->first();

        $latestFee = null;

        if ($student) {
            $latestFee = \App\Models\StudentFee::where('emis_no', $student->emis_no)
                ->latest()
                ->first();
        }

        $recurring_dues_amt = $latestFee ? $latestFee->recurring_dues : 0;

        return response()->json([
            'student' => $student,
            'recurring_dues' => $recurring_dues_amt

        ]);
    }
}
