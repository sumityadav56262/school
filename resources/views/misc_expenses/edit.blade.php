@extends('layout')

@section('content')
<div class="add-fees-section">
    <div class="add-fees-header">Edit Misc Expense</div>
    <form method="POST" action="{{ route('misc-expenses.update', $miscExpense) }}">
        @csrf
        @method('PUT')
        @include('misc_expenses.form')
        <div class="add-fees-footer">
            <button type="submit">✓</button>
        </div>
    </form>
</div>
@endsection
