@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header bg-success">Teachers</div>

        <div class="nav-action">
            <a href="{{ route('teachers.create') }}" class="btn btn-success btn-sm">Add Teacher</a>
            <a href="{{ route('teachers.show', 'trash') }}" class="btn btn-danger btn-sm">Trash</a>
        </div>

        <table class="teacher_datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th data-dt-order="disable">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id_card_no }}</td>
                        <td>{{ $teacher->teacher_name }}</td>
                        <td>{{ $teacher->designation }}</td>
                        <td>{{ $teacher->mobile_no }}</td>
                        <td>{{ $teacher->address }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <form action="{{ route('teachers.edit', $teacher) }}" method="GET"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                                </form>

                                <form action="{{ route('teachers.destroy', $teacher) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to trash this teacher?')">
                                        Trash
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
