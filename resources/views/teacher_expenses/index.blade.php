@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header bg-success">Teacher Expenses</div>
        <div class="nav-action">
            <a href="{{ route('teacher-expenses.create') }}" class="btn btn-success btn-sm">Add Expense</a>
            <a href="{{ route('teacher-expenses.show', 'trash') }}" class="btn btn-danger btn-sm">Trash</a>
        </div>
        <table class="teacher_expense_datatable">
            <thead>
                <tr>
                    <th>Teacher</th>
                    <th>Salary</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>Date</th>
                    <th data-dt-order="disable">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expenses as $exp)
                    <tr>
                        <td>{{ $exp->teacher->teacher_name ?? '' }}</td>
                        <td>{{ $exp->salary_amt }}</td>
                        <td>{{ $exp->paid_amt }}</td>
                        <td>{{ $exp->due_amt }}</td>
                        <td>{{ $exp->paid_date }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <form action="{{ route('teacher-expenses.edit', $exp) }}" method="GET"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                                </form>

                                <form action="{{ route('teacher-expenses.destroy', $exp) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to trash this record?')">
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
