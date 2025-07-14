@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header">Student Fees</div>
        <div class="nav-action">
            <div class="add-button">
                <a href="{{ route('student-fees.create') }}" class="reset-button">Add Fee</a>
            </div>
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
                    <th>Discount</th>
                    <th>Payment</th>
                    <th>Dues</th>
                    <th>Recurring Dues</th>
                    <th data-dt-order="disable">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fees as $fee)
                    <tr>
                        <td>{{ $fee->emis_no }}</td>
                        <td>{{ $fee->student->class_name ?? '' }}</td>
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
                                <from action="{{ route('student-fees.show', $fee->id) }}" method="GET" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">View</button>
                                </from>
                                
                                <from action="{{ route('student-fees.edit', $fee->id) }}" method="GET" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </from>
                                
                                <form action="{{ route('student-fees.destroy', $fee) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
