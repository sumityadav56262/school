@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header">Teachers</div>

        <div class="nav-action">
            <div class="add-button">
                <a href="{{ route('teachers.create') }}" class="reset-button">Add Teacher</a>
            </div>
        </div>

        <table class="teacher_datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th data-dt-order="disable">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id_card_no }}</td>
                        <td>{{ $teacher->teacher_name }}</td>
                        <td>{{ $teacher->designation }}</td>
                        <td>
                            <a class="edit-button" href="{{ route('teachers.edit', $teacher) }}">Edit</a>
                            <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button"
                                    onclick="return confirm('Are you sure you want to delete this teacher?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
