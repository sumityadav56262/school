@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header">Manage Students</div>
        <div class="nav-action">
            <div class="add-button">
                <a href="{{ route('students.create') }}" class="reset-button">Add Student</a>
            </div>
            <div class="search-group">
                <input class="search-box" type="text">
                <button>Search</button>
            </div>
        </div>
        <table border="1" width="100%" style="margin-top: 10px;">
            <tr>
                <th>EMIS</th>
                <th>Name</th>
                <th>Class</th>
                <th>Actions</th>
            </tr>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->emis_no }}</td>
                <td>{{ $student->stud_name }}</td>
                <td>{{ $student->class_name }}</td>
                <td>
                    <a href="{{ route('students.edit', $student) }}">Edit</a>
                    <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection
