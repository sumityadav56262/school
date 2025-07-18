@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header">Add Student</div>
        <form method="POST" action="{{ route('students.store') }}">
            @csrf
            @include('students.form')
            <div class="h-line"></div>
            <div class="add-fees-footer">
                <button type="submit">+</button>
            </div>
        </form>
    </div>
@endsection
