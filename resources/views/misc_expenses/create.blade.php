@extends('layout')

@section('content')
<div class="add-fees-section">
    <div class="add-fees-header">Add Misc Expense</div>
    <form method="POST" action="{{ route('misc-expenses.store') }}">
        @csrf
        @include('misc_expenses.form')
        <div class="h-line"></div>
        <div class="add-fees-footer">
            <button type="submit">+</button>
        </div>
    </form>
</div>
@endsection
