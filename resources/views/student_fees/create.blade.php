@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header bg-success">Add Student Fee</div>
        <form method="POST" action="{{ route('student-fees.store') }}">
            @csrf
            @include('student_fees.form')
            <div class="h-line"></div>
            <div class="add-fees-footer">
                <button type="submit">+</button>
            </div>
        </form>
    </div>
@endsection
