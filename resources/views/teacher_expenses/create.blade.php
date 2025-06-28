@extends('layout')

@section('content')
<div class="add-fees-section">
    <div class="add-fees-header">Add Teacher Expense</div>
    <form method="POST" action="{{ route('teacher-expenses.store') }}">
        @csrf
        @include('teacher_expenses.form')
        <div class="add-fees-footer">
            <button type="submit">+</button>
        </div>
    </form>
</div>
@endsection
