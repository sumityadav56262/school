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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $index => $class)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $class->class_name }}</td>
                        <td>
                            <a href="{{ route('stud-classes.edit', $class->id) }}" class="btn btn-sm btn-primary">Edit</a>

                            <form action="{{ route('stud-classes.destroy', $class->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this class?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
