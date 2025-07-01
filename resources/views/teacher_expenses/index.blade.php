@extends('layout')

@section('content')
<div class="add-fees-section">
    <div class="add-fees-header">Teacher Expenses</div>
    <div class="nav-action">
        <div class="add-button">
            <a href="{{ route('teacher-expenses.create') }}" class="reset-button">Add Expense</a>
        </div>
    </div>
    <table class="teacher_expense_datatable">
        <thead>
            <tr>
                <th>Teacher</th>
                <th>Salary</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $exp)
            <tr>                
                <td>{{ $exp->teacher->teacher_name ?? '' }}</td>
                <td>{{ $exp->salary_amout }}</td>
                <td>{{ $exp->paid_amt }}</td>
                <td>{{ $exp->due_amt }}</td>
                <td>{{ $exp->paid_date }}</td>
                <td>
                    <a href="{{ route('teacher-expenses.edit', $exp) }}">Edit</a>
                    <form action="{{ route('teacher-expenses.destroy', $exp) }}" method="POST" style="display:inline;">
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
