@extends('layout')

@section('content')
<div class="add-fees-section">
    <div class="add-fees-header">Misc Expenses</div>
    <div class="nav-action">
        <div class="add-button">
            <a href="{{ route('misc-expenses.create') }}" class="reset-button">Add Expense</a>
        </div>
        <div class="search-group">
            <input class="search-box" type="text">
            <button>Search</button>
        </div>
    </div>
    <table border="1" width="100%" style="margin-top: 10px;">
        <tr>
            <th>Particular</th>
            <th>Amount</th>
            <th>Paid By</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        @foreach($expenses as $exp)
        <tr>
            <td>{{ $exp->particular }}</td>
            <td>{{ $exp->amount }}</td>
            <td>{{ $exp->payment_by }}</td>
            <td>{{ $exp->payment_date }}</td>
            <td>
                <a href="{{ route('misc-expenses.edit', $exp) }}">Edit</a>
                <form action="{{ route('misc-expenses.destroy', $exp) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" >Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
