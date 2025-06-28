@extends('layout')

@section('content')
<div class="add-fees-section">
    <div class="add-fees-header">Add Student Fee</div>
    <form method="POST" action="{{ route('student-fees.store') }}">
        @csrf
        @include('student_fees.form')
        <div class="add-fees-footer">
            <button type="submit">+</button>
        </div>
    </form>
</div>
@endsection
