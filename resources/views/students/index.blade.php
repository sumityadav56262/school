@extends('layout')

@section('content')
<div class="add-fees-section">
    <div class="add-fees-header">Manage Students</div>

    <div class="nav-action">
        <div class="add-button">
            <a href="{{ route('students.create') }}" class="reset-button">Add Student</a>
        </div>
    </div>

    <table class="student_datatable">
        <thead>
            <tr>
                <th>EMIS</th>
                <th>Name</th>
                <th>Class</th>
                <th>Roll No</th>
                <th>Father Name</th>
                <th>Mobile No</th>
                {{-- <th>Address</th> --}}
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->emis_no }}</td>
                    <td>{{ $student->stud_name }}</td>
                    <td>{{ $student->class_name }}</td>
                    <td>{{ $student->roll_no}}</td>
                    <td>{{ $student->father_name }}</td>
                    <td>{{ $student->mobile_no }}</td>
                    {{-- <td>{{ $student->address }}</td> --}}
                    <td>
                        <a class="edit-button" href="{{ route('students.edit', $student) }}">Edit</a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    </td>
                </tr>            
            @endforeach
        </tbody>
    </table>
</div>
@endsection
