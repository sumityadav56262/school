@extends('layout')

@section('content')
<div class="add-fees-section">
    <div class="add-fees-header">Teachers</div>

    <div class="nav-action">
        <div class="add-button">
            <a href="{{ route('teachers.create') }}" class="reset-button">Add Teacher</a>
        </div>
        <div class="search-group">
            <form method="GET" action="{{ route('teachers.index') }}">
                <input type="text" class="search-box" name="search" value="{{ request('search') }}" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
        </div>
    </div>

    <table class="teacher-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->id_card_no }}</td>
                    <td>{{ $teacher->teacher_name }}</td>
                    <td>{{ $teacher->designation }}</td>
                    <td>
                        <a class="edit-button" href="{{ route('teachers.edit', $teacher) }}">Edit</a>
                        <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" style="display:inline;">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">No teachers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 10px;">
        {{ $teachers->links('pagination::custom-pagination') }}
    </div>
</div>
@endsection
