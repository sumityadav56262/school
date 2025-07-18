@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header bg-success">Misc Expenses</div>
        <div class="nav-action">
            <a href="{{ route('misc-expenses.create') }}" class="btn btn-sm btn-success">Add Expense</a>
            <a href="{{ route('misc-expenses.show', 'trash') }}" class="btn btn-sm btn-danger">Trash</a>
        </div>
        <table class="misc_expenses_datatable">
            <thead>
                <tr>
                    <th>Particular</th>
                    <th>Amount</th>
                    <th>Paid By</th>
                    <th>Date</th>
                    <th data-dt-order="disable">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expenses as $exp)
                    <tr>
                        <td>{{ $exp->particular }}</td>
                        <td>{{ $exp->amount }}</td>
                        <td>{{ $exp->payment_by }}</td>
                        <td>{{ $exp->payment_date }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <form action="{{ route('misc-expenses.edit', $exp->id) }}" method="GET"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                                </form>

                                <form action="{{ route('misc-expenses.destroy', $exp) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
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
