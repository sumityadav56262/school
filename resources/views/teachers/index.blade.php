@extends('layout')

@section('content')
<div class="add-fees-section">
    <div class="add-fees-header">Teachers</div>
    <div class="nav-action">
        <div class="add-button">
            <a href="{{ route('teachers.create') }}" class="reset-button">Add Teacher</a>
        </div>
        <div class="search-group">
            <input class="search-box" type="text">
            <button>Search</button>
        </div>
    </div>
    <table border="1" width="100%" style="margin-top: 10px;">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Actions</th>
        </tr>
        @foreach($teachers as $teacher)
        <tr>
            <td>{{ $teacher->id_card_no }}</td>
            <td>{{ $teacher->teacher_name }}</td>
            <td>{{ $teacher->designation }}</td>
            <td>
                <a class=".edit-button" href="{{ route('teachers.edit', $teacher) }}">Edit</a>
                <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
