@extends('layout')

@section('content')
<div class="add-fees-section">
    <div class="add-fees-header">Manage Students</div>

    <div class="nav-action">
        <div class="add-button">
            <a href="{{ route('students.create') }}" class="reset-button">Add Student</a>
        </div>
        <div class="search-group">
            <form method="GET" action="{{ route('students.index') }}">
                <input type="text" class="search-box" name="search" value="{{ request('search') }}" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>EMIS</th>
                <th>Name</th>
                <th>Class</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->emis_no }}</td>
                    <td>{{ $student->stud_name }}</td>
                    <td>{{ $student->class_name }}</td>
                    <td>
                        <a class="edit-button" href="{{ route('students.edit', $student) }}">Edit</a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">No students found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 10px;">
        {{ $students->links('pagination::custom-pagination') }}
    </div>
</div>
@endsection
