@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header">Classes</div>
        <div class="nav-action">
            <div class="add-button">
                <a href="{{ route('stud-classes.create') }}" class="reset-button">Add Class</a>
            </div>
        </div>
        <table class="student_classes_datatable">
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Class Name</th>
                    <th data-dt-order="disable">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $index => $class)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $class->class_name }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <form action="{{ route('stud-classes.edit', $class->id) }}" method="GET" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                                </form>

                                <form action="{{ route('stud-classes.destroy', $class->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this class?')">
                                        Delete
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
