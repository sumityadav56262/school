<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudClass;
use App\Models\StudentFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
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
        $validated = $this->validateStudent($request);

        $validated['user_id'] = Auth::id();

        Student::create($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student added.');
    }

    public function edit(Student $student)
    {
        $classNames = StudClass::all();

        return view('students.edit', compact('student', 'classNames'));
    }

    public function update(Request $request, Student $student)
    {
        $rules = $this->validationRules(update: true);

        $validated = $request->validate($rules, $this->validationMessages());

        $student->update($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted.');
    }

    public function getStudent(Request $request)
    {
        $student = Student::where('emis_no', $request->emis_no)->first();

        $recurringDues = $this->getLatestRecurringDues($student?->emis_no);

        return response()->json([
            'student' => $student,
            'recurring_dues' => $recurringDues,
        ]);
    }

    public function getStudByRollNoClass(Request $request)
    {
        $student = Student::where('class_id', $request->class_id)
            ->where('roll_no', $request->roll_no)
            ->first();

        $recurringDues = $this->getLatestRecurringDues($student?->emis_no);

        return response()->json([
            'student' => $student,
            'recurring_dues' => $recurringDues,
        ]);
    }

    /**
     * Common validation logic for creating a student.
     */
    protected function validateStudent(Request $request)
    {
        $rules = $this->validationRules();

        return $request->validate($rules, $this->validationMessages());
    }

    /**
     * Returns student validation rules.
     */
    protected function validationRules(bool $update = false): array
    {
        $rules = [
            'class_id' => ['required', 'exists:stud_classes,id'],
            'roll_no' => ['required', 'integer', 'min:1'],
            'father_name' => ['required', 'string', 'max:100'],
            'mobile_no' => ['required', 'regex:/^[0-9]{10}$/'],
            'address' => ['required', 'string', 'max:255'],
        ];

        if (!$update) {
            $rules = array_merge($rules, [
                'emis_no' => ['required', 'unique:students,emis_no'],
                'stud_name' => ['required', 'string', 'max:100'],
            ]);
        }

        return $rules;
    }

    /**
     * Custom validation messages.
     */
    protected function validationMessages(): array
    {
        return [
            'emis_no.required' => 'EMIS number is required.',
            'emis_no.unique' => 'EMIS number must be unique.',
            'stud_name.required' => 'Student name is required.',
            'stud_name.max' => 'Student name should not exceed 100 characters.',
            'class_id.required' => 'Class is required.',
            'class_id.exists' => 'Selected class does not exist.',
            'roll_no.required' => 'Roll number is required.',
            'roll_no.integer' => 'Roll number must be a number.',
            'roll_no.min' => 'Roll number must be at least 1.',
            'father_name.required' => 'Father\'s name is required.',
            'father_name.max' => 'Father\'s name should not exceed 100 characters.',
            'mobile_no.required' => 'Mobile number is required.',
            'mobile_no.regex' => 'Mobile number must be exactly 10 digits.',
            'address.required' => 'Address is required.',
            'address.max' => 'Address should not exceed 255 characters.',
        ];
    }

    /**
     * Get the latest recurring dues amount for a student.
     */
    protected function getLatestRecurringDues(?string $emisNo): float
    {
        if (!$emisNo) {
            return 0;
        }

        $latestFee = StudentFee::where('emis_no', $emisNo)
            ->latest()
            ->first();

        return $latestFee?->recurring_dues ?? 0;
    }
}
