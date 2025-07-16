<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        $request->validate($this->validationRules());
        Teacher::create($request->merge(['user_id' => Auth::id()])->all());
        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully!');
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $mergeRulesMessage = array_merge($this->validationRules($teacher->id), $this->validationMessages());
        $validated = $request->validate($mergeRulesMessage);
        $teacher->update($validated);
        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully!');
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

    protected function validationRules(?int $teacher_id = null): array
    {
        return [
            'id_card_no' => [
                'required',
                'integer',
                Rule::unique('teachers')->where(
                    fn($query) =>
                    $query->where('user_id', Auth::id())
                )->ignore($teacher_id),
            ],
            'teacher_name' => 'required|string|max:255',
            'mobile_no' => 'required|string|regex:/^[0-9]{10}$/',
            'designation' => 'required|string|max:100',
            'address' => 'required|string|max:255',
        ];
    }
    protected function validationMessages(): array
    {
        return [
            'teacher_name.required' => 'Teacher name is required.',
            'mobile_no.required' => 'Mobile number is required.',
            'mobile_no.regex' => 'Mobile number must be a valid 10-digit number.',
            'designation.max' => 'Designation cannot exceed 100 characters.',
            'designation.required' => 'Designation is required.',
            'address.required' => 'Address is required.',
        ];
    }
}
