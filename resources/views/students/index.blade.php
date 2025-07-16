@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header">
            Manage Students
        </div>

        <div class="nav-action">
            <div class="add-button">
                <a href="{{ route('students.create') }}" class="reset-button">Add Student</a>
            </div>
            <a href="{{ route('students.show', 'archived') }}"
                class="btn text-white text-underline-none btn-danger reset-button">Archived</a>
        </div>

        <table class="student_datatable">
            <thead>
                <tr>
                    <th>EMIS</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>RNo</th>
                    <th>Father</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th data-dt-order="disable">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->emis_no }}</td>
                        <td>{{ $student->stud_name }}</td>
                        <td>{{ $student->class->class_name ?? '' }}</td>
                        <td>{{ $student->roll_no }}</td>
                        <td>{{ $student->father_name }}</td>
                        <td>{{ $student->mobile_no }}</td>
                        <td>{{ $student->address }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <form action="{{ route('students.edit', $student) }}" method="GET"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                                </form>

                                <form action="{{ route('students.destroy', $student) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to archive this student?')">
                                        Archive
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
