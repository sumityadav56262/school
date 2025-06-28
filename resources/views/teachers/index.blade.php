@extends('layout')

@section('content')
<div class="add-fees-section">
    <div class="add-fees-header">Teachers</div>
    <a href="{{ route('teachers.create') }}" class="reset-button">Add Teacher</a>
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
                <a href="{{ route('teachers.edit', $teacher) }}">Edit</a>
                <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" style="color: red;">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
