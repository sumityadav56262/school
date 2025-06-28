<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request) {        
        $query = Teacher::query();

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function($q) use ($search) {
                $q->where('id_card_no', 'like', "%{$search}%")
                ->orWhere('teacher_name', 'like', "%{$search}%")
                ->orWhere('designation', 'like', "%{$search}%")
                ->orWhere('mobile_no', 'like', "%{$search}%");
            });
        }     

        $teachers = $query->paginate(3)->withQueryString();
        
        return view('teachers.index', compact('teachers'));
    }

    public function create() {
        return view('teachers.create');
    }

    public function store(Request $request) {
        Teacher::create($request->all());
        return redirect()->route('teachers.index')->with('success', 'Teacher Added');
    }

    public function edit(Teacher $teacher) {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher) {
        $teacher->update($request->all());
        return redirect()->route('teachers.index')->with('success', 'Updated');
    }

    public function destroy(Teacher $teacher) {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Deleted');
    }

    public function search($value)
    {
        $teachers = Teacher::where('teacher_name', $value );
    }
}
