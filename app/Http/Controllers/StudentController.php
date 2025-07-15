<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function index(Request $request)
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $classNames = StudClass::all();
        return view('students.create', compact('classNames'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'emis_no' => 'required|unique:students',
            'class_id' => 'required|exists:stud_classes,id',
            'stud_name' => 'required',
            'roll_no' => 'required|integer',
            'father_name' => 'required',
            'mobile_no' => 'required',
            'address' => 'required',
        ]);
        $validated['user_id'] = Auth::id();
        Student::create($validated);
        return redirect()->route('students.index')->with('success', 'Student added');
    }

    public function edit(Student $student)
    {
        $classNames = StudClass::all();
        return view('students.edit', compact('student', 'classNames'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'class_id' => 'required|exists:stud_classes,id',
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
        $recurring_dues_amt = $latestFee ? $latestFee->recurring_dues : 0;

        return response()->json([
            'student' => $student,
            'recurring_dues' => $recurring_dues_amt

        ]);
    }
    public function getStudByRollNoClass(Request $request)
    {
        $student = Student::where('class_id', $request->class_id)
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
