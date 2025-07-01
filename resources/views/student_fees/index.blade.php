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
                    <th>Student</th>
                    <th>Month</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fees as $fee)
                    <tr>
                        <td>{{ $fee->emis_no }}</td>
                        <td>{{ $fee->student->stud_name ?? '' }}</td>
                        <td>{{ $fee->month_name }}</td>
                        <td>{{ $fee->total_amt }}</td>
                        <td>
                            <a href="{{ route('student-fees.edit', $fee) }}">Edit</a>
                            <form action="{{ route('student-fees.destroy', $fee) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
