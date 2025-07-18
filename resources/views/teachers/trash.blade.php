@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header bg-danger">Trashed Teachers</div>

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
                                <form action="{{ route('teachers.restore', $teacher) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success"
                                        onclick="return confirm('Are you sure you want to restore this teacher?')">
                                        Restore
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
