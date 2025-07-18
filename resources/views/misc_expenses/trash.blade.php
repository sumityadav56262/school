@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header bg-danger">Misc Expenses</div>
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
                                <form action="{{ route('misc-expenses.restore', $exp) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success"
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
