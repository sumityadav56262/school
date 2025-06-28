@extends('layout')

@section('content')
<div class="add-fees-section">
    <div class="add-fees-header">Teacher Expenses</div>
    <a href="{{ route('teacher-expenses.create') }}" class="reset-button">Add Expense</a>
    <table border="1" width="100%" style="margin-top: 10px;">
        <tr>
            <th>Teacher</th>
            <th>Paid</th>
            <th>Due</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        @foreach($expenses as $exp)
        <tr>
            <td>{{ $exp->teacher->teacher_name ?? '' }}</td>
            <td>{{ $exp->paid_amt }}</td>
            <td>{{ $exp->due_amt }}</td>
            <td>{{ $exp->paid_date }}</td>
            <td>
                <a href="{{ route('teacher-expenses.edit', $exp) }}">Edit</a>
                <form action="{{ route('teacher-expenses.destroy', $exp) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" style="color: red;">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
