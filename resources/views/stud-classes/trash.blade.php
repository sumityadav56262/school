@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header bg-danger">Trashed Classes</div>
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
                                <form action="{{ route('stud-classes.restore', $class->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to restore this class?')">
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
