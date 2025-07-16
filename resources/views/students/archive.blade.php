@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header bg-danger">
            Archived Students
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
                                <form action="{{ route('students.restore', $student) }}" method="GET"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
