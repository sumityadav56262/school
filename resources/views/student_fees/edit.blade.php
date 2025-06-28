@extends('layout')

@section('content')
<div class="add-fees-section">
    <div class="add-fees-header">Edit Student Fee</div>
    <form method="POST" action="{{ route('student-fees.update', $studentFee) }}">
        @csrf
        @method('PUT')
        @include('student_fees.form')
        <div class="add-fees-footer">
            <button type="submit">✓</button>
        </div>
    </form>
</div>
@endsection
