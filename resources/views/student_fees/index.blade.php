@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header bg-success">Student Fees</div>
        <div class="nav-action">
            <a href="{{ route('student-fees.create') }}" class="btn btn-success btn-sm">Add Fee</a>
            <a href="{{ route('student-fees.show', 'trash') }}" class="btn btn-danger btn-sm">Trash</a>
        </div>

        <table class="student_fee_datatable">
            <thead>
                <tr>
                    <th>EMIS</th>
                    <th>Class</th>
                    <th>Roll No</th>
                    <th>Name</th>
                    <th>Month</th>
                    <th>Total</th>
                    <th>Disc.</th>
                    <th>Pymt</th>
                    <th>Dues</th>
                    <th>Rec Dues</th>
                    <th data-dt-order="disable">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fees as $fee)
                    <tr>
                        <td>{{ $fee->emis_no }}</td>
                        <td>{{ $fee->student->class->class_name ?? '' }}</td>
                        <td>{{ $fee->student->roll_no ?? '' }}</td>
                        <td>{{ $fee->student->stud_name ?? '' }}</td>
                        <td>{{ $fee->month_name }}</td>
                        <td>{{ $fee->total_amt }}</td>
                        <td>{{ $fee->discount_amt }}</td>
                        <td>{{ $fee->payment_amt }}</td>
                        <td>{{ $fee->dues_amt }}</td>
                        <td>{{ $fee->recurring_dues }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <form action="{{ route('student-fees.show', $fee->id) }}" method="GET"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">View</button>
                                </form>

                                <form action="{{ route('student-fees.edit', $fee->id) }}" method="GET"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                                </form>

                                <form action="{{ route('student-fees.destroy', $fee) }}" method="POST"
                                    style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to trash this record?')">Trash</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
