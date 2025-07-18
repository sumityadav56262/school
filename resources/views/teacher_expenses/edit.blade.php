@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header bg-success">Edit Teacher Expense</div>
        <form method="POST" action="{{ route('teacher-expenses.update', $teacherExpense) }}">
            @csrf
            @method('PUT')
            @include('teacher_expenses.form')
            <div class="add-fees-footer">
                <button type="submit">✓</button>
            </div>
        </form>
    </div>
@endsection
