@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header bg-success">Add Teacher Expense</div>
        <form method="POST" action="{{ route('teacher-expenses.store') }}">
            @csrf
            @include('teacher_expenses.form')
            <div class="h-line"></div>
            <div class="add-fees-footer">
                <button type="submit">+</button>
            </div>
        </form>
    </div>
@endsection
