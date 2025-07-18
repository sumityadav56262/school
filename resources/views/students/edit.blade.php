@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header bg-success">Edit Student</div>
        <form method="POST" action="{{ route('students.update', $student) }}">
            @csrf
            @method('PUT')
            @include('students.form')
            <div class="add-fees-footer">
                <button type="submit">✓</button>
            </div>
        </form>
    </div>
@endsection
