@extends('layout')

@section('content')
<div class="add-fees-section">
    <div class="add-fees-header">Misc Expenses</div>
    <div class="nav-action">
        <div class="add-button">
            <a href="{{ route('misc-expenses.create') }}" class="reset-button">Add Expense</a>
        </div>
        <div class="search-group">
            <form method="GET" action="{{ route('misc-expenses.index') }}">
                <input type="text" class="search-box" name="search" value="{{ request('search') }}" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Particular</th>
                <th>Amount</th>
                <th>Paid By</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($expenses as $exp)
                <tr>
                    <td>{{ $exp->particular }}</td>
                    <td>{{ $exp->amount }}</td>
                    <td>{{ $exp->payment_by }}</td>
                    <td>{{ $exp->payment_date }}</td>
                    <td>
                        <a class="edit-button" href="{{ route('misc-expenses.edit', $exp) }}">Edit</a>
                        <form action="{{ route('misc-expenses.destroy', $exp) }}" method="POST" style="display:inline;">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">No expenses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 10px;">
        {{ $expenses->links() }}
    </div>
</div>
@endsection
