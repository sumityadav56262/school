@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header bg-danger">Trashed Student Fees</div>

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
                                <form action="{{ route('student-fees.restore', $fee) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to restore this record?')">Restore</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
