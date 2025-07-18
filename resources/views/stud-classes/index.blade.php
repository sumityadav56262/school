@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header bg-success">Classes</div>
        <div class="nav-action">
            <a href="{{ route('stud-classes.create') }}" class="btn btn-success btn-sm">Add Class</a>
            <a href="{{ route('stud-classes.show', 'trash') }}" class="btn btn-danger btn-sm">Trash</a>
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
                                <form action="{{ route('stud-classes.edit', $class->id) }}" method="GET"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                                </form>

                                <form action="{{ route('stud-classes.destroy', $class->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to trash this class?')">
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
